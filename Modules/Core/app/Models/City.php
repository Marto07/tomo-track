<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cities';
    protected $fillable = ['name', 'state_id', 'postal_code'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
