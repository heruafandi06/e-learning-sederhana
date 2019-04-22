<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'course_name', 'duration', 'description', 'user_id', 'file_upload'
    ];
}
