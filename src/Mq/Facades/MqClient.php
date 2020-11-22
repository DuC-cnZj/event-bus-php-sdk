<?php

namespace DucCnzj\EventBus\Mq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \DucCnzj\EventBus\Mq\Response|array publish($data = '', $queue = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array delayPublish($data = '', $queue = '', $seconds = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array subscribe($queue = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array ack($id = '', bool $asArray = true, $metadata = [], $options = [])
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