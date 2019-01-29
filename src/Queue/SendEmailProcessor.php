<?php

namespace App\Queue;


use Enqueue\Client\CommandSubscriberInterface;
use Interop\Queue\Context;
use Interop\Queue\Message;
use Interop\Queue\Processor;

/**
 * Class SendEmailProcessor
 * @package App\Queue
 */
class SendEmailProcessor implements Processor, CommandSubscriberInterface
{
    /**
     * The method has to return either self::ACK, self::REJECT, self::REQUEUE string.
     *
     * The method also can return an object.
     * It must implement __toString method and the method must return one of the constants from above.
     *
     * @param Message $message
     * @param Context $context
     *
     * @return string|object with __toString method implemented
     */
    public function process(Message $message, Context $context)
    {
        echo $message->getBody();

        return self::ACK;
        // return self::REJECT; // when the message is broken
        // return self::REQUEUE; // the message is fine but you want to postpone processing
    }

    /**
     * @return array|string
     */
    public static function getSubscribedCommand()
    {
        return 'aCommand';
    }
}