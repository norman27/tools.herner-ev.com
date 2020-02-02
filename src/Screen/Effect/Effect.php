<?php

namespace App\Screen\Effect;

final class Effect
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $data;

    /**
     * @var int The timestamp when this was set
     */
    public $lastChange;

    public function __construct(string $id, string $name, array $data = [], $lastChange = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->data = $data;
        $this->lastChange = ($lastChange > 0) ? $lastChange : time();
    }
}