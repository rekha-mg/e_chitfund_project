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
        .form-control {
            width: 30%;
            text-align: center;
        

        }
        #tab{
                margin: 80px;
                margin-left: 250px;
                width: 60%;
                border-radius: 5px;
                box-shadow: 5px 5px #adb5bd;
                border: 2px solid var(--white);
                background-color: var(--blue);
            }


    </style>
    <script>
        function display_members(){
            $("#tab").empty();
            var table_content='';
        $.ajax({
            url:'/api/members/',
            type: 'GET',

            success: function (response) {
                 console.log(response);
                console.log(response.data.length);
                table_content='<table class="table table-hover"><thead><tr><th>Name</th>';
                 table_content+='<th>Phone</th><th>Email</th></tr></thead><tbody>';

                for( i=0;i<response.data.length;i++) {
                    table_content+='<tr>';
                    table_content+='<td>'+response.data[i].member_name+'</td>';
                    table_content+='<td>'+response.data[i].phone+'</td>';
                    table_content+='<td>'+response.data[i].email_id+'</td> </tr>';

                }
                $("#tab").append(table_content);
            }

        });
        }

        function update_table(){
            
                    }
        
        function subscribe(){
            $("#tab").empty();
            var table_content='';
            var limit=5;

            $.ajax({
            url:'/api/subscriber/'+limit,
            type: 'GET',
            success: function (response) {
                 
                table_content='<table class="table table-hover"><thead><tr><th>Id</th>';
                table_content+='<th>Chit Id</th><th>Member Id</th> <th>Subscribed Date</th><th>Is Approved </th></tr></thead><tbody>';

                for( i=0;i<response.data.length;i++) {
                    table_content+='<tr>';
                    table_content+='<td>'+response.data[i].id+'</td>';
                    table_content+='<td>'+response.data[i].chit_id+'</td>';
                    table_content+='<td>'+response.data[i].member_id+'</td> ';
                    table_content+='<td>'+response.data[i].subscribed_date+'</td> ';
                    table_content+='<td><input class="form-control form-control-sm" type="text" value='+response.data[i].is_approved+ '></td>';
                    table_content+='<td><button type="button" class="btn btn-light" id="approve" onclick="update_table();">Save</button></td> </tr>';

                }
                    $("#tab").append(table_content);
            }

        });
           

        }

        function display_chits(){
            $("#tab").empty();
            var table_content='';

            $.ajax({
            url:'/api/chits/',
            type: 'GET',
            success: function (response) {
                 
                table_content='<table class="table table-hover"><thead><tr><th>Chit Name</th>';
                table_content+='<th>Capital Amount</th><th>Total Members</th> </tr></thead><tbody>';

                for( i=0;i<response.data.length;i++) {
                    table_content+='<tr>';
                    table_content+='<td><a href=http://127.0.0.1:8000/chit_viewdetails>'+response.data[i].chit_name+'</a></td>';
                    table_content+='<td>'+response.data[i].capital_amount+'</td>';
                    table_content+='<td>'+response.data[i].total_members+'</td> ';
                    table_content+='<td><button type="button" class="btn  btn-info" onclick="subscribe();">Subscribe</button> </td> </tr>';

                }
                    $("#tab").append(table_content);
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
                 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">View</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="display_members();" >Members</a>
                        <a class="dropdown-item" href="#" onclick="display_chits();">chits</a>
                    </div>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/chitform">Monthly Payment</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="subscribe();"  >Subscribers</a>
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

