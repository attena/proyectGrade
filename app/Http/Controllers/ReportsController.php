<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Poll;
use App\Models\Feelings;
use App\Models\QuestionResponse;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(Request $request)
    {

        $feelings = Feelings::where("response", 1)->count();
        $feelings2 = Feelings::where("response", 2)->count();
        $feelings3 = Feelings::where("response", 3)->count();

        $detractor = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [1, 6])
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $neutral = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [7, 8])
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $promotor = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [9, 10])
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();

        $td = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 'td')
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();

        $deac = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 'deac')
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $nidd = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 'nidd')
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $ds = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 'ds')
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $tds = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 'tds')
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();

        $yes = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 'yes')
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $no = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 'no')
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();

        $results = array(
            "enojado" => $feelings3,
            "satisfecho" => $feelings,
            "insatisfecho" => $feelings2,
            "detractor" => $detractor,
            "neutral" =>  $neutral,
            "promoter" => $promotor,
            "td" => $td,
            "deac" => $deac,
            "nidd" => $nidd,
            "ds" => $ds,
            "tds" => $tds,
            "yes" => $yes,
            "no" => $no
        );

        return response()->json($results, 200);
    }
}
