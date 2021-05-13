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
        #tab{
                margin: 80px;
                margin-left: 140px;
                width: 80%;
                border-radius: 5px;
                box-shadow: 5px 5px #adb5bd;
                border: 2px solid var(--white);
                background-color: var(--blue);
            }


    </style>
    <script>


        $( document ).ready(function() {
     
          
            display_chitsnames();//load to dropdown chit names
            display_members();//load to dropdown member names

        // get the chitname from dropdown
        $('#chitNames').on('change',function() {
            chit_name=$(this).val();
            console.log("chit id - ".chit_name);

            display_chits(chit_name);

             // get the member name from dropdown
        $('#memberName').on('change',function() {
            member_id=$(this).val();
            console.log("member_id"+member_id);
        });

           
        });

         });


        function display_members(){
        $("#tab").empty();
        var table_content='';
        $.ajax({
            url:'/api/members/',
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
        function display_chits(chit_name){
            $("#tab").empty();
            var table_content='';
        $.ajax({
            url:'/api/payments/'+chit_name,
            type: 'GET',

            success: function (response) {
                 console.log(response);
                console.log(response.data.length);
                table_content='<table class="table table-hover"><thead><tr><th>Id</th>';
                 table_content+='<th>member id </th><th>amount</th><th>chit month</th></tr></thead><tbody>';

                for( i=0;i<response.data.length;i++) {
                    table_content+='<tr>';
                    table_content+='<td>'+response.data[i].id+'</td>';
                    table_content+='<td>'+response.data[i].member_id+'</td>';
                     table_content+='<td>'+response.data[i].amount+'</td>';
                    table_content+='<td>'+response.data[i].chit_month+'</td> </tr>';

                }
                $("#tab").append(table_content);
            }

        });
        }
        
        function subscribe(){
            alert("table will be generated...");

        }



        function display_chitsnames(){
           
        $.ajax({
            url:'/api/chits/',
            type: 'GET',
            success: function (response) {
          
            option_content="";
            for( i=0;i<response.data.length;i++) {
                option_content+='<option value='+response.data[i].chit_name+'>'+response.data[i].chit_name+'</option>';
            }
            $("#chitNames").append(option_content);
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
                     <select  id="chitNames" name="chitname" >
                    <option value="">Select the Chit Name</option>
                  </select> 
                </li>

                <li class="nav-item">
                    <select  id="memberName" name="chitname" >
                        <option value="">Select the Member Name</option>
                    </select> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/adminviewdetails">Back</a>
                </li>

               
                 <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/index">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/contact">Contact Us</a>
                </li>
    </div>
  </li>

            </ul>
        </nav>

    </div>

       
    
        <div id="tab">

 
        </div>



</div>


</body>
</html>

