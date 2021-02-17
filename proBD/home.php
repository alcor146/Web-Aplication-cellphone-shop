<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['Nume']) && isset($_SESSION['ID_client'])) {

?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Magazin</title>
		<link rel="stylesheet" href="style/webstyle.css">
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

		<div class="banner"><img alt="" src="https://i.postimg.cc/mg7z92hr/1.jpg"></div>

		<!-- nimic interesant, are rolul de a arata conexiunea la baza de date si arata bine -->
		
	</body>
</html>

<?php
} else {
	header("Location: index.php");
	exit();
}
?>