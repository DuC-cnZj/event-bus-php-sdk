<?php

namespace DucCnzj\EventBus\Mq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \DucCnzj\EventBus\Mq\Response|array publish($data = [], bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array delayPublish($data = [], bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array subscribe($data = [], bool $asArray = true, $metadata = [], $options = [])
 * @method static \DucCnzj\EventBus\Mq\Response|array ack($data = [], bool $asArray = true, $metadata = [], $options = [])
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