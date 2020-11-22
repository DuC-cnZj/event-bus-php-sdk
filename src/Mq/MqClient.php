<?php
// GENERATED CODE -- DO NOT EDIT!

namespace DucCnzj\EventBus\Mq;

/**
 */
class MqClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\Pub $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function publish(\DucCnzj\EventBus\Mq\Pub $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.Mq/publish',
        $argument,
        ['\DucCnzj\EventBus\Mq\Response', 'decode'],
        $metadata, $options);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\DelayPublishRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function delayPublish(\DucCnzj\EventBus\Mq\DelayPublishRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.Mq/delayPublish',
        $argument,
        ['\DucCnzj\EventBus\Mq\Response', 'decode'],
        $metadata, $options);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\Sub $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function subscribe(\DucCnzj\EventBus\Mq\Sub $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.Mq/subscribe',
        $argument,
        ['\DucCnzj\EventBus\Mq\Response', 'decode'],
        $metadata, $options);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\QueueId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ack(\DucCnzj\EventBus\Mq\QueueId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.Mq/ack',
        $argument,
        ['\DucCnzj\EventBus\Mq\Response', 'decode'],
        $metadata, $options);
    }

}
