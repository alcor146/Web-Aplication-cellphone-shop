<?php 
    session_start(); 
    include_once '../db_conn.php';


    $Banca = $_POST['Banca'];
    $NR = $_POST['NR_card'];
    $Cod = $_POST['Cod_securitate'];
    $Mon = $_POST['Moneda'];  
    $nume = $_POST['Nume'];
    $prenume = $_POST['Prenume'];   #in functie de datele trimise prin formular
    $exista = FALSE;

    if(isset($_POST['insert'])){

        
        $query1 = "SELECT * from client";
        $data1 = mysqli_query($conn, $query1);
        if ($data1->num_rows > 0) {
            while ($result1 = mysqli_fetch_assoc($data1)) {
                if($result1["Nume"] == $nume && $result1["Prenume"] == $prenume)
                    $ID_client = $result1["ID_client"];     //selectam ID-ul clientului in funtie de nume si prenume
            } 
        }



        $query2 = "SELECT Nume, Prenume from client";   #selectez ID-urile clientior
        $data2 = mysqli_query($conn, $query2);
        if ($data2->num_rows > 0) {
            while ($result2 = mysqli_fetch_assoc($data2)) {
                if($result2["Nume"] == $nume && $result2["Prenume"] == $prenume)
                    $exista = TRUE;     #verific daca exista in baza de date 
            }
        }

        if($exista == TRUE){
            $sql = "INSERT INTO card_credit (ID_client, Banca, NR_card, Cod_securitate, Moneda) 
            VALUES('$ID_client','$Banca','$NR','$Cod','$Mon');";   #si ii adaug cardul respectiv
            mysqli_query($conn, $sql);

            header("Location: ../carduri.php?success");
        }
        else {header("Location: ../carduri.php?client invalid"); exit();}   #daca nu exista, nu il adaug
            

    
    }
    
    header("Location: ../carduri.php?failed");
    
    
?>