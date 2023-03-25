<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
    	'id',
        'category_name',
        'status',
    ];

    public function Category(){
    	//return $this->hasOne('App\Models\Product','id','category_id');

    }
}
