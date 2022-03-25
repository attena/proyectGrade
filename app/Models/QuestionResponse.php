<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    protected $table = 'question_response';
    protected $fillable = [
        'idQuestions',
        'idPolls',
        'response'
    ];
    protected $primaryKey = 'idquestion_response';
}
