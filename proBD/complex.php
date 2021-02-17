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

		<form action="other_actions/select_memorie.php" method="POST">

		<input type="text" name="Brand" placeholder="Brand"><br>
		<input type="submit" name="insert"><br>
		
	<table class="styled-table" >

		<thead>
			<tr>
				<th>Memorie</th>
			</tr>
		</thead>

		<tbody>
		<?php


$query4 = "SELECT Brand from produs where Disponibilitate = 'Disponibil'";
//lista de branduri disponibile
$data4 = mysqli_query($conn, $query4);
if ($data4->num_rows > 0) {
	while ($result4 = mysqli_fetch_assoc($data4)) {
		echo "
<tr>
	<td>" . $result4["Brand"] . "</td>
</tr>
";
}
echo "</table>";
} else {
echo "no results";
}


					
		?>
	</tbody>
    </table>
    
	<footer>
	<div class="logo">
				web
			</div>
			<nav>
				<ul><li>
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
