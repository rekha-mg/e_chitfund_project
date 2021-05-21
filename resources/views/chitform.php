<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
    body{
        background-color: #FFFAFA;

        /*background-image: url("http://localhost/laravel/images/money.jpg"); */
    }
    li{
        padding: 4px;
    }
    a{
        color: white;
    }
    
     #chitform{
        padding-top: 60px;
        width: 75%;
        margin-left: 200px;
     }

     #amount{
        width: 30%;
     }
     #chitname{
        width: 30%;
     }
     #paid_date , #due_date{
    width: 40%;
     }
     #image{
        border-style: dotted;
        background-color: #B0E0E6;
        width:50%; 
        border-radius: 3px;
        box-shadow:  5px 5px #adb5bd;
     }

</style>
<script>
    var payment={};
    var chit_id;
    var member_id; 
    display_chitsnames();//load to dropdown chit names
   
    
    var amount;
    var paid_date;
    var due_date;
    var is_late_paid;

    $( document ).ready(function() {
     
             // get the chitid from dropdown
        $('#chitNames').on('change',function() {
            chit_id=$(this).val();
             display_members();//load to dropdown member names
        });


        // get the member name from dropdown
        $('#memberName').on('change',function() {
            member_id=$(this).val();
        });

        // sending data to db 
        $('#post_data').on('click',function() {
            submit_data();
        });
   
  });
       
   // Load dropdown with member names
   function display_members(){
        $("#tab").empty();
        var table_content='';
        $.ajax({
            url:'api/showMembers/'+chit_id,
            type: 'GET',
            success: function (response) {
            option_content="";
            for( i=0;i<response.data.length;i++) {
                option_content+='<option value='+response.data[i].member_id+'>'+response.data[i].member_name+'</option>';
            } 
            $("#memberName").append( option_content);
         }

     });
    }

     // Load dropdown with chit names
    function display_chitsnames(){
        $.ajax({
            url:'/api/chits/',
            type: 'GET',
            success: function (response) {
          
            option_content="";
            for( i=0;i<response.data.length;i++) {
                option_content+='<option value='+response.data[i].chit_id+'>'+response.data[i].chit_name+'</option>';
            }
                $("#chitNames").append(option_content);
        }
    });
          
         
}


  // post data to table(lucky_lakshmi_details)
    function submit_data(){

        amount=$('#amount').val();
        paid_date=$('#paid_date').val();
        due_date=$('#due_date').val();

        if(paid_date > due_date){
            is_late_paid=1;
        }
        else
        {
            is_late_paid=0;
        }

        //var chit_month = due_date.getMonth();
        var chit_month=5;

        payment.member_id=member_id;
        payment.chit_id=chit_id;
        payment.amount=amount;
        payment.paid_date=paid_date;
        payment.due_date=due_date;
        payment.is_late_paid=is_late_paid;
        payment.chit_month=chit_month;
        payment.installment_number="1";

        console.log(payment);

                    $.ajax({
                        url:'/api/payment',
                        type: 'POST',
                        data: payment,
                        success: function (response, textStatus, xhr) {
                            alert(textStatus);
                           
                           if(textStatus){
                                alert(" successfully inserted..");
                            }
                            else
                                alert("something went wrong");

                       } ,
                       error: function (response, textStatus, errorThrown) {
                        if (response && response.responseJSON && response.responseJSON.message) {
                            alert(response.responseJSON.message);
                        } else {
                            alert("something wrong happened");
                        }
                    }

                            
                           
                   });

}
    


</script>
</head>
<body>

    <div class="container">
        <div id="first_div">
            <h1>Chit Funds </h1>

        </div>
        <div>
            <nav class="navbar navbar-expand-sm bg-primary">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/adminviewdetails">Back</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/index">Logout</a>
                    </li>
                    
                </div>
            </li>

        </ul>
    </nav>

</div>

<div id="chitform">
    <form>
        <div class="row">
  <div class="col-6 col-md-6">

<div class="form-group">
    <label for="chitname">Chit Names</label><br>
        <select  id="chitNames" name="chitname" >
        <option value="">Select the Chit Name</option>
        </select>
    </div>
  
  <div class="form-group">
    <label for="memberName">Member Names</label><br>
        <select  id="memberName" name="member_name" >
        <option value="">Select the Member Name</option>
        </select>
    </div>
      <div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" class="form-control" id="amount" >
  </div>
    <div class="form-group">
      <label for="paid_date" >Paid Date</label>
      <input type="date" class="form-control" id="paid_date">
    </div>

    <div class="form-group">
      <label for="due_date" >Due Date</label>
      <input type="date" class="form-control" id="due_date">
   
    </div>
 
    <button type="submit" class="btn btn-primary" id="post_data" >Submit</button>
 
 </div>
  <div class="col-6 col-md-6" id="image">

  </div>
</div>
        
     
</form>
</div>



</div>


</body>
</html>

