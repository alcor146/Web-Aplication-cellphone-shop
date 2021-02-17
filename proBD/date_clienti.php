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

		<form action="other_actions/search_card.php" method="POST">
			<input type="text" name="Nume" placeholder="Nume"><br>
			<input type="text" name="Prenume" placeholder="Prenume"><br>
			<input type="submit" name="insert"><br>
		</form>
		
	<table class="styled-table" >

		<thead>
			<tr>
				<th>ID</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Banca</th>
				<th>NR card</th>
				<th>Cod securitate</th>
				<th>Moneda</th>
			</tr>
		</thead>

		

		<tbody>
		<?php
		$query = "SELECT * from client 
					left join card_credit on client.ID_client = card_credit.ID_client 
					order by client.ID_client";
		//selectez datele despre clienti si cardurile lor
		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
					echo "
				<tr>
					<td>" . $result["ID_client"] . "</td>
					<td>" . $result["Nume"] . "</td>
					<td>" . $result["Prenume"] . "</td>
					<td>" . $result["Banca"] . "</td>
					<td>" . $result["NR_card"] . "</td>
					<td>" . $result["Cod_securitate"] . "</td>
					<td>" . $result["Moneda"] . "</td>
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
