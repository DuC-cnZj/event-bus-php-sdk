<?php

namespace DucCnzj\EventBus\Mq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \DucCnzj\EventBus\Mq\Response|array publish($queue = '', $data = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array delayPublish($queue = '', $data = '', $seconds = 0, bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array subscribe($queue = '', bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array ack($id = 0, bool $asArray = true, $metadata = [], $options = [])
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