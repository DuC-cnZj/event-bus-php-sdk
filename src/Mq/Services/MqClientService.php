<?php

namespace DucCnzj\EventBus\Mq\Services;

use DucCnzj\EventBus\Mq\Pub;
use DucCnzj\EventBus\Mq\DelayPublishRequest;
use DucCnzj\EventBus\Mq\Sub;
use DucCnzj\EventBus\Mq\QueueId;
use DucCnzj\EventBus\Mq\MqClient;


class MqClientService
{
    /**
     * @var MqClient
     */
    protected $client;

    public function __construct()
    {
        $this->client = app(MqClient::class);
    }

    /**
     * @param array|Pub $data {
     *     Optional. Data for populating the Message object.
     *
     * @param string $data
     * @param string $queue
     * }
     * @param bool $asArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\Response|array
     */
    public function publish($data = '', $queue = '', $asArray = true, $metadata = [], $options = [])
    {
        $input = ["data" => $data, "queue" => $queue];
        $request = $input;
        if (is_array($input)) {
            $request = new Pub();
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
            if ($asArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
    /**
     * @param array|DelayPublishRequest $data {
     *     Optional. Data for populating the Message object.
     *
     * @param string $data
     * @param string $queue
     * @param int|string $seconds
     * }
     * @param bool $asArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\Response|array
     */
    public function delayPublish($data = '', $queue = '', $seconds = '', $asArray = true, $metadata = [], $options = [])
    {
        $input = ["data" => $data, "queue" => $queue, "seconds" => $seconds];
        $request = $input;
        if (is_array($input)) {
            $request = new DelayPublishRequest();
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
            if ($asArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
    /**
     * @param array|Sub $data {
     *     Optional. Data for populating the Message object.
     *
     * @param string $queue
     * }
     * @param bool $asArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\Response|array
     */
    public function subscribe($queue = '', $asArray = true, $metadata = [], $options = [])
    {
        $input = ["queue" => $queue];
        $request = $input;
        if (is_array($input)) {
            $request = new Sub();
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
            if ($asArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
    /**
     * @param array|QueueId $data {
     *     Optional. Data for populating the Message object.
     *
     * @param int|string $id
     * }
     * @param bool $asArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\Response|array
     */
    public function ack($id = '', $asArray = true, $metadata = [], $options = [])
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
            if ($asArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
}