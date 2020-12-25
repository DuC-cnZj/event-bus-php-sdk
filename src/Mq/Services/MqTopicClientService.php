<?php

namespace DucCnzj\EventBus\Mq\Services;

use DucCnzj\EventBus\Mq\TopicPublishRequest;
use DucCnzj\EventBus\Mq\DelayTopicPublishRequest;
use DucCnzj\EventBus\Mq\TopicSubscribeRequest;
use DucCnzj\EventBus\Mq\QueueId;
use DucCnzj\EventBus\Mq\MqTopicClient;


class MqTopicClientService
{
    /**
     * @var MqTopicClient
     */
    protected $client;

    public function __construct(MqTopicClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $topic
     * @param string $data
     * @param int|string $expirationSeconds
     * @param bool $toArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \Google\Protobuf\GPBEmpty|array
     */
    public function publish($topic = '', $data = '', $expirationSeconds = 0, $toArray = false, $metadata = [], $options = [])
    {
        $input = ["topic" => $topic, "data" => $data, "expirationSeconds" => $expirationSeconds];
        $request = $input;
        if (is_array($input)) {
            $request = new TopicPublishRequest();
            foreach($input as $key => $value) {
                $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
                if (method_exists($request, $method)) {
                    $request->$method($value);
                }
            }
        }
        // TODO 不写死
        if (isset($_SERVER['UBER-TRACE-ID'])) {
            $metadata['UBER-TRACE-ID'] = [$_SERVER['UBER-TRACE-ID']];
        }
        $metadata["UID"] = [(string)auth()->id()];
        [$data, $response] = $this->client->publish($request, $metadata, $options)->wait();
        if ($response->code == \Grpc\CALL_OK) {
            if ($toArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
    /**
     * @param string $topic
     * @param string $data
     * @param int|string $delaySeconds
     * @param int|string $expirationSeconds
     * @param bool $toArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \Google\Protobuf\GPBEmpty|array
     */
    public function delayPublish($topic = '', $data = '', $delaySeconds = 0, $expirationSeconds = 0, $toArray = false, $metadata = [], $options = [])
    {
        $input = ["topic" => $topic, "data" => $data, "delaySeconds" => $delaySeconds, "expirationSeconds" => $expirationSeconds];
        $request = $input;
        if (is_array($input)) {
            $request = new DelayTopicPublishRequest();
            foreach($input as $key => $value) {
                $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
                if (method_exists($request, $method)) {
                    $request->$method($value);
                }
            }
        }
        // TODO 不写死
        if (isset($_SERVER['UBER-TRACE-ID'])) {
            $metadata['UBER-TRACE-ID'] = [$_SERVER['UBER-TRACE-ID']];
        }
        $metadata["UID"] = [(string)auth()->id()];
        [$data, $response] = $this->client->delayPublish($request, $metadata, $options)->wait();
        if ($response->code == \Grpc\CALL_OK) {
            if ($toArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
    /**
     * @param string $topic
     * @param string $queueName
     * @param bool $toArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\SubscribeResponse|array
     */
    public function subscribe($topic = '', $queueName = '', $toArray = false, $metadata = [], $options = [])
    {
        $input = ["topic" => $topic, "queueName" => $queueName];
        $request = $input;
        if (is_array($input)) {
            $request = new TopicSubscribeRequest();
            foreach($input as $key => $value) {
                $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
                if (method_exists($request, $method)) {
                    $request->$method($value);
                }
            }
        }
        // TODO 不写死
        if (isset($_SERVER['UBER-TRACE-ID'])) {
            $metadata['UBER-TRACE-ID'] = [$_SERVER['UBER-TRACE-ID']];
        }
        $metadata["UID"] = [(string)auth()->id()];
        [$data, $response] = $this->client->subscribe($request, $metadata, $options)->wait();
        if ($response->code == \Grpc\CALL_OK) {
            if ($toArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
    /**
     * @param string $id
     * @param bool $toArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \Google\Protobuf\GPBEmpty|array
     */
    public function ack($id = '', $toArray = false, $metadata = [], $options = [])
    {
        $input = ["id" => $id];
        $request = $input;
        if (is_array($input)) {
            $request = new QueueId();
            foreach($input as $key => $value) {
                $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
                if (method_exists($request, $method)) {
                    $request->$method($value);
                }
            }
        }
        // TODO 不写死
        if (isset($_SERVER['UBER-TRACE-ID'])) {
            $metadata['UBER-TRACE-ID'] = [$_SERVER['UBER-TRACE-ID']];
        }
        $metadata["UID"] = [(string)auth()->id()];
        [$data, $response] = $this->client->ack($request, $metadata, $options)->wait();
        if ($response->code == \Grpc\CALL_OK) {
            if ($toArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
    /**
     * @param string $id
     * @param bool $toArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \Google\Protobuf\GPBEmpty|array
     */
    public function nack($id = '', $toArray = false, $metadata = [], $options = [])
    {
        $input = ["id" => $id];
        $request = $input;
        if (is_array($input)) {
            $request = new QueueId();
            foreach($input as $key => $value) {
                $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
                if (method_exists($request, $method)) {
                    $request->$method($value);
                }
            }
        }
        // TODO 不写死
        if (isset($_SERVER['UBER-TRACE-ID'])) {
            $metadata['UBER-TRACE-ID'] = [$_SERVER['UBER-TRACE-ID']];
        }
        $metadata["UID"] = [(string)auth()->id()];
        [$data, $response] = $this->client->nack($request, $metadata, $options)->wait();
        if ($response->code == \Grpc\CALL_OK) {
            if ($toArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
}