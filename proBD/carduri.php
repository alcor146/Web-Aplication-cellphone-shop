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
	
	
	
	<form action="card_actions/insert.php" method="POST">
		<input type="text" name="Nume" placeholder="Nume"><br>
		<input type="text" name="Prenume" placeholder="Prenume"><br>
		<input type="text" name="Banca" placeholder="Banca"><br>
		<input type="text" name="NR_card" placeholder="NR_card"><br>
		<input type="text" name="Cod_securitate" placeholder="Cod_securitate"><br>
		<input type="text" name="Moneda" placeholder="Moneda"><br>
		<input type="submit" name="insert"><br>
	</form>


	<table class="styled-table" >

		<thead>
			<tr>
				<th>ID_card</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Banca</th>
				<th>NR_card</th>
				<th>Cod_securitate</th>
				<th>Moneda</th>
				<th colspan="2" align="center">Operation</th>
			</tr>
		</thead>

		<tbody>
			
		<?php
		$query = "SELECT * from card_credit cc join client c on c.ID_client = cc.ID_client";
		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
				
					echo "
				<tr>
					<td>" . $result["ID_card"] . "</td>
					<td>" . $result["Nume"] . "</td>
					<td>" . $result["Prenume"] . "</td>
					<td>" . $result["Banca"] . "</td>
					<td>" . $result["NR_card"] . "</td>
					<td>" . $result["Cod_securitate"] . "</td>
					<td>" . $result["Moneda"] . "</td>
					<td><a href = 'card_actions/update_page.php? id=$result[ID_card] &nume=$result[Nume] & prenume=$result[Prenume] & banca=$result[Banca] & nr=$result[NR_card] & cod=$result[Cod_securitate] & moneda=$result[Moneda]'>Update</td>
					<td><a href = 'card_actions/delete.php?id=$result[ID_card]'>Delete</td>
					
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

	
</body>

</html>