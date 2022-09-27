<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articleCount()
    {
        return $this->hasMany('App\Models\Front\Article','category_id','id')->count();
        //Mağlanacağımız Model // Bağlanacağımız ID //Bağlanılacak ID
    }
}
