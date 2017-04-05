<?php

namespace spec\JDR\EventRecorderDoctrineBridge;

use JDR\EventRecorder\EventRecorder;
use JDR\EventRecorderDoctrineBridge\CollectEventsFromEntity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectEventsFromEntitySpec extends ObjectBehavior
{
    function let(EventRecorder $recorder)
    {
        $this->beConstructedWith($recorder);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CollectEventsFromEntity::class);
    }
}
