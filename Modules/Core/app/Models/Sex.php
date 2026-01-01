<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sex extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sexes";
    protected $fillable = ['name'];

    public function persons()
    {
        return $this->hasMany(Person::class);
    }
}
