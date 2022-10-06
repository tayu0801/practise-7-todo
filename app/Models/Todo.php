<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','tag_id','task_name'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tag(){
      return $this->belongsTo(Tag::class);
    }
}
