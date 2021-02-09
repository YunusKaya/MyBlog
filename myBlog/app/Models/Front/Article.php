<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function getCategory()
    {
        return $this->hasOne('App\Models\Front\Category','id','category_id');
    }

    public function getUser()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
