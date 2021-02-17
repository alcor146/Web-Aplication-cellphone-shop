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
		
		
    <form action="order_actions/insert.php" method="POST">
        <input type="text" name="ID_comanda" placeholder="ID comanda"><br>
		<input type="text" name="Nume" placeholder="Nume"><br>
		<input type="text" name="Prenume" placeholder="Prenume"><br>
        <input type="text" name="Metoda_plata" placeholder="Metoda de plata"><br>
        <input type="text" name="ID_card" placeholder="ID card"><br>
        <input type="text" name="Brand" placeholder="Brand"><br>
        <input type="text" name="Memorie" placeholder="Memorie"><br>
		<input type="submit" name="insert"><br>
	</form>


	<table class="styled-table" >

		<thead>
			<tr>
				
                <th>ID comanda</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Metoda de plata</th>
				<th>ID card credit</th>
				<th>Produs</th>
                <th>Memorie</th>
                <th>Data</th>
				<th colspan="2" align="center">Operation</th>
			</tr>
		</thead>

		<tbody>
		<?php
		$query = "SELECT * from comanda_plasata
        inner join produs on produs.ID_produs = comanda_plasata.ID_produs
        inner join comanda on comanda.ID_comanda = comanda_plasata.ID_comanda
        inner join client on client.ID_client = comanda.ID_client
		order by comanda_plasata.ID_comanda asc";
		
		//selectez toate datele importante ale comenziilor
		
		$data = mysqli_query($conn, $query);
		$total = $data->num_rows;

		if ($total > 0) {
			while ($result = mysqli_fetch_assoc($data)) {
                
				    if($result["Metoda_plata"] === "cash")
					    $result["ID_card"] = "-";
					echo "
				<tr>
					
					<td>".$result["ID_comanda"]."</td>
					<td>".$result["Nume"]."</td>
					<td>".$result["Prenume"]."</td>
					<td>".$result["Metoda_plata"]."</td>
					<td>".$result["ID_card"]."</td>
                    <td>".$result["Brand"]."</td>
                    <td>".$result["Memorie_totala"]."</td>
                    <td>".$result["Data"]."</td>
                    <td><a href = 'order_actions/update_page.php? nr_comanda=$result[NR_comanda] & id_comanda=$result[ID_comanda] & nume=$result[Nume] & prenume=$result[Prenume] & metodaP=$result[Metoda_plata]
					 & id_card=$result[ID_card] & brand=$result[Brand] & memorie=$result[Memorie_totala] & data=$result[Data]'>Update</td>
					 
					<td><a href = 'order_actions/delete.php? nr=$result[NR_comanda] & ID=$result[ID_comanda]'>Delete</td>
					
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
