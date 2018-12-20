const REFRESH_INTERVAL = 2000;
var isRefreshRunning = false; // make sure only one refresh runs in parallel

(function($){
    var lastChange = 0;
    var effects = new Effects();

    // @see https://github.com/hakimel/reveal.js
    Reveal.initialize({
        controls: false,
        progress: false,
        history: true,
        center: true,
        keyboard: true,
        transition: 'none',
        autoSlideStoppable: false,
        dependencies: [{
            src: 'js/classList.js',
            condition: function() {
                return !document.body.classList;
            }
        }]
    });

    // refresh function
    var refreshIntervalId = setInterval(function() {
        if (!isRefreshRunning) {
            isRefreshRunning = true;
            $.ajax({
                url: Routing.generate('refresh'),
                success: function (result) {
                    if (result.forceReload == 1) {

                        // refresh whole window
                        clearInterval(refreshIntervalId);
                        window.location.href = Routing.generate('homepage');

                    } else if (result.lastChange > lastChange) {

                        // activate screen
                        if (result.activeScreen !== Reveal.getState().indexh) {
                            Reveal.slide(result.activeScreen, 0, 0);
                        }

                        // refresh score and ticker
                        var $livegame = $('.livegame'),
                            $attendance = $('.attendance'),
                            $othergames = $('.othergames');

                        $livegame.find('#caption').html(result.livegame.caption);
                        $livegame.find('#hometeam').attr('src', SCHEMA + 'www.herner-ev.com/components/com_hockeymanager_clubs/assets/img/' + result.livegame.hometeam);
                        $livegame.find('#homescore').html(result.livegame.homescore);
                        $livegame.find('#awayteam').attr('src', SCHEMA + 'www.herner-ev.com/components/com_hockeymanager_clubs/assets/img/' + result.livegame.awayteam);
                        $livegame.find('#awayscore').html(result.livegame.awayscore);
                        $livegame.find('#ticker').html(result.livegame.goals.join(', '));
                        $livegame.find('.marquee').marquee({duration: 10000});

                        // refresh attendance
                        $attendance.find('#attendance').html(result.attendance.attendance);

                        // refresh other games
                        for (var i = 1; i <= 8; i++) {
                            var home = eval('result.othergames.home_' + i),
                                away = eval('result.othergames.away_' + i),
                                finished = eval('result.othergames.finished_' + i);

                            if (
                                (home != null && home.id > 0)
                                && (away != null && away.id > 0)
                            ) {
                                $othergames.find('#home_' + i + '_logo').attr('src', SCHEMA + 'www.herner-ev.com/components/com_hockeymanager_clubs/assets/img/cache/50x50/' + home.logo);
                                $othergames.find('#home_' + i + '_name').html(home.name);
                                $othergames.find('#home_' + i + '_score').html(+eval('result.othergames.scorehome_' + i));
                                $othergames.find('#away_' + i + '_logo').attr('src', SCHEMA + 'www.herner-ev.com/components/com_hockeymanager_clubs/assets/img/cache/50x50/' + away.logo);
                                $othergames.find('#away_' + i + '_name').html(away.name);
                                $othergames.find('#away_' + i + '_score').html(+eval('result.othergames.scoreaway_' + i));

                                if (finished) {
                                    $othergames.find('#home_' + i + '_score').closest('h3').addClass('finished');
                                } else {
                                    $othergames.find('#home_' + i + '_score').closest('h3').removeClass('finished');
                                }
                            }
                        }

                        lastChange = result.lastChange;
                    }

                    // apply effect
                    var currentEffect     = result.effect[0],
                        currentEffectData = result.effect[1],
                        currentEffectTime = result.effect['timestamp'];

                    if (
                        currentEffect !== ''
                        && (effects.running != currentEffect || effects.timestamp < currentEffectTime)
                    ) {
                        effects.running = currentEffect;
                        effects.timestamp = currentEffectTime;

                        if (currentEffect.substr(0, 6) == 'audio-') {
                            effects.play('/sounds/' + currentEffect.substr(6));
                        } else {
                            eval('effects.' + currentEffect + '(' + currentEffectData + ')')
                        }
                    }
                }
            }).always(function () {
                isRefreshRunning = false;
            });
        }
    }, REFRESH_INTERVAL);
})(jQuery);