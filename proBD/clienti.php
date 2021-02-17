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
		
		
	<form action="client_actions/insert.php" method="POST">

		<input type="text" name="Nume" placeholder="Nume"><br>
		<input type="text" name="Prenume" placeholder="Prenume"><br>
        <input type="text" name="Adresa_email" placeholder="Adresa_email"><br>
        <input type="text" name="NR_telefon" placeholder="NR_telefon"><br>
        <input type="text" name="Adresa_fizica" placeholder="Adresa_fizica"><br>
        <input type="text" name="Parola" placeholder="Parola"><br>
		<input type="submit" name="insert"><br>
	</form>


	<table class="styled-table" >

		<thead>
			<tr>
				<th>ID_client</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Mail</th>
				<th>Telefon</th>
				<th>Adresa</th>
				<th>Parola</th>
				<th colspan="2" align="center">Operation</th>
			</tr>
		</thead>

		<tbody>
		<?php
		$query = "SELECT * from client";
		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
					echo "
				<tr>
					<td>" . $result["ID_client"] . "</td>
					<td>" . $result["Nume"] . "</td>
					<td>" . $result["Prenume"] . "</td>
					<td>" . $result["Adresa_email"] . "</td>
					<td>" . $result["NR_telefon"] . "</td>
					<td>" . $result["Adresa_fizica"] . "</td>
					<td>" . $result["Parola"] . "</td>
					<td><a href = 'client_actions/update_page.php? id=$result[ID_client] & nume=$result[Nume] & prenume=$result[Prenume] & mail=$result[Adresa_email] & telefon=$result[NR_telefon] & adresa=$result[Adresa_fizica] & parola=$result[Parola]'>Update</td>
					<td><a href = 'client_actions/delete.php?id=$result[ID_client]'>Delete</td>
					
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
