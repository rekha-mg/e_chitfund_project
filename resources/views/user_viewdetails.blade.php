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
    <style type="text/css">
        body{
            background-color: #007bff;
            background-image: url("http://localhost/laravel/images/money.jpg");
        }
        li{
            padding: 4px;
        }
        a{
            color: black;
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
       var chit_id;
       var currentdate = new Date(); 
       var member_subscirbed={};
         $(document).ready(function() {
            viewSession();
         });

        // post data to subcriber table - meber who have subscribed
        // I have to take member_id when he login using session [pending]
        function subscribe(chit_id){
            
            member_subscirbed.chit_id=chit_id;
            member_subscirbed.member_id=1; // manually adding [coz pending session data]
            member_subscirbed.subscribed_date=currentdate.getFullYear()+"/"+currentdate.getMonth()+"/"+currentdate.getDate();
            $.ajax({
                url:'/api/subscriber',
                type:'Post',
                data:member_subscirbed,
                success: function (response, textStatus, xhr) {
                            //alert("Data: " + response.data + "\nStatus: " + textStatus);
                    if(textStatus){
                        alert("subscribed successfully..");
                    }
                    else
                        alert("not eligible");
                    },
               error: function (response, textStatus, errorThrown) {
                    if (response && response.responseJSON && response.responseJSON.message) {
                        alert(response.responseJSON.message);
                    } else {
                        alert("something wrong happened");
                    }
                }
            });



        }



        // display chits in table.
         function display_chits(){
            $("#tab").empty();
            var table_content='';
            
            $.ajax({
            url:'/api/chits/',
            type: 'GET',
            success: function (response) {
                console.log(response);
                console.log(response.data.length);
                table_content='<table class="table table-hover"><thead><tr><th>Chit Name</th>';
                table_content+='<th>Capital Amount</th><th>Total Members</th></tr></thead><tbody>';
           

            for( i=0;i<response.data.length;i++) {
                   
                chit_id=response.data[i].chit_id;

                table_content+='<tr>';
                table_content+='<td><a href=http://127.0.0.1:8000/chit_viewdetails>'+response.data[i].chit_name+'</a></td>';
                table_content+='<td>'+response.data[i].capital_amount+'</td>';
                table_content+='<td>'+response.data[i].total_members+'</td> ';
                 table_content+='<td><button type="button" class="btn  btn-info" onclick="subscribe('+chit_id+');">Subscribe</button> </td> </tr>';

            }
                $("#tab").append(table_content);
        }

        });
    }

    function viewSession(){
    alert("session called");
    
         $.ajax({
                        url:'/session/get',
                        type:'get',
                        
                        success: function (response, textStatus, xhr) {
                            console.log(response);
                        },
                           
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
        <h1>Chit Funds</h1>
    </div>
    <div>
        <nav class="navbar navbar-expand-sm bg-secondary">
            <ul class="navbar-nav">
                 <li class="nav-item">
                               </li>
                <li class="nav-item">
                <button type="button" class="btn  btn-info" onclick="display_chits();">View Chits</button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/index">Logout {{session('my_name') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/contact">Contact Us</a>
                </li>

            </ul>
        </nav>

    </div>

        <div id="tab">


        </div>



</div>


</body>
</html>

