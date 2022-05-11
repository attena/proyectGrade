<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feelings;
use App\Models\QuestionResponse;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(Request $request)
    {

        //dd($request->all());
        $feelings = Feelings::where("response", 1)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('date')->select('date', DB::raw('count(idFeelings) as total'))->get();
        $feelings2 = Feelings::where("response", 2)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->input('poll')) {
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('date')->select('date', DB::raw('count(idFeelings) as total'))->get();
        $feelings3 = Feelings::where("response", 3)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('date')->select('date', DB::raw('count(idFeelings) as total'))->get();

        $feelingsPie = Feelings::where("response", 1)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                }
            })->count();
        $feelings2Pie = Feelings::where("response", 2)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                }
            })
            ->count();
        $feelings3Pie = Feelings::where("response", 3)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('date', array($request->get('init'), $request->get('end')));
                }
            })
            ->count();

        $detractor = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [1, 6])
            ->where('questions.type', 2)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('question_response.date')
            ->select('question_response.date', DB::raw('count(question_response.response) as total'))
            ->get();
        $neutral = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [7, 8])
            ->where('questions.type', 2)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('question_response.date')
            ->select('question_response.date', DB::raw('count(question_response.response) as total'))
            ->get();
        $promotor = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [9, 10])
            ->where('questions.type', 2)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('question_response.date')
            ->select('question_response.date', DB::raw('count(question_response.response) as total'))
            ->get();

        $ta = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 5)
            ->where('questions.type', 3)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();

        $deac = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 4)
            ->where('questions.type', 3)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $nidd = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 3)
            ->where('questions.type', 3)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $ds = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 2)
            ->where('questions.type', 3)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $tds = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 1)
            ->where('questions.type', 3)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();

        $yes = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 1)
            ->where('questions.type', 1)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();
        $no = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('response', 0)
            ->where('questions.type', 1)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->groupBy('name')
            ->select('questions.name', DB::raw('count(question_response.response) as total'))
            ->get();

        $words = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->where('questions.type', 4)
            ->when($request, function ($query) use ($request) {
                if ($request->get('poll') && $request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('poll')) {
                    $query->where('question_response.idPolls', $request->get('poll'));
                } else if ($request->get('init') && $request->get('end')) {
                    $query->whereBetween('question_response.date', array($request->get('init'), $request->get('end')));
                }
            })
            ->select('question_response.response',)
            ->get();

        $strWords = [];
        $out = [];
        foreach ($words as  $value) {
            $str = explode(' ', $value->response);
            array_push($strWords, ...$str);
        }

        foreach ($strWords as $word) {
            if (!in_array($word, config("blacklistword"))) {
                $out[] = $word;
            }
        }

        $dataWords = array_count_values($out);

        $detractorGeneral = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [1, 6])
            ->where('questions.type', 2)
            ->count();
        $neutralGeneral = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [7, 8])
            ->where('questions.type', 2)
            ->count();
        $promotorGeneral = QuestionResponse::join('questions', "questions.idQuestions", "=", "question_response.idQuestions")
            ->whereBetween('response', [9, 10])
            ->where('questions.type', 2)
            ->count();

        $results = array(
            "enojado" => $feelings3,
            "satisfecho" => $feelings,
            "insatisfecho" => $feelings2,
            "enojadoPie" => $feelings3Pie,
            "satisfechoPie" => $feelingsPie,
            "insatisfechoPie" => $feelings2Pie,
            "detractor" => $detractor,
            "neutral" =>  $neutral,
            "promoter" => $promotor,
            "ta" => $ta,
            "deac" => $deac,
            "nidd" => $nidd,
            "ds" => $ds,
            "tds" => $tds,
            "yes" => $yes,
            "no" => $no,
            'detractorGeneral' => $detractorGeneral,
            'neutralGeneral' => $neutralGeneral,
            'promotorGeneral' => $promotorGeneral,
            'words' => $dataWords
        );

        return response()->json($results, 200);
    }
}
