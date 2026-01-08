<?php

namespace Modules\Tool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Location\Models\Location;
use Modules\Tool\Enums\ToolStatus;

class StockTool extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stock_tools';

    protected $fillable = [
        'tool_id',
        'location_id',
        'serial_number',
        'status',
        'quantity',
        'created_by',
    ];

    protected $casts = [
        'status' => ToolStatus::class,
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
