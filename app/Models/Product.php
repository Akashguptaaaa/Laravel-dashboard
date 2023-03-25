<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Category(){
    	//return $this->belongTo('App\Models\Category','category_id','id');
    	return $this->belongsTo(Category::class);
    }


     public function ProductFeature(){
    	//return $this->belongTo('App\Models\Category','category_id','id');
    	return $this->hasMany(ProductFeature::class,'product_id','id');
    }
}
