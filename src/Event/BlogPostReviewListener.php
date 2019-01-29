<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

/**
 * Class BlogPostReviewListener
 * @package App\Event
 */
class BlogPostReviewListener implements EventSubscriberInterface
{
    /**
     * @param GuardEvent $event
     */
    public function guardReview(GuardEvent $event): void
    {
        /** @var \App\Entity\BlogPost $post */
        $post = $event->getSubject();
        $title = $post->getTitle();

        if (empty($title) || $title === '' || $title === null) {
            // Posts with no title should not be allowed
            $event->setBlocked(true);
            throw new \LogicException('No title');
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.blog_publishing.guard.to_review' => ['guardReview'],
        ];
    }
}