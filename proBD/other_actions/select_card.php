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

		<form action="other_actions/select_card.php" method="POST">
			<input type="text" name="Nume" placeholder="Nume"><br>
			<input type="text" name="Prenume" placeholder="Prenume"><br>
			<input type="submit" name="insert"><br>
		</form>
		
	<table class="styled-table" >

		<thead>
			<tr>
				<th>Memorie</th>
				<th>Numar produse cu aceeasi optiune</th>
			</tr>
		</thead>

		<tbody>
		<?php


$query3 = "SELECT CL.Nume, CL.Prenume, C.nr from card_credit cc
join(select ID_card, count(ID_card) as nr from card_credit group by ID_client) as C ON C.ID_card = cc.ID_card
join client CL on CL.ID_client = cc.ID_client)
   ";
//selectez numele, prenumele si numarul de carduri pentru fiecare client

$stmt3 = mysqli_stmt_init($conn);
if(mysqli_stmt_prepare($stmt3, $query3)){

mysqli_stmt_bind_param($stmt3, "ss", $nume, $prenume);
mysqli_stmt_execute($stmt3);
$result3 = mysqli_stmt_get_result($stmt3);

while ($row3 = mysqli_fetch_assoc($result3)) {
	echo "
	<tr>
		<td>" . $result["ID_card"] . "</td>
		<td>" . $result["nr"] . "</td>

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
						<a href="../date_clienti.php">Date personale</a>
                    </li>
                    <li>
						<a href="../produse_disponibile.php">Disponibile</a>
					</li>
					<li>
						<a href="../banca_transfer.php">Banca</a>
					</li>
					<li>
						<a href="../best_seller.php">Top1</a>
					</li>
                    <li>
						<a href="../plata_cash.php">Plata cash</a>
                    </li>
                    <li>
						<a href="../client_fidel.php">Client fidel</a>
					</li>
				</ul>
			</nav>
	</footer>
	
	</body>

	</html>
