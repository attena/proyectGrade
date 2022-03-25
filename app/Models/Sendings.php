<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sendings extends Model
{
    protected $table = 'sendings';
    public $timestamps = false;
    protected $fillable = [
        'date_start',
        'date_end',
        'idPolls',
    ];
    protected $primaryKey = 'idsendings';
}
