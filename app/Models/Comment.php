<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_name', 'comment', 'commentable_id', 'commentable_type'];

    public function commentable()
    {
        return $this->morphTo();
    }
}
