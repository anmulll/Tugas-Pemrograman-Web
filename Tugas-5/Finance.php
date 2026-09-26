<?php

declare(strict_types=1);

require_once "Transaction.php";

session_start();


$message = "";


if($_SERVER["REQUEST_METHOD"] === "POST"){


    $type = $_POST['type'];

    $amount = (float)$_POST['amount'];


    $transaction = new Transaction(
        uniqid(),
        $type,
        $amount
    );


    if($transaction->process()){

        $message = "Transaksi berhasil";

    }
    else{

        $message = "Saldo tidak cukup";

    }

}

?>


<!DOCTYPE html>
<html>

<head>

<title>
Finance System
</title>

</head>


<body>


<h2>
Sistem Manajemen Keuangan
</h2>


<p>
<?= $message ?>
</p>


<form method="POST">


<select name="type">

<option value="deposit">
Deposit
</option>


<option value="withdraw">
Withdraw
</option>

</select>


<br><br>


<input 
type="number"
name="amount"
step="0.01"
>


<br><br>


<button>
Submit
</button>


</form>


</body>

</html>