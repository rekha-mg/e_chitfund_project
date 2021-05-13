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


    public function showAll($limit)
    {
        Log::info('Display all subscribers: ');

        try {
            $res = DB::select('select count(*) as total from subscribers');
            Log::info('Total number of subscribers ' . $res[0]->total);
            $total_subscribers = $res[0]->total;
            if ($total_subscribers > 5 && $limit <= $total_subscribers) {
                $chit_list = DB::select('select * from subscribers limit ?', [$limit]);
            } else {
                $chit_list = DB::select('select * from subscribers ');
            }
        } catch (\PDOException $pex) {
           Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
           return $this->sendResponse("false", "", 'error related to database', 500);
       } catch (\Exception $e) {
        Log::critical('some error: ' . print_r($e->getMessage(), true));
        Log::critical('error line: ' . print_r($e->getLine(), true));
        return $this->sendResponse("false", "", 'some error in server', 500);
       }
       return $this->sendResponse("true", $chit_list, 'request completed', 200);

        //echo("its a chit controller");
   }

    public function insert(Request $request)
    {
       if ($request->has('chit_id') && $request->has('member_id') && $request->has('subscribed_date')  ) {

            $chit_id = $request->input('chit_id');
            $member_id=$request->input('member_id');
            $subscribed_date = $request->input('subscribed_date');
            try {
                $resp = DB::insert('insert into subscribers (chit_id,member_id,subscribed_date) values (?,?,?)', [$chit_id, $member_id,$subscribed_date]);


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



    public function edit(Request $request, $chit_id)
    {
        if ($request->has('chit_name')&& $request->has('capital_amount') && $request->has('total_members') && $request->has('payment') && $request->has('duration') && $request->has('start_date') && $request->has('ending_date')){

            $chit_name =$request->input('chit_name');
            $capital_amount=$request->input('capital_amount');
            $total_members=$request->input('total_members');
            $payment=$request->input('payment');
            $duration=$request->input('duration');
            $start_date=$request->input('start_date');
            $ending_date=$request->input('ending_date');

            try{
                $resp = DB::update('update chits set chit_name  = ?, capital_amount = ? ,total_members=?, payment=?, duration=?, start_date=?, ending_date=?  where chit_id = ?',[$chit_name,$capital_amount,$total_members, $payment,$duration,$start_date,$ending_date,$chit_id]);
                Log::info('updated chit :'. $chit_id);
            }   

            catch(\PDOException $pex){
                Log::critical('some error: '.print_r($pex->getMessage(),true)); //xampp off
                return $this->sendResponse("false", "",'error related to database', 500);
            }  
            catch(\Exception $e){
                Log::critical('some error:'.print_r($e->getMessage(),true));
                Log::critical('error line: '.print_r($e->getLine(), true));
                return $this->sendResponse("false","",'some error in server',500);
            }       
        }

         else {
            return $this->sendResponse("false", "", 'some error in input', 500);
        }
        Log::info('Updated user deatils: ' . $chit_id);
        return $this->sendResponse("true", $resp, 'data updated', 200);
    }
}
