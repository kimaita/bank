<?php
require "protect.php";
$names="";
if (isset($_GET["loan_id"]))
{
    extract($_GET);
}
if (isset($_POST["amount"]))
{
    extract($_POST);
    require "connect.php";
    $query="update loans set balance=balance-$amount where loan_id=$loan_id";
    mysqli_query($conn, $query);

    $date=date("Y-m-d");

    $query="insert into repayments values(null,$loan_id,$customer_id,$amount,'$date')";
    mysqli_query($conn, $query);
    header("location:pending.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repay Loan</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        .container{
            margin-top: 70px;
        }
    </style>

</head>
<body>
<?php require "navbar.php"?>
<div class="container">
    <div class="col-sm-4 sm col-sm-offset-4">
        <h4><b><p class="text-center">Loan Repayment By  <?=$names?></p></b></h4>

        <form role="form" method="post" action="repay.php">
            <div class="form-group">
                <label for="email">Repayment Amount:</label>
                <input type="number" name="amount" max="<?=$balance?>" required class="form-control" id="email">
            </div>
            <input type="hidden" name="customer_id" value="<?=$customer_id?>">
            <input type="hidden" name="loan_id" value="<?=$loan_id?>">
            <button type="submit" class="btn btn-success btn-block">Repay</button>
        </form>
    </div>
</div>
</body>
</html>
