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
				<th>ID comanda</th>
				<th>Numar produse</th>
				<th>Valoare comanda</th>
				<th>Data</th>
			</tr>
		</thead>

		<tbody>
		<?php
		$query = "SELECT C.ID_comanda, sum(P.Pret) +sum(s.Pret_optiune) as total, count(P.ID_produs), CO.Data 
		FROM comanda_plasata C 
		join produs P on C.ID_produs = P.ID_produs
		join stocare s on P.ID_produs = s.ID_produs
		join comanda CO on CO.ID_comanda = C.ID_comanda
		where s.Memorie_totala = C.Memorie_totala
		group by C.ID_comanda";

		//selectez totalul de plata si nr de produse al fiecarei comenzi
		
		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
				
					echo "
				<tr>
					<td>" . $result["ID_comanda"] . "</td>
					<td>" . $result["count(P.ID_produs)"] . "</td>
					<td>" . $result["total"] . "</td>
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
