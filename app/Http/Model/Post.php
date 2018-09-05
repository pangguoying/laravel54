<?php

namespace App\Http\Model;

use App\Http\Model\Model;

class Post extends Model
{
    //关联用户
    public function user() {
        return $this->belongsTo("App\Http\Model\User");
    }

    //评论模型
    public function comments(){
        return $this->hasMany('App\Http\Model\Comment')->orderBy('created_at');
    }
}
