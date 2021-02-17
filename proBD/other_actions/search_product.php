<?php
session_start();
include "../db_conn.php";
$brand = $_POST['Brand'];

?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Magazin</title>
        <link rel="stylesheet" href="../style/webstyle.css">
		<link rel="stylesheet" href="../style/tablestyle.css">
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
						<a href="../comenzi.php">comenzi</a>
                    </li>
                    <li>
						<a href="../date_clienti.php">Diverse</a>
					</li>
				</ul>
			</nav>
		</header>
		
		<form action="search_product.php" method="POST">

		<input type="text" name="Brand" placeholder="Brand"><br>
        <input type="submit" name="insert"><br>
		
	</form>


	<table class="styled-table" >

		<thead>
			<tr>
                
				<th>Brand</th>
				<th>Ram</th>
				<th>Procesor</th>
				<th>Sistem de operare</th>
				<th>Garantie</th>
				<th>Pret</th>
				<th>Memorie</th>
			</tr>
		</thead>

		<tbody>
		<?php
		$query = "SELECT * from produs 
					left join stocare on produs.ID_produs = stocare.ID_produs 
					where Disponibilitate = 'Disponibil' and produs.Brand = '$brand'";
		#afisez doar produsul cu brandul cautat in formular si toate optiunile de stocare interna

		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
					echo "
				<tr>
					
					<td>" . $result["Brand"] . "</td>
					<td>" . $result["RAM"] . "</td>
					<td>" . $result["Procesor"] . "</td>
					<td>" . $result["Sistem_operare"] . "</td>
					<td>" . $result["Durata_garantie"] . "</td>
                    <td>" . $result["Pret"] . "</td>
                    <td>" . $result["Memorie_totala"] . "</td>
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