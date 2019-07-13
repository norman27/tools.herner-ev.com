<?php

namespace AppBundle\Screen\Audio;

use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\ClockMock;

/**
 * @group time-sensitive
 */
class AudioSettingsTest extends TestCase
{
    public function test_construct_useCurrentTimestampWhenNotPassedIn()
    {
        ClockMock::register(AudioSettings::class);
        $settings = new AudioSettings('track', 80);
        $this->assertSame(time(), $settings->lastChange);
    }
}