<?php 
    include_once '../db_conn.php';

    $ID = $_GET['id'];

    $query = "DELETE from client where ID_client = '$ID'";

    $data = mysqli_query($conn, $query);

    header("Location: ../clienti.php?succes");
    //delete din tabela client

    ?>