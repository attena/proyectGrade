<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PollQuestions;
use App\Models\Feelings;
use App\Models\QuestionResponse;


class PollClientController extends Controller
{

    public function store(Request $request)
    {   
        Feelings::insert([
            'idPolls' => $request['idPoll'],
            'response' => $request['feeling']
        ]);

        foreach ($request['questions'] as  $value) {

            QuestionResponse::insert(
                [
                    'idPolls' => $request['idPoll'],
                    'idQuestions' => $value['id'],
                    'response' => $value['response']
                ]
            );
        }

        return response()->json($request, 200);
    }

    public function show($id)
    {

        $getPolls = PollQuestions::join('polls', "polls.idPolls", "=", "poll_questions.idPolls")
            ->join('questions', "questions.idQuestions", "=", "poll_questions.idQuestion")
            ->where("polls.code", $id)
            ->select("questions.idQuestions", "questions.name as question", "type", "polls.idPolls", "polls.idPolls")->paginate(1);

        return response()->json($getPolls, 200);
    }
}
