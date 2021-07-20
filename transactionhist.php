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

        h2, tr, td{
            color:black;
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
                    <li ><a href="index.php">Home</a></li>
                    <li><a href="customers.php">View all customers</a></li>
                    <li ><a href="transfers.php">Transfers</a></li>
                    <li class="active"><a href="transactionhist.php">Transaction History</a></li>
                  </ul>
                  </div>
            </div>

    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <h2>Transaction Details:</h2>
                <div class="table-responsive">
                <table class="table table-hover table-condensed table-bordered table-dark">
                <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Sender</th>
      <th scope="col">Reciever</th>
      <th scope="col">Amount</th>
      <th scope="col">Time</th>
      
    </tr>
  </thead>
          <?php

      include('connection.php');
    $sql = "SELECT * FROM transaction order by time DESC LIMIT 10";
    $result = mysqli_query($link, $sql);
    
    if(!$result){
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;

}

      ?>
  <tbody>
  
    <tr>
      <?php
      $var=1;
while ($row = mysqli_fetch_assoc($result)) {

    echo"<tr>";
    echo "<th scope='row'>$var</th>";
    echo "<td>$row[sender]</td>";
    echo "<td> $row[receiver]</td>";
   echo" <td>$row[amount]</td>";
   echo "<td>$row[time]</td>";
    $var+=1;
    echo"</tr>";

      }
      ?>
    
 
    </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
</body>
</html>