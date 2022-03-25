<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Sendings;
use Maatwebsite\Excel\Facades\Excel;

class SendingsController extends Controller
{
    public function index()
    {
        $sends = Sendings::join('polls', "polls.idPolls", "=", "sendings.idPolls")->get();
        return response()->json($sends, 200);
    }

    public function store(Request $request){

        Sendings::insert(
            [
                'date_start' => $request['date_start'],
                'date_end' => $request['date_end'],
                'idPolls' => $request['idPolls']
            ]
        );
    }
}
