<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;



class luckylakshmi extends Controller
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
		Log::info('Display all luckylakshmi: ');

		try {
			$res = DB::select('select count(*) as total from lucky_lakshmi');
			Log::info('Total number of luckylakshmi ' . $res[0]->total);
			$total_luckylakshmi = $res[0]->total;
			if ($total_luckylakshmi > 5) {
				$chit_list = DB::select('select * from lucky_lakshmi limit ?', [$limit]);
			} else {
				$chit_list = DB::select('select *  from lucky_lakshmi');
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

   public function showOne(Request $req, $id)
   {
   	if ($id > 0) {
   		try {
   			Log::info('Showing chit details of lucky_lakshmi : ' . $id);
   			$chit = DB::select('select * from lucky_lakshmi where id = ?', [$id]);
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
    	if($request->has('due_date')&& $request->has('bid_amount')  && $request->has('bid_member') && $request->has('commission')  && $request->has('next_bid_date') ) {

    		$capitalamt=100000;
    		
    		$due_date =$request->input('due_date');
    		$bid_amount=$request->input('bid_amount');
    		$bid_amount_recived=((int)$capitalamt-(int)$bid_amount);
    		$bid_member=$request->input('bid_member');
    		$commission=$request->input('commission');
    		$remaining_amount=$bid_amount;
    		$next_bid_date=$request->input('next_bid_date');

    		//checking if member already bid or not
    		    		
			/*$member_list = DB::select('select bid_member from lucky_lakshmi');
			//echo $member_list;
			$json = json_encode($member_list);
			//echo $json;
    		echo $json.["bid_member"][0];
			/*if($bid_member){
*/
    		try{
    					
    			$resp = DB::insert('insert into lucky_lakshmi (due_date,bid_amount,bid_amount_received,bid_member,commission,remaining_amount,next_bid_date) values(?,?,?,?,?,?,?)',[$due_date,$bid_amount,$bid_amount_recived,$bid_member,$commission,$remaining_amount,$next_bid_date]);
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
		/*else{
			Log::waring('Member already have bid ' .print_r($request->input('bid_member'),true));
    			return $this->sendResponse("input data wrong", 'member bid already', 500); 
		}*/
	
		else{
				Log::waring('input data missing' .print_r($request->input('bid_amount'),true));
    			return $this->sendResponse("input data missing", 'incoorect request', 500); //wrong field name
    		}
    			return $this->sendResponse("true",$resp,'data inserted successfully', 201);

   	
    }


	public function edit(Request $request, $id)
    {
        if($request->has('due_date')&& $request->has('bid_amount')  && $request->has('bid_member') && $request->has('commission')  && $request->has('next_bid_date') ) {

    		$capitalamt=100000;
    		
    		$due_date =$request->input('due_date');
    		$bid_amount=$request->input('bid_amount');
    		$bid_amount_recived=((int)$capitalamt-(int)$bid_amount);
    		$bid_member=$request->input('bid_member');
    		$commission=$request->input('commission');
    		$remaining_amount=$bid_amount;
    		$next_bid_date=$request->input('next_bid_date');


    		try{
    			$resp = DB::update('update lucky_lakshmi set due_date  = ?, bid_amount = ? ,bid_amount_received=?, bid_member=?, commission=?, remaining_amount=?, next_bid_date=?  where id = ?',[$due_date,$bid_amount,$bid_amount_recived, $bid_member,$commission,$remaining_amount,$next_bid_date,$id]);
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
        		
        		$resp=DB::update('update lucky_lakshmi set is_deleted  = ? where id = ?',['1',$id]);
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
