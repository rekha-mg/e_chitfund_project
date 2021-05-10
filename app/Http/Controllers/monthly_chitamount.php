<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;


class monthly_chitamount extends Controller
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

	public function showAll(Request $request)
	{
		Log::info('Display all monthly_chitamount: ');

		try {
			$res = DB::select('select count(*) as total from  monthly_chitamount');
			Log::info('Total number of luckylakshmi ' . $res[0]->total);
			$total_luckylakshmi = $res[0]->total;
			if ($total_luckylakshmi > 5) {
				$list = DB::select('select * from  monthly_chitamount limit ?', [$limit]);
			} else {
				$list = DB::select('select *  from  monthly_chitamount');
			}
		} catch (\PDOException $pex) {
           Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
           return $this->sendResponse("false", "", 'error related to database', 500);
       } catch (\Exception $e) {
       	Log::critical('some error: ' . print_r($e->getMessage(), true));
       	Log::critical('error line: ' . print_r($e->getLine(), true));
       	return $this->sendResponse("false", "", 'some error in server', 500);
       }
       return $this->sendResponse("true", $list, 'request completed', 200);

        
   }

   public function showOne($id)
   {
   	if ($id > 0) {
   		try {
   			Log::info('Showing chit details of monthly_chitamount : ' . $id);
   			$list = DB::select('select * from monthly_chitamount where id = ?', [$id]);
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
        return $this->sendResponse("true", $list, 'request completed', 200);
    }

    public function insert(Request $request){
    	if($request->has('chit_name')&& $request->has('chit_number')  && $request->has('member_id') && $request->has('amount_paid')  && $request->has('paid_date') && $request->has('due_date') ) {

    		$chit_name=$request->input('chit_name');
    		$chit_number=$request->input('chit_number');
    		$member_id=$request->input('member_id');
    		$amount_paid=$request->input('amount_paid');
    		$paid_date=$request->input('paid_date');
    		$due_date =$request->input('due_date');
    		

    		try{
    					
    			$resp = DB::insert('insert into monthly_chitamount (chit_name,chit_number,member_id,amount_paid,paid_date,due_date) values(?,?,?,?,?,?)',[$chit_name,$chit_number,$member_id,$amount_paid,$paid_date,$due_date]);
    			Log::info('Paid  chit :'. $resp);
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
				Log::waring('input data missing' .print_r($request->input('bid_amount'),true));
    			return $this->sendResponse("input data missing", 'incoorect request', 500); //wrong field name
    		}
    			return $this->sendResponse("true",$resp,'data inserted successfully', 201);

   	
    }


	public function edit(Request $request, $id)
    {
        if($request->has('chit_name')&& $request->has('chit_number')  && $request->has('member_id') && $request->has('amount_paid')  && $request->has('paid_date') && $request->has('due_date') ) {

    		$chit_name=$request->input('chit_name');
    		$chit_number=$request->input('chit_number');
    		$member_id=$request->input('member_id');
    		$amount_paid=$request->input('amount_paid');
    		$paid_date=$request->input('paid_date');
    		$due_date =$request->input('due_date');

    		try{
    			$resp = DB::update('update monthly_chitamount set chit_name  = ?, chit_number = ? ,member_id=?, amount_paid=?, paid_date=?, due_date=?  where id = ?',[$chit_name,$chit_number,$member_id, $amount_paid,$paid_date,$due_date,$id]);
    			Log::info('updated lucky lakshmi chit :'. $id);
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
        Log::info('Updated user deatils: ' . $id);
        return $this->sendResponse("true", $resp, 'data updated', 200);
    }

public function destroy($id){
    if($id >0 && $id<20){
        try{
        		
        		$resp=DB::update('update monthly_chitamount set is_deleted  = ? where id = ?',['1',$id]);
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
      		Log::info('deleted user details: '.$id);
      		return $this->sendResponse("true",$resp,'data deleted',200);

    }
}
