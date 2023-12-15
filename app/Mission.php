<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function approver()
    {
        return $this->belongsTo('App\User', 'approve_by', 'id');
    }
}
