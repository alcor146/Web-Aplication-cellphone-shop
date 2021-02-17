
  <?php 
  include_once '../db_conn.php';

  $NR = $_GET['nr'];
  $ID = $_GET['ID'];

  //pentru produse terbuie sa sterg din doua tabele: comanda si comanda plasata
  $query2 = "DELETE from comanda_plasata where NR_comanda = '$NR'"; #sterg produsul respectiv dintr-o comanda in functie de cheia primara
  $data2 = mysqli_query($conn, $query2);

  $query = "SELECT * from comanda_plasata  where ID_comanda = '$ID'"; 
  $data = mysqli_query($conn, $query);                                
  $total = $data->num_rows;

  if ($total == 0) {  #daca am sters si ultimul produs dintr-o anumita comanda
      $query1 = "DELETE from comanda where ID_comanda = '$ID'";   #sterg comamnda cu totul
      $data1 = mysqli_query($conn, $query1);
  }

  header("Location: ../comenzi.php?succes");

  ?>