<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feelings extends Model
{
    protected $table = 'feelings';
    protected $fillable = [
        'idPolls',
        'response'
    ];
    protected $primaryKey = 'idFeelings';
}
