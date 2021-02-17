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
						<a href="../complex.php">Diverse</a>
					</li>
				</ul>
			</nav>
		</header>

		<form action="select_memorie.php" method="POST">

		<input type="text" name="Brand" placeholder="Brand"><br>
		<input type="submit" name="insert"><br>
		
	<table class="styled-table" >

		<thead>
			<tr><th>Brand</th>
				<th>Memorie</th>
				<th>Pret optiune</th>
				<th>Numar produse cu aceeasi optiune</th>
			</tr>
		</thead>

		<tbody>
		<?php


$query4 = "SELECT  s.Memorie_totala , C.pret, C.nr from stocare s
join (select stocare.Memorie_totala as mem, stocare.Pret_optiune as pret, count(stocare.Memorie_totala) as nr from stocare 
join produs P on P.ID_produs = stocare.ID_produs
group by stocare.Memorie_totala) as C 
on C.mem = s.Memorie_totala
where s.ID_produs = (select ID_produs from produs where Brand= ?)
";
//selectez toate optiunile de memorie interna disponibile pentru un Brand
// precum si cate alte Branduri dispun de optiunea asta

$stmt4 = mysqli_stmt_init($conn);
if(mysqli_stmt_prepare($stmt4, $query4)){
mysqli_stmt_bind_param($stmt4, "s", $brand);
mysqli_stmt_execute($stmt4);
$result4 = mysqli_stmt_get_result($stmt4);


while ($row4 = mysqli_fetch_assoc($result4)) {
echo "
<tr>
	<td>" . $brand . "</td>
	<td>" . $row4["Memorie_totala"] . "</td>
	<td>" . $row4["pret"] . "</td>
	<td>" . $row4["nr"] . "</td>
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
