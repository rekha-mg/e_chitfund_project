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
        function display_luckylakshmi(){
            $("#tab").empty();
            var table_content='';
        $.ajax({
            url:'/api/luckylakshmi/',
            type: 'GET',

            success: function (response) {
                 console.log(response);
                console.log(response.data.length);
                table_content='<table class="table table-hover"><thead><tr><th>due_date</th>';
                 table_content+='<th>bid_amount</th><th>commission</th><th>bid_member</th></tr></thead><tbody>';

                for( i=0;i<response.data.length;i++) {
                    table_content+='<tr>';
                    table_content+='<td>'+response.data[i].due_date+'</td>';
                    table_content+='<td>'+response.data[i].bid_amount+'</td>';
                     table_content+='<td>'+response.data[i].commission+'</td>';
                    table_content+='<td>'+response.data[i].bid_member+'</td> </tr>';

                }
                $("#tab").append(table_content);
            }

        });
        }
        
        function subscribe(){
            alert("table will be generated...");

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
                    <a class="nav-link" href="#" onclick="display_luckylakshmi();" >Chit LuckyLakshmi </a>
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

