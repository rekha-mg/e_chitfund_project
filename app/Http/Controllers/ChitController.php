<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class ChitController extends Controller
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
		Log::info('Display all chits: ');

		try {
			$res = DB::select('select count(*) as total from chits');
			Log::info('Total number of chits ' . $res[0]->total);
			$total_chits = $res[0]->total;
			if ($total_chits > 5) {
				$chit_list = DB::select('select * from chits limit ?', [$limit]);
			} else {
				$chit_list = DB::select('select *  from chits');
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

   public function showOne(Request $req, $chit_id)
   {
   	if ($chit_id > 0) {
   		try {
   			Log::info('Showing chit details of : ' . $chit_id);
   			$chit = DB::select('select * from chits where chit_id = ?', [$chit_id]);
   		} catch (\PDOException $pex) {
                Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
                return $this->sendResponse("false", "", 'error related to database', 500);
            } catch (\Exception $e) {
            	Log::critical('some error: ' . print_r($e->getMessage(), true));
            	Log::critical('error line: ' . print_r($e->getLine(), true));
            	return $this->sendResponse("false", "", 'some error in server', 500);
            }
        } else {
        	return $this->sendResponse("false", "", 'some error in user id', 500);
        }
        return $this->sendResponse("true", $chit, 'request completed', 200);
    }

    public function insert(Request $request){
    	if($request->has('chit_name')&& $request->has('capital_amount') && $request->has('total_members') && $request->has('monthly_payment') && $request->has('duration') && $request->has('start_date') && $request->has('ending_date'))
    	{
    		
    		$chit_name =$request->input('chit_name');
    		$capital_amount=$request->input('capital_amount');
    		$total_members=$request->input('total_members');
    		$monthly_payment=$request->input('monthly_payment');
    		$duration=$request->input('duration');
    		$start_date=$request->input('start_date');
    		$ending_date=$request->input('ending_date');

    		try{
    			$resp = DB::insert('insert into chits (chit_name,capital_amount,total_members,monthly_payment,duration,start_date,ending_date) values(?,?,?,?,?,?,?)',[$chit_name,$capital_amount,$total_members,$monthly_payment,$duration,$start_date,$ending_date]);
    			Log::info('Inserted new chit :'. $resp);
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
		else{
				Log::waring('input data missing' .print_r($request->input('chit_name'),true));
    			return $this->sendResponse("input data missing", 'incoorect request', 500); //wrong field name
    		}
    			return $this->sendResponse("true",$resp,'data inserted successfully', 201);
   	
    }


	public function edit(Request $request, $chit_id)
    {
        if ($request->has('chit_name')&& $request->has('capital_amount') && $request->has('total_members') && $request->has('monthly_payment') && $request->has('duration') && $request->has('start_date') && $request->has('ending_date')){

        	$chit_name =$request->input('chit_name');
    		$capital_amount=$request->input('capital_amount');
    		$total_members=$request->input('total_members');
    		$monthly_payment=$request->input('monthly_payment');
    		$duration=$request->input('duration');
    		$start_date=$request->input('start_date');
    		$ending_date=$request->input('ending_date');

    		try{
    			$resp = DB::update('update chits set chit_name  = ?, capital_amount = ? ,total_members=?, monthly_payment=?, duration=?, start_date=?, ending_date=?  where chit_id = ?',[$chit_name,$capital_amount,$total_members, $monthly_payment,$duration,$start_date,$ending_date,$chit_id]);
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

public function destroy($chit_id){
    if($chit_id >0 && $chit_id<20){
        try{
        		$resp=DB::delete('delete from chits where chit_id=?',[$chit_id]);
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
    }
    else{
       		return $this->sendResponse("false","",'some error in input',500);
      	}
      		Log::info('deleted user details: '.$chit_id);
      		return $this->sendResponse("true",$resp,'data deleted',200);

    }

}


