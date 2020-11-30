<?php

namespace DucCnzj\EventBus\Mq\Services;

use DucCnzj\EventBus\Mq\PublishRequest;
use DucCnzj\EventBus\Mq\DelayPublishRequest;
use DucCnzj\EventBus\Mq\SubscribeRequest;
use DucCnzj\EventBus\Mq\QueueId;
use DucCnzj\EventBus\Mq\MqClient;


class MqClientService
{
    /**
     * @var MqClient
     */
    protected $client;

    public function __construct(MqClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $queue
     * @param string $data
     * @param bool $asArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\Response|array
     */
    public function publish($queue = '', $data = '', $asArray = true, $metadata = [], $options = [])
    {
        $input = ["queue" => $queue, "data" => $data];
        $request = $input;
        if (is_array($input)) {
            $request = new PublishRequest();
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
     * @param string $queue
     * @param string $data
     * @param int|string $seconds
     * @param bool $asArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\Response|array
     */
    public function delayPublish($queue = '', $data = '', $seconds = 0, $asArray = true, $metadata = [], $options = [])
    {
        $input = ["queue" => $queue, "data" => $data, "seconds" => $seconds];
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
     * @param string $queue
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
            $request = new SubscribeRequest();
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
     * @param string $id
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
    /**
     * @param string $id
     * @param bool $asArray
     * @param array $metadata metadata
     * @param array $options call options
     *
     * @return \DucCnzj\EventBus\Mq\Response|array
     */
    public function nack($id = '', $asArray = true, $metadata = [], $options = [])
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
            if ($asArray) {
                return json_decode($data->serializeToJsonString(), true);
            }

            return $data;
        }

        throw new \Exception("Mq rpc client error: " . $response->details, $response->code);
    }
}