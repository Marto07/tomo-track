<?php

namespace Modules\Item\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Item\Database\Factories\StockItemFactory;
use Modules\Location\Models\Location;

class StockItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'item_id',
        'location_id',
        'quantity',
        'status',
        'serial_number',
        'created_by',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // protected static function newFactory(): StockItemFactory
    // {
    //     // return StockItemFactory::new();
    // }
}
