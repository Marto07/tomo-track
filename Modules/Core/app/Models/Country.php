<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'countries';
    protected $fillable = ['name', 'code'];

    public function states()
    {
        return $this->hasMany(State::class);
    }


}
