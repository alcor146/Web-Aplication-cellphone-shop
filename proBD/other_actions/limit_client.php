<?php
session_start();
include "../db_conn.php";
$nr = $_POST['NR'];
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
		
		<form action="limit_client.php" method="POST">

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
		  $query4 = "SELECT CL.Nume, CL.Prenume, CL.Adresa_email, CL.NR_telefon, CL.Adresa_fizica, sum(nr) 
          from client CL join comanda C on CL.ID_client = C.ID_client 
          join (SELECT ID_comanda, count(NR_comanda) as nr FROM comanda_plasata group by ID_comanda) 
		  As CP on C.ID_comanda = CP.ID_comanda group by CL.ID_client ORDER BY sum(nr) DESC limit ?";
		  
		  #selectez datele doar primilor $nr clienti si nr de produse cumparate cumparate de fiecare
                      

      $stmt4 = mysqli_stmt_init($conn);				#un prepared statement care imi da seteaza limita din query, nu accepta limit '$nr' 
      if(mysqli_stmt_prepare($stmt4, $query4)){
          mysqli_stmt_bind_param($stmt4, "s", $nr);
          mysqli_stmt_execute($stmt4);
          $result4 = mysqli_stmt_get_result($stmt4);

          
          while ($row4 = mysqli_fetch_assoc($result4)) {
            echo "
            <tr>
                <td>" . $row4["Nume"] . "</td>
                <td>" . $row4["Prenume"] . "</td>
                <td>" . $row4["Adresa_email"] . "</td>
                <td>" . $row4["NR_telefon"] . "</td>
                <td>" . $row4["Adresa_fizica"] . "</td>
                <td>" . $row4["sum(nr)"] . "</td>
            </tr>
            ";
          }
          echo "</table>";
          
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