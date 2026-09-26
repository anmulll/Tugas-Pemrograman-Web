<?php

declare(strict_types=1);

require_once "Transaction.php";

session_start();

if(empty($_SESSION['csrf_token'])){

    $_SESSION['csrf_token']
    =
    bin2hex(random_bytes(32));

}


$message = "";


if($_SERVER["REQUEST_METHOD"] === "POST"){


    $type = $_POST['type'];

    $amount = $_POST['amount'];


    if(!is_numeric($amount) || $amount <= 0){

    die("Jumlah transaksi tidak valid");

}


$amount = (float)$amount;


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

    if(!hash_equals(
        $_SESSION['csrf_token'],
        $_POST['csrf_token']
    )){

    die("CSRF Token Salah");

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
<?= htmlspecialchars($message) ?>
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
type="hidden"
name="csrf_token"
value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
>


<br><br>


<button>
Submit
</button>


</form>


</body>

</html>