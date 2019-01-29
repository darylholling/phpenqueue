<?php

namespace App\Controller;

use Enqueue\Client\ProducerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enqueue")
 */
class EnqueueController
{
    /**
     * @Route("/", name="enqueue_sendMessage")
     * @param ProducerInterface $producer
     */
    public function sendMessage(ProducerInterface $producer): void
    {

        $receivedAt = (int) (microtime(true) * 1000);

        // heavy processing here.

//        $statsStorage = (new GenericStatsStorageFactory())->create('influxdb://http://192.168.35.105:8086?db=symfony_influx');

//        $statsStorage->pushConsumedMessageStats(new ConsumedMessageStats(
//            'consumerId',
//            (int) (microtime(true) * 1000), // now
//            $receivedAt,
//            'aQueue',
//            'aMessageId',
//            'aCorrelationId',
//            [], // headers
//            [], // properties
//            false, // redelivered or not
//            ConsumedMessageStats::STATUS_ACK
//        ));

        $producer->sendEvent('aTopic', 'Something has happened - ');

        $producer->sendCommand('aCommand', 'Something has happened with command');

        die();
    }
}