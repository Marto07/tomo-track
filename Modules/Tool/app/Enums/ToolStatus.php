<?php

namespace Modules\Tool\Enums;

enum ToolStatus : string
{
    case AVAILABLE = 'available';
    case IN_USE = 'in_use';
    case BROKEN = 'broken';
    case LOST = 'lost';
    case MAINTENANCE = 'maintenance';

    public function label(): string 
    {
        return match($this) {
            ToolStatus::AVAILABLE => 'Available',
            ToolStatus::IN_USE => 'In Use',
            ToolStatus::BROKEN => 'Broken',
            ToolStatus::LOST => 'Lost',
            ToolStatus::MAINTENANCE => 'Maintenance'
        };
    }
}
