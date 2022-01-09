<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Models\Interview;
use Carbon\Carbon;
use DateTime;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Tymon\JWTAuth\Facades\JWTAuth;


class InterviewController extends Controller
{
    public function insertInterview(Request $request)
    {

        $token = $request->header('Authorization');
        if ($token)
        {
            $request->validate([
                'title' => 'required',
                'time' => 'date_format:H:i',
            ]);

            $interview = Interview::create(
                [
                    'title'=>$request->title,
                    'time'=>$request->time,
                    'description'=>$request->title
                ]
            );
            return $interview;
        }
        return response()->json([
            'message'=>'Token not exists!!'
        ]);
    }

    public function updateInterview(Request $request)
    {
        $token = $request->header('Authorization');
        if ($token)
        {
            $request->validate([
                'title' => 'required',
                'time' => 'date_format:H:i',
            ]);

            $interview = Interview::whereId($request->interview_id)->first();
            $interview->update([
                'title'=>$request->title,
                'time'=>$request->time,
                'description'=>$request->title
            ]);
            return $interview;

        }
        return response()->json([
            'message'=>'Token not exists!!'
        ]);
    }

    public function deleteInterview(Request $request)
    {
        $token = $request->header('Authorization');
        if ($token)
        {
            $request->validate([
                'interview_id' => 'required',
            ]);

            $interview = Interview::whereId($request->interview_id)->first();
            if ($interview)
            {
                $interview->delete();
                return response()->json([
                    'message'=>'Interview Deleted SuccessFully!!'
                ]);
            }

            return response()->json([
                'message'=>'Interview Not exists!!'
            ]);

        }
        return response()->json([
            'message'=>'Token not exists!!'
        ]);
    }

    public function showInterview(Request $request)
    {
        $token = $request->header('Authorization');
        if ($token)
        {
            $id = $request->id;

            $interview = Interview::whereId($id)->first();
            if ($interview)
            {
                return response()->json([
                    'data'=>$interview
                ]);
            }
            return response()->json([
                'message'=>'Interview Not exists!!'
            ]);

        }
        return response()->json([
            'message'=>'Token not exists!!'
        ]);
    }
    public function sendNotify(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user)
        {
            dd('ok');
        }else{
            dd('no');
        }


       // $token = $request->header('Authorization');
        if ($user)
        {
            $interviews = Interview::all();
            $timeNow = Carbon::now()->format('H:i');

            foreach ($interviews as $interview)
            {
                $time = $interview->time;
                $start_time = $timeNow;
                $end_time = $time;

                $startTime = Carbon::parse($start_time);
                $endTime = Carbon::parse($end_time);

                $totalDuration = $endTime->diffForHumans($startTime);
                $ex = explode(' ' , $totalDuration);
                if ($ex[0] == 30){

                    //just send static user id
                    Event::dispatch(new SendMail(1));
                }
                return response()->json([
                    'message'=>'User not found until send email'
                ]);
            }
        }
        return response()->json([
            'message'=>'Token not exits!!!'
        ]);

    }
}
