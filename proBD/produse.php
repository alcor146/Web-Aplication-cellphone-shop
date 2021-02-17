<?php

include "db_conn.php";

$query = "SELECT * from produs";
$data = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Magazin</title>
    <link rel="stylesheet" href="style/webstyle.css">
</head>

<body>
    <header>
        <div class="logo">
            logo
        </div>
        <nav>
            <ul>
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li>
                    <a href="clienti.php">Clienti</a>
                </li>
                <li>
                    <a href="carduri.php">Carduri</a>
                </li>
                <li>
                    <a href="produse.php">Produse</a>
                </li>
                <li>
                    <a href="comenzi.php">comenzi</a>
                </li>
                <li>
                    <a href="complex.php">Diverse</a>
                </li>
            </ul>
        </nav>
    </header>
   


    <table class="table1">
        <tr>

            <th>
                <p>Specificatii</p>
            </th>
            <th>
                <p>Imagine</p>
            </th>
        </tr>
        <tr>
            <td>
                <?php
                #selectez datele despre fiecare brand si le afisez impreuna cu imaginea respectiva
                $result = mysqli_fetch_assoc($data);
                echo "<p>
            
                    ID: " . $result["ID_produs"] . "<br>
                    Brand: " . $result["Brand"] . "<br>
                    RAM: " . $result["RAM"] . "<br>
                    Procesor: " . $result["Procesor"] . "<br>
                    SO: " . $result["Sistem_operare"] . "<br>
                    Status " . $result["Disponibilitate"] . "<br>
                    Garantie: " . $result["Durata_garantie"] . "<br>
                    Pret: " . $result["Pret"] . " RON </p>"
                ?>
            </td>
            <td>
                <img alt="" src="poze/samsung.webp">
            </td>
        </tr>
        <tr>
            <td>
                <?php

                $result = mysqli_fetch_assoc($data);
                echo "<p>

                    ID: " . $result["ID_produs"] . "<br>
                    Brand: " . $result["Brand"] . "<br>
                    RAM: " . $result["RAM"] . "<br>
                    Procesor: " . $result["Procesor"] . "<br>
                    SO: " . $result["Sistem_operare"] . "<br>
                    Status " . $result["Disponibilitate"] . "<br>
                    Garantie: " . $result["Durata_garantie"] . "<br>
                    Pret: " . $result["Pret"] . " RON </p>"
                ?>
            </td>
            <td>
                <img alt="" src="poze/asus.jpg">
            </td>
        </tr>
        <tr>
            <td>
                <?php

                $result = mysqli_fetch_assoc($data);
                echo "<p>

                    ID: " . $result["ID_produs"] . "<br>
                    Brand: " . $result["Brand"] . "<br>
                    RAM: " . $result["RAM"] . "<br>
                    Procesor: " . $result["Procesor"] . "<br>
                    SO: " . $result["Sistem_operare"] . "<br>
                    Status " . $result["Disponibilitate"] . "<br>
                    Garantie: " . $result["Durata_garantie"] . "<br>
                    Pret: " . $result["Pret"] . " RON </p>"
                ?>
            </td>
            <td>
                <img alt="" src="poze/xiaomi.jpg">
            </td>
        </tr>
    </table>





</body>

</html>