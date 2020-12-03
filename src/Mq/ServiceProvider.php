<?php

namespace DucCnzj\EventBus\Mq;

use DucCnzj\EventBus\Mq\MqClient;
use DucCnzj\EventBus\Mq\MqTopicClient;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MqClient::class);
        $this->app->when(MqClient::class)
            ->needs('$hostname')
            ->give(env("MQ_HOST", ""));
        $this->app->when(MqClient::class)
            ->needs('$opts')
            ->give([
                'credentials' => \Grpc\ChannelCredentials::createInsecure(),
            ]);
        $this->app->singleton(MqTopicClient::class);
        $this->app->when(MqTopicClient::class)
            ->needs('$hostname')
            ->give(env("MQ_HOST", ""));
        $this->app->when(MqTopicClient::class)
            ->needs('$opts')
            ->give([
                'credentials' => \Grpc\ChannelCredentials::createInsecure(),
            ]);
    }
}