<?php

session_start();


if(empty($_SESSION["csrf_token"])){

    $_SESSION["csrf_token"]
    =
    bin2hex(random_bytes(32));

}



require_once "classes/GuestBook.php";



try {

    $pdo = new PDO(
        "mysql:host=localhost;dbname=perpustakaan_db;charset=utf8mb4",
        "root",
        ""
    );


    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );


}

catch(PDOException $e){

    die("Database error");

}



$guestBook = new GuestBook($pdo);



$error="";



if($_SERVER["REQUEST_METHOD"]=="POST"){


    if(
        !isset($_POST["csrf_token"]) ||
        $_POST["csrf_token"] !== $_SESSION["csrf_token"]
    ){

        die("CSRF Token tidak valid");

    }




    $nama =
    trim($_POST["nama"]);


    $email =
    trim($_POST["email"]);


    $pesan =
    trim($_POST["pesan"]);


    if(empty($nama)){

        $error="Nama tidak boleh kosong";

    }

    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

        $error="Email tidak valid";

    }

    elseif(strlen($pesan)<5){

        $error="Pesan minimal lima karakter";

    }

    else{


        $guestBook->addMessage(
            $nama,
            $email,
            $pesan
        );


        header(
            "Location: guestbook.php"
        );


        exit;

    }

}


$data =
$guestBook->getMessages();

?>


<!DOCTYPE html>

<html>

<head>

<title>
Buku Tamu Perpustakaan
</title>

</head>


<body>



<h2>
Buku Tamu Perpustakaan
</h2>




<?php if($error): ?>

<p>

<?= htmlspecialchars($error); ?>

</p>

<?php endif; ?>





<form method="POST">


<!-- CSRF TOKEN -->

<input 
type="hidden"
name="csrf_token"
value="<?= $_SESSION["csrf_token"]; ?>"
>




<input 
type="text"
name="nama"
placeholder="Nama">



<br><br>




<input 
type="email"
name="email"
placeholder="Email">



<br><br>




<textarea 
name="pesan"
placeholder="Pesan">
</textarea>



<br><br>




<button type="submit">

Kirim

</button>



</form>




<hr>




<h3>
Daftar Pesan Pengunjung
</h3>




<table border="1" cellpadding="8">


<tr>

<th>
Nama
</th>


<th>
Email
</th>


<th>
Pesan
</th>


<th>
Tanggal Kirim
</th>


</tr>





<?php foreach($data as $row): ?>


<tr>


<td>

<?= htmlspecialchars($row["nama"]); ?>

</td>



<td>

<?= htmlspecialchars($row["email"]); ?>

</td>



<td>

<?= htmlspecialchars($row["pesan"]); ?>

</td>



<td>

<?= htmlspecialchars($row["tanggal_kirim"]); ?>

</td>



</tr>



<?php endforeach; ?>



</table>



</body>

</html>