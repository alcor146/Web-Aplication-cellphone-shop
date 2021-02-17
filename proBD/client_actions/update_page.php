<?php
include_once '../db_conn.php';

$E1 = $_GET['id'];
$E2 = $_GET['nume'];
$E3 = $_GET['prenume'];
$E4 = $_GET['mail'];
$E5 = $_GET['telefon'];
$E6 = $_GET['adresa'];
$E7 = $_GET['parola'];

$E1 = rtrim($E1, " ");
$E2 = rtrim($E2, " ");
$E3 = rtrim($E3, " ");
$E4 = rtrim($E4, " ");
$E5 = rtrim($E5, " ");
$E6 = rtrim($E6, " ");
$E7= rtrim($E7, " ");   #aveam o problema in care imi pune un spatiu la final cand trimit date prin $get,
                        # asa ca a fost nevoie sa il scot cu rtrim pentru a face cautari dupa valori
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
        <input type="text" name="nume" value="<?php echo "$E2" ?>"> <br>    
        <input type="text" name="prenume" value="<?php echo "$E3" ?>"> <br>
        <input type="text" name="mail" value="<?php echo "$E4" ?>"> <br>
        <input type="text" name="telefon" value="<?php echo "$E5" ?>"> <br>
        <input type="text" name="adresa" value="<?php echo "$E6" ?>"> <br>
        <input type="text" name="parola" value="<?php echo "$E7" ?>"> <br>
        <input type="submit" name="update"><br>
    </form>
    <!-- scriu valorile anterioare in casutele de text pentru a face mai usoara updatarea datelor -->

</body>

</html>

<?php



if (isset($_POST['update'])) {

    //$E1 = $_POST['ID_client'];
    $E2 = $_POST['nume'];
    $E3 = $_POST['prenume'];
    $E4 = $_POST['mail'];
    $E5 = $_POST['telefon'];
    $E6 = $_POST['adresa'];
    $E7 = $_POST['parola'];  

    $sql = "UPDATE client 
            SET Nume = '$E2', Prenume = '$E3', Adresa_email = '$E4', NR_telefon = '$E5', Adresa_fizica = '$E6', Parola = '$E7' where ID_client = $E1 ";
            #schimb noile valori cu cele primite
    mysqli_query($conn, $sql);

    header("Location: ../clienti.php?success");
}


