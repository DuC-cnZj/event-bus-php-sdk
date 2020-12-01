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
     * @param \DucCnzj\EventBus\Mq\PublishRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function publish(\DucCnzj\EventBus\Mq\PublishRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.Mq/publish',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
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
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\SubscribeRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function subscribe(\DucCnzj\EventBus\Mq\SubscribeRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.Mq/subscribe',
        $argument,
        ['\DucCnzj\EventBus\Mq\SubscribeResponse', 'decode'],
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
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\QueueId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function nack(\DucCnzj\EventBus\Mq\QueueId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.Mq/nack',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
