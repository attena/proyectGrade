<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'type',
    ];
    protected $primaryKey = 'idQuestions';
}
