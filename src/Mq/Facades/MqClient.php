<?php

namespace DucCnzj\EventBus\Mq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \Google\Protobuf\GPBEmpty|array publish($queue = '', $data = '', $expirationSeconds = 0, bool $toArray = false, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array delayPublish($queue = '', $data = '', $delaySeconds = 0, $expirationSeconds = 0, bool $toArray = false, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\SubscribeResponse|array subscribe($queue = '', bool $toArray = false, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array ack($id = '', bool $toArray = false, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array nack($id = '', bool $toArray = false, $metadata = [], $options = [])
 *
 * Class MqClient
 */
class MqClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DucCnzj\EventBus\Mq\Services\MqClientService::class;
    }
}