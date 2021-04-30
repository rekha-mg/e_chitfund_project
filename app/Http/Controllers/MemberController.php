<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;


class MemberController extends Controller
{


    public function sendResponse($success, $result, $message, $response_code)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, $response_code);
    }

    public function showAll(Request $request)
    {
        Log::info('Display all users: ');
        $limit = $request->query('limit', 200);
        try {
            $res = DB::select('select count(*) as total from members');
           Log::info('Total number of users' . $res[0]->total);
            $total_users = $res[0]->total;
            if ($total_users > $limit) {
                $user_list = DB::select('select * from members limit ?', [$limit]);
            } else {
                $user_list = DB::select('select *  from members');
            }
        } catch (\PDOException $pex) {
           Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
            return $this->sendResponse("false", "", 'error related to database', 500);
        } catch (\Exception $e) {
           Log::critical('some error: ' . print_r($e->getMessage(), true));
           Log::critical('error line: ' . print_r($e->getLine(), true));
            return $this->sendResponse("false", "", 'some error in server', 500);
        }
        return $this->sendResponse("true", $user_list, 'request completed', 200);
    }

    public function showTwo(Request $request,$member_name,$password)
    {
      if($member_name){
           
            try {
                Log::info('Showing user details of : ' . $member_name);
                $member_id = DB::select('select member_id from members where member_name = ? and password=?', [$member_name, $password]);
            } catch (\PDOException $pex) {
                Log::critical('some error: ' . print_r($pex->getMessage(), true) ); //xampp off
                return $this->sendResponse("false", "", 'error related to database', 500);
            } catch (\Exception $e) {
                Log::critical('some error: ' . print_r($e->getMessage(), true));
                Log::critical('error line: ' . print_r($e->getLine(), true));
                return $this->sendResponse("false", "", 'some error in server', 500);
            }
        } else {
            return $this->sendResponse("false", "", 'some error in user name', 500);
        }
        return $this->sendResponse("true", $member_id, 'request completed', 200);
    }

public function showOne(Request $request,$member_id)
    {
      if($member_id>0){
           
            try {
                Log::info('Showing user details of : ' . $member_id);
                $member_name = DB::select('select member_name from members where member_id = ?', [$member_id]);
            } catch (\PDOException $pex) {
                Log::critical('some error: ' . print_r($pex->getMessage(), true) ); //xampp off
                return $this->sendResponse("false", "", 'error related to database', 500);
            } catch (\Exception $e) {
                Log::critical('some error: ' . print_r($e->getMessage(), true));
                Log::critical('error line: ' . print_r($e->getLine(), true));
                return $this->sendResponse("false", "", 'some error in server', 500);
            }
        } else {
            return $this->sendResponse("false", "", 'some error in user name', 500);
        }
        return $this->sendResponse("true", $member_name, 'request completed', 200);
    }
    public function insert(Request $request)
    {
       if ($request->has('member_name') && $request->has('password') && $request->has('dob') && $request->has('phone') &&
       	   $request->has('occupation') && $request->has('address') && $request->has('email_id') &&
       	   $request->has('adhar_card') && $request->has('pancard')) {

            $member_name = $request->input('member_name');
            $password=$request->input('password');
            $dob = $request->input('dob');
            $phone_num = $request->input('phone');
            $occupation = $request->input('occupation');
            $address  = $request->input('address');
            $email_id=$request->input('email_id');
            $adhar_number=$request->input('adhar_card');
            $pan_number=$request->input('pancard');

            try {
                $resp = DB::insert('insert into members (member_name,password,dob,occupation,phone,address,email_id, adhar_card,pancard) values (?,?,?,?,?,?,?,?,?)', [$member_name, $password,$dob, $occupation, $phone_num, $address, $email_id, $adhar_number, $pan_number]);


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
            Log::warning('input data missing' . print_r($request->input('member_name'), true));
            return $this->sendResponse("input data missing", 'incorrect request', 500); //wrong field name
        }
      return $this->sendResponse("true", $resp, 'data insereted successfully', 201);
    }


    public function edit(Request $request, $member_id)
    {
        if ($request->has('phone') && $request->has('address') && $request->has('email_id')) {
            $phone = $request->input('phone');
            $address = $request->input('address');
            $email_id=$request->input('email_id');
            echo("member id -".$member_id);

            if ($member_id > 0 && $member_id < 20) {
                try {
                    $resp = DB::update('update members set  phone = ?, address = ?, email_id = ? where member_id = ?', [$phone, $address, $email_id, $member_id]);
                } catch (\PDOException $pex) {
                    Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
                    return $this->sendResponse("false", "", 'error related to database', 500);
                } catch (\Exception $e) {
                    Log::critical('some error: ' . print_r($e->getMessage(), true));
                    Log::critical('error line: ' . print_r($e->getLine(), true));
                    return $this->sendResponse("false", "", 'some error in server', 500);
                }
            }
        } else {
            return $this->sendResponse("false", "", 'some error in input', 500);
        }
        Log::info('Updated user deatils: ' . $member_id);
        return $this->sendResponse("true", $resp, 'data updated', 200);
    }

    public function destroy($member_id){
        if($member_id >0 && $member_id<20){
        	try{

        		$resp=DB::update('update members set is_deleted =? where member_id =?',['true'],[$member_id]);
        	}
        	catch(\PDOException $pex){
        		Log::critical('some error:'.print_r($pex->getMessage(),true));//xampp off
        		return $this->sendResponse("false","",'error related to database', 500);
              	}
            catch(\Exception $e){
            	Log::critical('some error:'.print_r($e->getMessage(),true));
            	Log::critical('error line: '.print_r($e->getLine(),true));
            	return $this->sendResponse("false","",'some error in server',500);
            }
       }else{
       	return $this->sendResponse("false","",'some error in input',500);
      }
      Log::info('deleted user details: '.$member_id);
      return $this->sendResponse("true",$resp,'data deleted',200);

    }

}
