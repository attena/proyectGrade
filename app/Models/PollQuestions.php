<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollQuestions extends Model
{
    protected $table = 'poll_questions';
    protected $fillable = [
        'idQuestion',
        'idPolls',
    ];
    protected $primaryKey = 'idPoll_questions';
}
