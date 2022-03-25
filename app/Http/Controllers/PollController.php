<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PollQuestions;
use App\Models\Questions;
use App\Models\Poll;
use App\Models\Sendings;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    //
    public function index()
    {
        $getPolls = PollQuestions::join('polls', "polls.idPolls", "=", "poll_questions.idPolls")
            ->join('questions', "questions.idQuestions", "=", "poll_questions.idQuestion")
            ->groupBy("poll_questions.idPolls")
            ->select(
                "poll_questions.idPolls",
                DB::raw('count(poll_questions.idQuestion) as total')
            )->get();

        $getPollsName = Poll::get(['name', 'date']);

        return response()->json(array($getPolls, $getPollsName), 200);
    }

    public function store(Request $request)
    {
        $poll = Poll::insertGetId(
            [
                'name' => $request['name'],
                'code' => Str::random(15),
                'date' => Carbon::now()
            ]
        );

        foreach ($request['questions'] as  $value) {

            $question = Questions::insertGetId(
                [
                    'name' => $value['question'],
                    'type' => $value['type']
                ]
            );

            PollQuestions::insert(
                [
                    'idQuestion' => $question,
                    'idPolls' => $poll,
                ]
            );
        }



        return response()->json(true, 200);
    }

    public function show($id)
    {

        $getPolls = PollQuestions::join('polls', "polls.idPolls", "=", "poll_questions.idPolls")
            ->join('questions', "questions.idQuestions", "=", "poll_questions.idQuestion")
            ->where("poll_questions.idPolls", $id)
            ->select("polls.name", "polls.idPolls", "questions.idQuestions", "questions.name as question", "type")->get();

        return response()->json($getPolls, 200);
    }

    public function update(Request $request, $id)
    {

        $sendings = Sendings::where('idPolls', $id)->get();

        if (count($sendings) > 0) {
            return response()->json(false, 200);
        } else {

            Poll::where('idPolls', $id)
                ->update([
                    'name' => $request['name'],
                ]);

            PollQuestions::where("idPolls", $id)->delete();


            foreach ($request['questions'] as  $value) {
                Questions::where("idQuestions", $value['id'])->delete();
            }

            foreach ($request['questions'] as  $value) {

                $question = Questions::insertGetId(
                    [
                        'name' => $value['question'],
                        'type' => $value['type']
                    ]
                );
                PollQuestions::insert(
                    [
                        'idQuestion' => $question,
                        'idPolls' => $id,
                    ]
                );
            }

            return response()->json(true, 200);
        }
    }

    public function destroy($id)
    {

        $polls = PollQuestions::where("idPolls", $id)->get();
        PollQuestions::where("idPolls", $id)->delete();
        Sendings::where("idPolls", $id)->delete();

        foreach ($polls as $value) {
            Questions::where("idQuestions", $value['idQuestion'])->delete();
        }

        Poll::where("idPolls", $id)->delete();

        return response()->json(true, 200);
    }
}
