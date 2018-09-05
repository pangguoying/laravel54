<?php

namespace App\Http\Model;

use App\Http\Model\Model;

class Comment extends Model
{
    //评论所属文章
    public function post() {
        return $this->belongsTo('App\Http\Model\Post');
    }
    //评论所属用户
    public function user() {
        return $this->belongsTo('App\Http\Model\User');
    }
}
