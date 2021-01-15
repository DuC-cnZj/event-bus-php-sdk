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

    /**
     * @var \Closure[]
     */
    protected $middlewares;

    public function __construct(MqTopicClient $client, array $middlewares = [])
    {
        $this->client = $client;
        $this->middlewares = $middlewares;
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

        $result = array_reduce(
            array_reverse($this->middlewares),
            function ($start, $handler) {
                return function ($metadata) use ($start, $handler) {
                    return $handler($metadata, $start);
                };
            }, function ($metadata) use ($request, $options) {
               return $this->client->publish($request, $metadata, $options)->wait();
            }
        );
        [$data, $response] = $result($metadata);

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

        $result = array_reduce(
            array_reverse($this->middlewares),
            function ($start, $handler) {
                return function ($metadata) use ($start, $handler) {
                    return $handler($metadata, $start);
                };
            }, function ($metadata) use ($request, $options) {
               return $this->client->delayPublish($request, $metadata, $options)->wait();
            }
        );
        [$data, $response] = $result($metadata);

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

        $result = array_reduce(
            array_reverse($this->middlewares),
            function ($start, $handler) {
                return function ($metadata) use ($start, $handler) {
                    return $handler($metadata, $start);
                };
            }, function ($metadata) use ($request, $options) {
               return $this->client->subscribe($request, $metadata, $options)->wait();
            }
        );
        [$data, $response] = $result($metadata);

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

        $result = array_reduce(
            array_reverse($this->middlewares),
            function ($start, $handler) {
                return function ($metadata) use ($start, $handler) {
                    return $handler($metadata, $start);
                };
            }, function ($metadata) use ($request, $options) {
               return $this->client->ack($request, $metadata, $options)->wait();
            }
        );
        [$data, $response] = $result($metadata);

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

        $result = array_reduce(
            array_reverse($this->middlewares),
            function ($start, $handler) {
                return function ($metadata) use ($start, $handler) {
                    return $handler($metadata, $start);
                };
            }, function ($metadata) use ($request, $options) {
               return $this->client->nack($request, $metadata, $options)->wait();
            }
        );
        [$data, $response] = $result($metadata);

        if ($response->code == \Grpc\CALL_OK) {
            if ($toArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
}