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
.myform{
    padding: 0 33%;
    padding-top: 5%;
    margin:auto;
    font-size: medium;

}
.center{
    margin:5% 50%;
    padding:2%;
    border:1px solid orange;
}
.form2{
    padding-bottom: 20px;
    margin-top:30px;
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
                    <li class="active"><a href="transfers.php">Transfers</a></li>
                    <li><a href="transactionhist.php">Transaction History</a></li>
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
      <th scope="col">Customer Name</th>
      <th scope="col">Emailid</th>
      <th scope="col">Balance</th>
      
    </tr>
  </thead>
          <?php
    if(!isset($_GET['email'])){
      echo '<div class="alert alert-danger">There was an error please click on the link provided in the <b>view all customers</b>.</div>';
      exit;
    }
      $email=$_GET['email'];
      include('connection.php');
    $sql = "SELECT * FROM users Where email='$email'";
    $result = mysqli_query($link, $sql);
    
    if(!$result){
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;

}
$row = mysqli_fetch_row($result);

      ?>
  <tbody>
  
    <tr>
      <th scope="row">1</th>
      <?php
      echo "<td>$row[0]</td>";
      echo "<td>$row[1]</td>";
      echo "<td>$row[2]</td>";
      ?>
    
    </tr>
    </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>

        <div class="myform" >
        <form method="POST" >
        <div class="form1">
        <label for="transfername">Transfer To:</label>
        <br>
        <select id="option" name="op">
        <option value=""  selected="selected" hidden="hidden">Choose here</option>
        <?php
            $sql = "SELECT * FROM users Where email!='$email'";
            $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
   echo "<option>$row[email]</option>";
        }
        ?>
</select>
        </div>
        <div class="form2">
<label for="amount">Amount::</label>
<br>
<input type="number" name="amount">
</div>
<button type="submit" name="transfer" class="center">Transfer</button>
    <?php
        if(isset($_POST['transfer'])) {
            
               if(!empty($_POST['op'])) {
                $fromsql="SELECT * FROM users WHERE email='$email'";
                     $selected = $_POST['op'];
                     $selectedsql="SELECT * FROM users WHERE email='$selected'";
                        
                        $result1 = mysqli_query($link, $fromsql);
                        $result2 = mysqli_query($link, $selectedsql);
                        if(!$result || !$result2){
                             echo '<div class="alert alert-danger">Error running the query!</div>';
                                exit;

                                }
                        $row1 = mysqli_fetch_row($result1);
                        $row2= mysqli_fetch_row($result2);
                        $frombal= $row1[2];
                        $tobal2= $row2[2];
                        if(!empty($_POST['amount'])) {
                            $amount=$_POST['amount'];
                        }
                        else{
                            echo '<div class="alert alert-danger">Please select the amount</div>';
                                exit;
                        }
                        if($amount<0){
                            echo '<div class="alert alert-danger">Amount cant be negative</div>';
                            exit;
                        }
                        if($amount>$frombal)
                        {    echo '<div class="alert alert-danger">selected amount is greater than current balance</div>';
                            exit;
                        }
                        else{
                            $time=date('Y-m-d H:i:s');


                            $sql="INSERT INTO transaction VALUES('$row1[0]','$row2[0]','$amount','$time')";
                            //$date = date('Y-m-d H:i:s');
                            //$sql="INSERT INTO TABLE TRANSACTION VALUES('$row1[0]','$row2[0]','$amount','$date')";
                            $result = mysqli_query($link, $sql);
    
                            if(!$result){
                                echo '<div class="alert alert-danger">Error running the query!</div>';
                                
                                echo mysqli_error($link); 
                                exit;
                        
                        }
                        $addbal=$amount+$tobal2;
                        $subbal=$frombal-$amount;
                        $sql = "UPDATE users SET balance='$addbal' WHERE email = '$row2[1]'";
                            $result = mysqli_query($link, $sql);
                            if(!$result){
                                echo "<div class='alert alert-danger'>There was an error inserting the user details in the database.</div>";exit;
                                echo mysqli_error($link); 
                            }
                            $sql = "UPDATE users SET balance='$subbal' WHERE email = '$row1[1]'";
                            $result = mysqli_query($link, $sql);
                            if(!$result){
                                echo "<div class='alert alert-danger'>There was an error inserting the user details in the database.</div>";exit;
                                echo mysqli_error($link); 
                            }
                            echo "<script>window.alert('Transaction is successful');</script>";
                          
                                echo "<script>location.href = 'https://onlinetransfers.000webhostapp.com/transactionhist.php';</script>";

                        }

        
    } 

    
    else {
        echo '<div class="alert alert-danger">Please select the value.</div>';

    }
        }
    ?>
        </form>
        </div>
        <script type="text/javascript">
        function func() {
            selectElement = 
                    document.querySelector('#option');
                      
            output = selectElement.value;
  
            document.write(output);
        }
    </script>


       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
</body>
</html>              