<?php declare(strict_types=1);

namespace App\Screen;

use App\Entity\Hockey\Club;
use App\Entity\Hockey\Game;
use App\Entity\Screen;
use App\Entity\Hockey\Table;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ScreensRepository
{
    private ManagerRegistry $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @return Screen[]
     */
    public function getAll(): array
    {
        return $this->filterGet([]);
    }

    /**
     * @param int $id
     * @return Screen
     */
    public function getById($id): Screen
    {
        return current($this->filterGet(['id' => $id]));
    }

    /**
     * @return Screen
     * @throws ExceptionInterface
     */
    public function getActive(): Screen
    {
        /** @var Screen $screen */
        $screen = current($this->filterGet(['active' => Screen::IS_ACTIVE], null, 1));
        if ($screen->isEnrichable()) {
            $serializer = new Serializer(array(new ObjectNormalizer()), array('json' => new JsonEncoder()));

            //@TODO a switch is not nice
            switch ($screen->screenType) {
                case 'compare':
                case 'livegame':
                    $repo = $this->managerRegistry->getRepository(Club::class); //@TODO cache response

                    /** @var Club $hometeam */
                    $hometeam = $serializer->normalize(
                        $repo->findOneBy(
                            ['id' => $screen->getConfig('hometeam')]
                        )
                    );

                    /** @var Club $awayteam */
                    $awayteam = $serializer->normalize(
                        $repo->findOneBy(
                            ['id' => $screen->getConfig('awayteam')]
                        )
                    );

                    //@TODO remove this when alias mapping is available
                    if ($awayteam["id"] === 61) {
                        $awayteam["logo"] = 'iec-roosters_v1.png';
                    }
                    if ($awayteam["id"] === 6) {
                        $awayteam["logo"] = 'ec-kassel-huskies_v1.png';
                    }

                    $screen->setConfig('hometeam', $hometeam);
                    $screen->setConfig('awayteam', $awayteam);
                    break;

                case 'images':
                    $screen->setConfig('images', array_values($screen->getConfig('images')));
                    break;

                case 'othergames':
                    $repo = $this->managerRegistry->getRepository(Club::class); //@TODO cache response
                    $items = [];
                    for ($i = 1; $i <= 8; $i++) {
                        if ($screen->getConfig('home_'.$i) !== null && $screen->getConfig('away_'.$i) !== null) {
                            //@TODO too many queries
                            $game = new Game();
                            $game->hometeam = $repo->findOneBy(['id' => $screen->getConfig('home_'.$i)]);
                            $game->awayteam = $repo->findOneBy(['id' => $screen->getConfig('away_'.$i)]);
                            $game->homescore = (int) $screen->getConfig('scorehome_'.$i);
                            $game->awayscore = (int) $screen->getConfig('scoreaway_'.$i);
                            $game->isFinished = $screen->getConfig('finished_'.$i); //@TODO property not in entity
                            $items[] = $game;
                        }
                    }
                    $screen->setConfig('items', $items);
                    break;

                case 'schedule':
                    $games = $this->managerRegistry
                        ->getManager()
                        ->createQuery('SELECT g FROM App:Hockey\Game g WHERE g.catid = :catid AND CONCAT(g.gamedate, \' \', g.gametime) > CONCAT(CURRENT_DATE(), \' \', CURRENT_TIME()) AND g.state = 1 ORDER BY CONCAT(g.gamedate, \' \', g.gametime) ASC')
                        ->setParameter('catid', $screen->getConfig('id'))
                        ->setMaxResults(8)
                        ->getResult();
                    $screen->setConfig('items', $games);
                    break;

                case 'six':
                    $repo = $this->managerRegistry->getRepository(Club::class); //@TODO cache response
                    $club = $serializer->normalize(
                        $repo->findOneBy(
                            ['id' => $screen->getConfig("team")]
                        ),
                        'json'
                    );
                    $screen->setConfig('club', $club);
                    break;

                case 'table':
                    $repo = $this->managerRegistry->getRepository(Table::class); //@TODO cache response
                    $tables = $serializer->normalize(
                        $repo->findBy(['catid' => $screen->getConfig("id")]),
                        'json'
                    );
                    usort($tables, function($a, $b) { //@TODO would be nice to sort on MySQL
                        if ($a["points"] === $b["points"]) {
                            $aDiff = $a["goalsFor"] - $a["goalsAgainst"];
                            $bDiff = $b["goalsFor"] - $b["goalsAgainst"];
                            if ($aDiff === $bDiff) {
                                return 0;
                            }
                            return ($aDiff < $bDiff) ? 1 : -1;
                        }
                        return ($a["points"] < $b["points"]) ? 1 : -1;
                    });
                    $screen->setConfig('items', $tables);
                    break;
            }
        }

        return $screen;
    }

    /**
     * @param int $id
     */
    public function activate(int $id): void
    {
        $this->deactivateAll();
        $screen = $this->getById($id);
        $screen->active = Screen::IS_ACTIVE;
        $this->save($screen);
    }

    public function save(Screen $screen): void
    {
        $em = $this->managerRegistry->getManager();
        $em->persist($screen);
        $em->flush();
    }

    /**
     * Deactivate all screens
     */
    private function deactivateAll(): void
    {
        $em = $this->managerRegistry->getManager();
        $query = $em->createQuery('UPDATE App:Screen s SET s.active = 0');
        $query->execute();
    }

    /**
     * @param array $filters
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return Screen[]
     */
    private function filterGet(array $filters, array $orderBy = null, int $limit = null, int $offset = null): array
    {
        $repository = $this->managerRegistry->getRepository(Screen::class);
        return $repository->findBy($filters, $orderBy, $limit, $offset);
    }
}