<?php
session_start();
include "db_conn.php";
?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Magazin</title>
        <link rel="stylesheet" href="style/webstyle.css">
		<link rel="stylesheet" href="style/tablestyle.css">
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
		
	<table class="styled-table" >

		<thead>
			<tr><th>ID</th>
				<th>Nume</th>
                <th>Prenume</th>
				<th>Numar carduri</th>
			</tr>
		</thead>

		<tbody>
		<?php


$query3 = "SELECT CL.ID_client ,CL.Nume, CL.Prenume, C.nr from card_credit cc
join(select ID_card, count(ID_card) as nr from card_credit group by ID_client) as C ON C.ID_card = cc.ID_card
join client CL on CL.ID_client = cc.ID_client
   ";
//selectez numele, prenumele si nr cardurilor din baza de date

$data3 = mysqli_query($conn, $query3);
if ($data3->num_rows > 0) {
	while ($result3 = mysqli_fetch_assoc($data3)) {
		echo "
<tr>
	<td>" . $result3["ID_client"] . "</td>
    <td>" . $result3["Nume"] . "</td>
    <td>" . $result3["Prenume"] . "</td>
    <td>" . $result3["nr"] . "</td>

</tr>
";
}
echo "</table>";
} else {
echo "no results";
}
$conn->close();





			
		?>
	</tbody>
    </table>
    
	<footer>
	<div class="logo">
				web
			</div>
			<nav>
				<ul>
                <li>
						<a href="nr_carduri.php">Numar carduri</a>
                    </li>
					<li>
						<a href="date_clienti.php">Date personale</a>
                    </li>
                    <li>
						<a href="produse_disponibile.php">Disponibile</a>
					</li>
					<li>
						<a href="banca_transfer.php">Banca</a>
					</li>
					<li>
						<a href="best_seller.php">Top1</a>
					</li>
                    <li>
						<a href="plata_cash.php">Plata cash</a>
                    </li>
                    <li>
						<a href="client_fidel.php">Client fidel</a>
					</li>
				</ul>
			</nav>
	</footer>
	
	</body>

	</html>
