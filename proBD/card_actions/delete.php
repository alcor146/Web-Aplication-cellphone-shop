<?php 
    include_once '../db_conn.php';

    $ID = $_GET['id'];

    $query = "DELETE from card_credit where ID_card = '$ID'"; #sterge cardul in functie de ID-ul clientului

    $data = mysqli_query($conn, $query);

    header("Location: ../carduri.php?succes");

    ?>