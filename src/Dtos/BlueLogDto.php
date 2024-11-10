<?php

namespace Ch17\BlueLog\Dtos;

use Illuminate\Support\Facades\Validator;

class BlueLogDto
{
    protected $channel;
    protected $level;
    protected $message;
    protected $context;
    protected $extras;
    protected $createdBy;

    /**
     * BlueLogDto constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->channel = $data['channel'] ?? config('bluelog.default_channel');
        $this->level = $data['level'] ?? config('bluelog.default_level', 'info');
        $this->message = $data['message']?? '';
        $this->context = $data['context'] ?? [];
        $this->extras = $data['extras'] ?? [];
        $this->createdBy = $data['created_by'] ?? null;
    }

     /**
     * Getter method to access protected properties.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception("Property {$name} does not exist in " . __CLASS__);
    }

    /**
     * Setter method to set protected properties.
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new \Exception("Property {$name} does not exist in " . __CLASS__);
        }
    }

    /**
     * Validate the DTO data.
     *
     * @return mixed
     */
    public function validate()
    {
        $validator = Validator::make((array)$this, [
            'level' => 'required|string',
            'message' => 'required|string',
            'channel' => 'nullable|string',
            'context' => 'nullable|array',
            'extras' => 'nullable|array',
            'created_by' => 'nullable|array',
        ]);

        return $validator->fails() ? $validator->errors() : true;
    }

    /**
     * Convert DTO properties to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'channel' => $this->channel,
            'level' => $this->level,
            'message' => $this->message,
            'context' => $this->context,
            'extras' => $this->extras,
            'created_by' => $this->createdBy,
            'created_at' => $this->createdAt,
        ];
    }

    /**
     * Get the current timestamp for 'created_at'.
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return now()->format('Y-m-d H:i:s.u');
    }
}
