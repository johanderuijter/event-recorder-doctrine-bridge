<?php declare(strict_types = 1);

namespace JDR\EventRecorderDoctrineBridge;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use JDR\EventRecorder\ContainsRecordedEvents;
use JDR\EventRecorder\EventRecorder;

class CollectEventsFromEntity implements EventSubscriber
{
    /**
     * @var EventRecorder
     */
    private $recorder;

    /**
     * Constructor
     *
     * @param EventRecorder $recorder
     */
    public function __construct(EventRecorder $recorder)
    {
        $this->recorder = $recorder;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        ];
    }

    public function postPersist(LifecycleEventArgs $event)
    {
        $this->collectEventsFromEntity($event);
    }

    public function postUpdate(LifecycleEventArgs $event)
    {
        $this->collectEventsFromEntity($event);
    }

    public function postRemove(LifecycleEventArgs $event)
    {
        $this->collectEventsFromEntity($event);
    }

    private function collectEventsFromEntity(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();
        if ($entity instanceof ContainsRecordedEvents) {
            foreach ($entity->releaseEvents() as $event) {
                $this->recorder->record($event);
            }
        }
    }
}
