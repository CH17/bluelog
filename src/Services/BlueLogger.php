<?php

namespace Ch17\BlueLog\Services;

use Ch17\BlueLog\Models\Log as BlueLog;
use Ch17\BlueLog\LogLevels;
use Carbon\Carbon;
use Ch17\BlueLog\Dtos\BlueLogDto;

class BlueLogger
{
    /**
    * Main logging method that decides whether to call the array-based or traditional method.
    *
    * @param mixed $channelOrData
    * @param string|null $level
    * @param string|null $message
    * @param array $context
    * @param array $extras
    */
    public function log(...$params)
    {
        if (count($params) === 1 && is_array($params[0])) {
            $logDto = $this->prepareLogDtoFromArray($params[0]);
        } else {
            $channel = $params[1];
            $level = $params[0];
            $message = $params[2] ?? '';
            $context = $params[3] ?? [];
            $extras = $params[4] ?? [];

            $logDto = $this->prepareLogDto($level, $channel, $message, $context, $extras);
        }

        $this->createLog($logDto);
    }

    public function info(...$params)
    {
        if (count($params) === 1 && is_array($params[0])) {
            $params[0]['level'] = 'info';
            $this->log($params[0]);
        } else {
            $this->log('info', ...$params);
        }
    }

    public function debug(...$params)
    {
        if (count($params) === 1 && is_array($params[0])) {
            $params[0]['level'] = 'debug';
            $this->log($params[0]);
        } else {
            $this->log('debug', ...$params);
        }
    }

    public function warning(...$params)
    {
        if (count($params) === 1 && is_array($params[0])) {
            $params[0]['level'] = 'warning';
            $this->log($params[0]);
        } else {
            $this->log('warning', ...$params);
        }
    }

    public function error(...$params)
    {
        if (count($params) === 1 && is_array($params[0])) {
            $params[0]['level'] = 'error';
            $this->log($params[0]);
        } else {
            $this->log('error', ...$params);
        }
    }

    /**
    * Log with an array containing all the necessary data.
    *
    * @param array $data
    */
    private function prepareLogDtoFromArray(array $data): BlueLogDto
    {
        $level = $data['level']?? '';
        $channel = $data['channel']?? '';
        $message = $data['message'] ?? '';
        $context = $data['context'] ?? [];
        $extras = $data['extras'] ?? [];

        return $this->prepareLogDto($level, $channel, $message, $context, $extras);
    }

    private function prepareLogDto($level, $channel, $message, array $context = [], array $extras = []): BlueLogDto
    {
        return new BlueLogDto([
            'channel' => $channel,
            'level' => $level,
            'message' => $message,
            'context' => $context,
            'extras' => $extras,
            'created_by' => $this->getLoggedInUser()
        ]);
    }

    /**
    * Helper method to create a BlueLogDto from the traditional parameters.
    *
    * @param string $level
    * @param string $channel
    * @param string $message
    * @param array $context
    * @param array $extras
    * @return BlueLogDto
    */
    protected function createLogDto($level, $channel, $message, array $context, array $extras)
    {
        return new BlueLogDto([
            'level' => $level,
            'message' => $message,
            'channel' => $channel,
            'context' => $context,
            'extras' => $extras,
        ]);
    }

    protected function createLog(BlueLogDto $logDto)
    {
            BlueLog::create([
                'channel' => $logDto->channel,
                'level' => LogLevels::getLevelInt($logDto->level),
                'level_name' => $logDto->level,
                'message' => $logDto->message,
                'context' => $logDto->context,
                'extras' => $logDto->extras,
                'created_by' => $logDto->createdBy,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s.u'),
            ]);
    }

    private function getLoggedInUser(){
        if (config('bluelog.store_logged_by', true)) {
            if (auth()->check()) {
                $userFields = config('bluelog.logged_by_fields', ['id', 'email']);
                $userData = [];
                $user = auth()->user();

                 foreach ($userFields as $field) {
                    if (isset($user->{$field})) {
                        $userData[$field] = $user->{$field};
                    }
                }

                return $userData;
            }
        }
        return null;
    }
}
