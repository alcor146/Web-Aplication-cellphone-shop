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
				<th>ID_produs</th>
				<th>Brand</th>
				<th>RAM</th>
                <th>Sistem operare</th>
                <th>Garantie</th>
                <th>Pret</th>
				<th>Produse vandute</th>
			</tr>
		</thead>

		<tbody>
			
		<?php
        $query = "SELECT * from produs P
                	join (SELECT ID_produs, COUNT(ID_produs) FROM   comanda_plasata
							GROUP BY ID_produs
							ORDER BY COUNT(ID_produs) DESC) as CP on P.ID_produs = CP.ID_produs
					group by P.ID_produs
					limit 1";
		//selectez cel mai bine vandut produs

		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
				
					echo "
				<tr>
					<td>" . $result["ID_produs"] . "</td>
					<td>" . $result["Brand"] . "</td>
					<td>" . $result["RAM"] . "</td>
                    <td>" . $result["Sistem_operare"] . "</td>
					<td>" . $result["Durata_garantie"] . "</td>
					<td>" . $result["Pret"] . "</td>
					<td>" . $result["COUNT(ID_produs)"] . "</td>
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