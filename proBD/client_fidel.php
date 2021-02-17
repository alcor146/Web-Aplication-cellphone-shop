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
	
	<form action="other_actions/limit_client.php" method="POST">

		<input type="text" name="NR" placeholder="NR"><br>
		<input type="submit" name="insert"><br>
	</form>
	


	<table class="styled-table" >

    <thead>
			<tr>
				
				<th>Nume</th>
				<th>Prenume</th>
				<th>Mail</th>
				<th>Telefon</th>
				<th>Adresa</th>
				<th>Produse cumparate</th>
				
			</tr>
		</thead>

		<tbody>
		<?php
		 $query = "SELECT CL.Nume, CL.Prenume, CL.Adresa_email, CL.NR_telefon, CL.Adresa_fizica, sum(nr) 
					from client CL join comanda C on CL.ID_client = C.ID_client 
					join (SELECT ID_comanda, count(NR_comanda) as nr FROM comanda_plasata group by ID_comanda) 
					As CP on C.ID_comanda = CP.ID_comanda group by CL.ID_client ORDER BY sum(nr) DESC ";
					#afisez doar toate informatiile legate de clienti afisati in ordinea nr de produse cumparate elemente
					# queryul imi calculeaza numarul de produse cumparate de catre fiecare client
					
		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;
		
		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
					echo "
				<tr>
					
					<td>" . $result["Nume"] . "</td>
					<td>" . $result["Prenume"] . "</td>
					<td>" . $result["Adresa_email"] . "</td>
					<td>" . $result["NR_telefon"] . "</td>
					<td>" . $result["Adresa_fizica"] . "</td>
					<td>" . $result["sum(nr)"] . "</td>
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