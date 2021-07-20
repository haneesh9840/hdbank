<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
       <link href="css/bootstrap.min.css" rel="stylesheet" >
       <link href="styling.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">
    
<style>
        .container{
            
            margin-top:90px;
        }
        button{
          color:#000;
          background-color: #e69a1c;
          margin:auto;
        }
        h2, tr, td{
           
            font-weight:900;
            cursor:pointer;
        }
    
        body{
       background: url("bank.jpg") no-repeat center center;
    background-attachment: fixed;
    font-family: Lora;
    background-size: cover;
}

    </style>
    <script>
      function func(){
        location.href = 'transfers.php?email=<?php echo $row["email"];?>';
      }
      </script>
</head>
<body>
<nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
      
      <div class="container-fluid">
        
          <div class="navbar-header">
          
              <a class="navbar-brand">Hd bank</a>
              <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              
              </button>
          </div>
          <div class="navbar-collapse collapse" id="navbarCollapse">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li  class="active"><a href="customers.php">View all customers</a></li>
                <li><a href="transfers.php">Transfers</a></li>
                <li><a href="transactionhist.php">Transaction History</a></li>
              </ul>
              </div>
        </div>
</nav>

<div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-8">
                <h2>Customer Details:</h2>
                <div class="table-responsive-lg">
                <table class="table table-hover table-condensed table-bordered table-dark">
                <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Emailid</th>
      <th scope="col">Balance</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>

    <tr>
    <?php
  include('connection.php');
  $sql = "SELECT * FROM users";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;

}
$var=1;
while ($row = mysqli_fetch_assoc($result)) {

  echo"<tr>";
  echo "<th scope='row'>$var</th>";
  echo "<td>$row[name]</td>";
  echo "<td> $row[email]</td>";
 echo" <td>$row[balance]</td>";
 echo "<td><a href = 'transfers.php?email=$row[email]'><button type='submit'>view and transfer</button></a>";
  $var+=1;

    }
    ?>
  </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>