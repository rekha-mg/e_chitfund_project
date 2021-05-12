<?php

namespace App\Http\Controllers;



use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;

class SubscriberController extends Controller
{
    //

 public function sendResponse($success, $result, $message, $response_code)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, $response_code);
    }

    public function insert(Request $request)
    {
       if ($request->has('chit_id') && $request->has('member_id') && $request->has('subscribed_date') && $request->has('is_approved') ) {

            $chit_id = $request->input('chit_id');
            $member_id=$request->input('member_id');
            $subscribed_date = $request->input('subscribed_date');
            $is_approved = $request->input('is_approved');
            

            try {
                $resp = DB::insert('insert into subscribers (chit_id,member_id,subscribed_date,is_approved) values (?,?,?,?)', [$chit_id, $member_id,$subscribed_date, $is_approved ]);


                Log::info('Inserted new user: ' . $resp);
            } catch (\PDOException $pex) {
                Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
                return $this->sendResponse("false", "", 'error related to database', 500);
            } catch (\Exception $e) {
                Log::critical('some error: ' . print_r($e->getMessage(), true));
                Log::critical('error line: ' . print_r($e->getLine(), true));
                return $this->sendResponse("false", "", 'some error in server', 500);
            }
        }
        else {
            Log::warning('input data missing' . print_r($request->input('chit_id'), true));
            return $this->sendResponse("input data missing", 'incorrect request', 500); //wrong field name
        }
      return $this->sendResponse("true", $resp, 'data insereted successfully', 201);
    }
}
