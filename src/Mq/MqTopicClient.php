<?php
// GENERATED CODE -- DO NOT EDIT!

namespace DucCnzj\EventBus\Mq;

/**
 */
class MqTopicClient extends \Grpc\BaseStub {

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
     * @param \DucCnzj\EventBus\Mq\TopicPublishRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function publish(\DucCnzj\EventBus\Mq\TopicPublishRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.MqTopic/publish',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\DelayTopicPublishRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function delayPublish(\DucCnzj\EventBus\Mq\DelayTopicPublishRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.MqTopic/delayPublish',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * php:inline
     * @param \DucCnzj\EventBus\Mq\TopicSubscribeRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function subscribe(\DucCnzj\EventBus\Mq\TopicSubscribeRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/mq.MqTopic/subscribe',
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
        return $this->_simpleRequest('/mq.MqTopic/ack',
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
        return $this->_simpleRequest('/mq.MqTopic/nack',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
