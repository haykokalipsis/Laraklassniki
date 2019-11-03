<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = ['requester', 'responder', 'status'];
}
