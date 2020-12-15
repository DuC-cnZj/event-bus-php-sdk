<?php

namespace DucCnzj\EventBus\Mq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \Google\Protobuf\GPBEmpty|array publish($topic = '', $data = '', $expirationSeconds = 0, bool $asArray = true, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array delayPublish($topic = '', $data = '', $delaySeconds = 0, $expirationSeconds = 0, bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\SubscribeResponse|array subscribe($topic = '', $queueName = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array ack($id = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array nack($id = '', bool $asArray = true, $metadata = [], $options = [])
 *
 * Class MqTopicClient
 */
class MqTopicClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DucCnzj\EventBus\Mq\Services\MqTopicClientService::class;
    }
}