<?php

namespace Modules\Tool\Classes\DTO;

class TransferToolData
{
    public int $tool_id;
    public int $from_location_id;
    public int $to_location_id;
    public int $quantity;

    public function __construct(
        int $tool_id, 
        int $from_location_id, 
        int $to_location_id,
        int $quantity,
    ) {
        $this->tool_id          = $tool_id;
        $this->from_location_id = $from_location_id;
        $this->to_location_id   = $to_location_id;
        $this->quantity         = $quantity;
    }

    public static function createFromArray(array $data) : self
    {
        return new self(
            $data['tool_id'], 
            $data['from_location_id'], 
            $data['to_location_id'],
            $data['quantity']
        );
    }
}
