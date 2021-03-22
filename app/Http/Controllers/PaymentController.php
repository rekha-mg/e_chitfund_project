<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
   
public function display(){
    	echo "inside display function";
    }


 public  function  newtable($chit_id,$member_id){
 	// get chit name from chits table using $chit_id
 	if ($chit_id > 0) {
   		
   			Log::info('Showing chit details of : ' . $chit_id);
   			$res = DB::select('select chit_name from chits where chit_id = ?', [$chit_id]);
			
     		$chit_name=$res[0]->chit_name;

       }
       if (Schema::hasTable($chit_name)) { 
       	 $this->display();
       }

	else{
	echo $res[0]->chit_name;
   	Schema::create($chit_name, function (Blueprint $table) {
    $table->increments('id');
    $table->date('due_date');
    $table->double('total_amount',8,2);
    $table->double('bit_amount', 8, 2);
    $table->string('bit_amount_received',8,2);
    $table->double('commission',8,2);
    $table->double('remaining_amount',8,2);
    $table->date('next_bit_date');

	});
  } 

  if (Schema::hasTable('members_chits')) { }
	else{
    Schema::create('members_chits', function (Blueprint $table) {
    $table->increments('id');	
    $table->unsignedBigInteger('member_id');
    $table->foreign('member_id')->references('member_id')->on('members');
	$table->foreign('chit_id')->references('chit_id')->on('chits');
	});
	
	}
}

	public function insertchit(Request $request,$chit_name)
    {
       if ($request->has('due_date') && $request->has('total_amount') && $request->has('bit_amount') && 
       	   $request->has('commission') && $request->has('remaining_amount') && $request->has('next_bit_date')) {

            $due_date = $request->input('due_date');
            $total_amount = $request->input('total_amount');
            $bit_amount = $request->input('bit_amount');
            $commission = $request->input('commission');
            $remaining_amount  = $request->input('remaining_amount');
            $next_bit_date=$request->input('next_bit_date');
            

            
            try {
                $resp = DB::insert('insert into' . $chit_name .'(due_date,total_amount,bit_amount,commission,remaining_amount,next_bit_date) values (?,?,?,?,?,?,?,?)', [$due_date, $total_amount, $bit_amount, $commission, $remaining_amount, $next_bit_date]);

             
                Log::info('Inserted new chit auction: ' . $resp);
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

    

}


