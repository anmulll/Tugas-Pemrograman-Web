<?php

session_start();

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

<h2>Buku Tamu Perpustakaan</h2>


<form method="POST">


<input 
type="text"
name="nama"
placeholder="Nama">


<br>


<input 
type="email"
name="email"
placeholder="Email">


<br>


<textarea 
name="pesan"
placeholder="Pesan">
</textarea>


<br>


<button>
Kirim
</button>


</form>