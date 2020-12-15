<?php

namespace DucCnzj\EventBus\Mq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \Google\Protobuf\GPBEmpty|array publish($queue = '', $data = '', $expiration = 0, bool $asArray = true, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array delayPublish($queue = '', $data = '', $delaySeconds = 0, $expiration = 0, bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\SubscribeResponse|array subscribe($queue = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array ack($id = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \Google\Protobuf\GPBEmpty|array nack($id = '', bool $asArray = true, $metadata = [], $options = [])
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