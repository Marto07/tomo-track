<?php

namespace Modules\Tool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Tool\Database\Factories\ToolFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tool\Models\Category;
use Modules\Company\Models\Company;
use Modules\Tool\Database\Factories\ToolFactory;

class Tool extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tools'; 

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function newFactory() : ToolFactory
    {
        return ToolFactory::new();
    } 



  
}
