<?php

namespace DucCnzj\EventBus\Mq;

use DucCnzj\EventBus\Mq\MqClient;


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
    }
}