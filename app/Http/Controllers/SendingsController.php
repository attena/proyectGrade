<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sendings;
use Maatwebsite\Excel\Facades\Excel;
use App\src\imports\MailsImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Poll;
use Hamcrest\Core\HasToString;

class SendingsController extends Controller
{
    public function index()
    {
        $sends = Sendings::join('polls', "polls.idPolls", "=", "sendings.idPolls")->get();
        return response()->json($sends, 200);
    }

    public function store(Request $request)
    {

        Sendings::insert(
            [
                'date_start' => Carbon::now(),
                'idPolls' => $request['polls']
            ]
        );

        $data = Excel::toArray(new MailsImport, request()->file('file'));
        $polls = Poll::where('idPolls', $request->polls)->get();

        for ($i = 0; $i < count($data[0]); $i++) {
            $subject = "Encuesta de satisfacción";
            $for = $data[0][$i][0];
            Mail::send('layout.mail', ["code" => $polls[0]->code], function ($msj) use ($subject, $for) {
                $msj->from("encuestas@satisfy.com", "Satisfy");
                $msj->subject($subject);
                $msj->to($for);
            });
        }

        return response()->json(true, 200);
    }
}
