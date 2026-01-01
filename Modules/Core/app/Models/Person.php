<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "persons";
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'sex_id',
    ];

    public function sex()
    {
        return $this->belongsTo(Sex::class);
    }
}
