<?php
include_once '../db_conn.php';

$E0 = $_GET['nr_comanda'];
$E1 = $_GET['id_comanda'];
$E2 = $_GET['nume'];
$E3 = $_GET['prenume'];
$E4 = $_GET['metodaP'];
$E5 = $_GET['id_card'];
$E6 = $_GET['brand'];
$E7 = $_GET['memorie'];
$data = $_GET['data'];
$data_actuala = date("Y-m-d");

$E1 = rtrim($E1, " ");
$E2 = rtrim($E2, " ");
$E3 = rtrim($E3, " ");
$E4 = rtrim($E4, " ");
$E5 = rtrim($E5, " ");
$E6 = rtrim($E6, " ");
$E7= rtrim($E7, " ");

//daca coamnda a fost procesata, nu mai putem updata comanda

if($data = $_GET['data'] != $data_actuala = date("Y-m-d")){
    header("Location: ../comenzi.php?failed/comanda a fost deja procesata");
    exit();
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Update</title>
    <link rel="stylesheet" href="../style/webstyle.css">
</head>

<body>
    <header>
        <div class="logo">
            logo
        </div>
        <nav>
            <ul>
            <li>
                    <a href="../home.php">Home</a>
                </li>
                <li>
                    <a href="../clienti.php">Clienti</a>
                </li>
                <li>
                    <a href="../carduri.php">Carduri</a>
                </li>
                <li>
                    <a href="../produse.php">Produse</a>
                </li>
                <li>
                    <a href="../comenzi.php">Comenzi</a>
                </li>
                <li>
                    <a href="../butoane.php">Diverse</a>
                </li>
            </ul>
        </nav>
    </header>
    

    <form action="" method="POST">
        <input type="text" name="nume" value="<?php echo$E2?>"><br>
        <input type="text" name="prenume" value="<?php echo"$E3"?>"><br>
        <input type="text" name="metodaP" value="<?php echo"$E4"?>"><br>
        <input type="text" name="id_card" value="<?php echo"$E5"?>"><br>
        <input type="text" name="brand" value="<?php echo"$E6"?>"><br>
        <input type="text" name="memorie" value="<?php echo"$E7"?>"><br>
        <input type="submit" name="update"><br>
    </form>

</body>

</html>

<?php

$memorie_valida = FALSE;
$card_valid = FALSE;


if (isset($_POST['update'])) {

    

    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $metoda_plata = $_POST['metodaP'];
    $ID_card = $_POST['id_card'];
    $brand = $_POST['brand'];
    $memorie = $_POST['memorie'];  

    $query4 = "SELECT * from stocare
                        where ID_produs in (select ID_produs from produs where Brand=?)";

    $stmt4 = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt4, $query4)){
        mysqli_stmt_bind_param($stmt4, "s", $brand);
        mysqli_stmt_execute($stmt4);
        $result4 = mysqli_stmt_get_result($stmt4);

        while ($row4 = mysqli_fetch_assoc($result4)) {
            if($row4["Memorie_totala"] == $memorie)
                $memorie_valida = TRUE;
        }
        
    }

    if($metoda_plata == 'cash'){
        $card_valid = TRUE;
        $ID_card = 0;
    } else if($metoda_plata == 'card'){
        $query3 = "SELECT * from card_credit
                    where ID_client in (select ID_client from client where Nume=? and Prenume=?)";

        $stmt3 = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt3, $query3)){

            mysqli_stmt_bind_param($stmt3, "ss", $nume, $prenume);
            mysqli_stmt_execute($stmt3);
            $result3 = mysqli_stmt_get_result($stmt3);

            while ($row3 = mysqli_fetch_assoc($result3)) {
                if($row3["ID_card"] == $ID_card)
                    $card_valid = TRUE;
            }
            
        }
            //verificam din nou daca cardul si clientul exista
    }
        if($card_valid == TRUE && $memorie_valida == TRUE){

            $query1 = "SELECT * from comanda_plasata
            inner join produs on produs.ID_produs = comanda_plasata.ID_produs
            inner join comanda on comanda.ID_comanda = comanda_plasata.ID_comanda
            inner join client on client.ID_client = comanda.ID_client
            ";
             $data1 = mysqli_query($conn, $query1);
             if ($data1->num_rows > 0) {
                 while ($result1 = mysqli_fetch_assoc($data1)) {
                    if($result1["Brand"] == $brand)
                         $ID_produs = $result1["ID_produs"];
                    if($result1["Nume"] == $nume && $result1["Prenume"] == $prenume )
                         $ID_client = $result1["ID_client"];
                 }
             }
             //modificam atat in comanda cat si in comanda plasata
            
            $sql = "UPDATE comanda 
                    SET ID_client = '$ID_client', Metoda_plata = '$metoda_plata', ID_card = '$ID_card' where ID_comanda = '$E1'";
            mysqli_query($conn, $sql);
            //daca am modificat modalitatea de plata sau cardul, schimbam in comanda 

            $sql1 = "UPDATE comanda_plasata
                    SET ID_produs = '$ID_produs', Memorie_totala = '$memorie' where NR_comanda = '$E0'";
            mysqli_query($conn, $sql1);
            //daca s au modificat specificatiile produsului sau am ales alt produs, schimbarile se fac in tabela comanda_plasata

            header("Location: ../comenzi.php?success");
            exit();
        } else {
            header("Location: ../comenzi.php?failed/ceva e gresit");
            exit();
        }


}

