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
   
 public  function  newtable($member_id,$chit_id){
 	// get chit name from chits table using $chit_id
 	if ($chit_id > 0) {
   		
   			Log::info('Showing chit details of : ' . $chit_id);
   			$chit_name = DB::select('select chit_name from chits where chit_id = ?', [$chit_id]);
			
       }
   	Schema::create($chit_name, function (Blueprint $table) {
    $table->increments('id');
    $table->date('due_date');
    $table->double('total_amount',8,2);
    $table->double('bit_amount', 8, 2);
    $table->string('member_bit_amount_received');
    $table->double('commission');
    $table->double('remaining_amount',8,2);
    $table->date('next_bit_date');

	});
     
     $name=$chit_name;
     echo $name;

	
}
}

}
