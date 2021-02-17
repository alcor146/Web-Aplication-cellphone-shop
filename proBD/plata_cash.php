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
			<tr>
				<th>ID_comanda</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Data</th>
			</tr>
		</thead>

		<tbody>
			
		<?php
        $query = "SELECT ID_comanda, Nume, Prenume, Data
				from client 
                inner join comanda on client.ID_client = comanda.ID_client
				where Metoda_plata = 'cash' order by Data desc";
		//selectez comenzile unde metoda de plata este cash

		
		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
				//if ($result["ID_client"] === $_SESSION['ID_client'])
					echo "
				<tr>
					<td>" . $result["ID_comanda"] . "</td>
					<td>" . $result["Nume"] . "</td>
					<td>" . $result["Prenume"] . "</td>
					<td>" . $result["Data"] . "</td>
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