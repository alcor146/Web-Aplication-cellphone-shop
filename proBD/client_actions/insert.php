<?php 
    session_start(); 
    include_once '../db_conn.php';

    $E2 = $_POST['Nume'];
    $E3 = $_POST['Prenume'];
    $E4 = $_POST['Adresa_email'];
    $E5 = $_POST['NR_telefon'];
    $E6 = $_POST['Adresa_fizica'];
    $E7 = $_POST['Parola'];

    if(isset($_POST['insert'])){

    $sql = "INSERT INTO client (Nume, Prenume, Adresa_email, NR_telefon, Adresa_fizica, Parola) 
            VALUES('$E2','$E3','$E4','$E5','$E6','$E7');";
    mysqli_query($conn, $sql);
    // insert in tabela client

    header("Location: ../clienti.php?success");
    }
    
    header("Location: ../clienti.php?failed");
    

?>