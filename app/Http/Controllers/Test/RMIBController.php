<?php

namespace App\Http\Controllers\Test;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packet;
use App\Models\Result;

class RMIBController extends Controller
{    
    /**
     * Display
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string $path
     * @param  object $test
     * @return \Illuminate\Http\Response
     */
    public static function index(Request $request, $path, $test)
    {
        // Get the packet and questions
        $packet = Packet::where('test_id','=',$test->id)->where('status','=',1)->first();
        $questions = $packet ? $packet->questions()->orderBy('number','asc')->get() : [];

        // View
        return view('member/test/'.$path, [
            'packet' => $packet,
            'path' => $path,
            'questions' => $questions,
            'test' => $test,
        ]);
    }

    /**
     * Store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        // Get the packet
        $packet = Packet::where('test_id','=',$request->test_id)->where('status','=',1)->first();
        
        // Answers
        $array = [];
        $array['answers'] = $request->score;
        $array['occupations'] = $request->occupations;

        // Sort array answers by key
        foreach($array['answers'] as $key=>$answer) {
            ksort($array['answers'][$key]);
        }

        // Save the result
        $result = new Result;
        $result->user_id = Auth::user()->id;
        $result->project_id = $request->project_id;
        $result->test_id = $request->test_id;
        $result->packet_id = $request->packet_id;
        $result->result = json_encode($array);
        $result->save();

        // Redirect
        return redirect()->route('member.dashboard')->with(['message' => 'Berhasil mengerjakan tes '.$packet->test->name]);
    }
}