<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $table = 'polls';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code',
        'date',
    ];
    protected $primaryKey = 'idPolls';
}
