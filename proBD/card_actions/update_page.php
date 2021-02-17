<?php
include_once '../db_conn.php';

$ID = $_GET['id'];
$banca = $_GET['banca'];
$nr = $_GET['nr'];
$cod = $_GET['cod'];
$moneda = $_GET['moneda'];

$ID = rtrim($ID, " ");
$banca = rtrim($banca, " ");
$nr = rtrim($nr, " ");
$cod = rtrim($cod, " ");
$moneda = rtrim($moneda, " ");
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
        <input type="text" name="Banca" value="<?php echo "$banca" ?>"><br>
        <input type="text" name="Nr" value="<?php echo "$nr" ?>"> <br>
        <input type="text" name="Cod" value="<?php echo "$cod" ?>"> <br>
        <input type="text" name="Moneda" value="<?php echo "$moneda" ?>"> <br>
        <input type="submit" name="update"><br>
    </form>


</body>

</html>

<?php



if (isset($_POST['update'])) {

    $banca = $_POST['Banca'];
    $nr = $_POST['Nr'];
    $cod = $_POST['Cod'];
    $moneda = $_POST['Moneda'];

    $sql = "UPDATE card_credit 
            SET Banca = '$banca', NR_card = '$nr', Cod_securitate = '$cod', Moneda = '$moneda' where ID_card = $ID ";  

    mysqli_query($conn, $sql);

    header("Location: ../carduri.php?success");

    #updatez datele cardului selectat

    
}


