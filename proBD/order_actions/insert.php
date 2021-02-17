<?php
    session_start();
    include_once '../db_conn.php';

    $comanda = $_POST['ID_comanda'];
    $nume = $_POST['Nume'];
    $prenume = $_POST['Prenume'];
    $metoda_plata = $_POST['Metoda_plata'];
    $ID_card = $_POST['ID_card'];
    $brand = $_POST['Brand'];
    $memorie = $_POST['Memorie'];

    $data_actuala = date("Y-m-d");  //data de azi pentru a verifica daca se poate modifica o comanda

    $card_valid = FALSE;
    $memorie_valida = FALSE;


    if(isset($_POST['insert'])){

        $query4 = "SELECT Memorie_totala from stocare
                        where ID_produs in (select ID_produs from produs where Brand= ? )";

        $stmt4 = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt4, $query4)){
            mysqli_stmt_bind_param($stmt4, "s", $brand);
            mysqli_stmt_execute($stmt4);
            $result4 = mysqli_stmt_get_result($stmt4);

            
            while ($row4 = mysqli_fetch_assoc($result4)) {
                if($row4["Memorie_totala"] == $memorie) //daca exista optiunea de memorie pentru brandul respectiv
                    $memorie_valida = TRUE;     //putem trece mai departe
            }
            
        }

        if($metoda_plata == 'cash'){    //daca metoda de plata este cash, nu mai verificam cardul
            $card_valid = TRUE;
            $ID_card = 0;
        }
        else if($metoda_plata == 'card'){
            $query3 = "SELECT ID_card from card_credit 
                        where ID_client in (select ID_client from client where Nume=? and Prenume=?)";

            $stmt3 = mysqli_stmt_init($conn);
            if(mysqli_stmt_prepare($stmt3, $query3)){

                mysqli_stmt_bind_param($stmt3, "ss", $nume, $prenume);
                mysqli_stmt_execute($stmt3);
                $result3 = mysqli_stmt_get_result($stmt3);

                while ($row3 = mysqli_fetch_assoc($result3)) {
                    if($row3["ID_card"] == $ID_card)   //daca apare in baza de date ca fiind cardul clientului care face comanda
                        $card_valid = TRUE;         //trecem mai departe
                }
                
            }

        }

        if($card_valid == TRUE && $memorie_valida == TRUE){
        
            $query1 = "SELECT * from produs";
            $data1 = mysqli_query($conn, $query1);
            if ($data1->num_rows > 0) {
                while ($result1 = mysqli_fetch_assoc($data1)) {
                    if($result1["Brand"] == $brand)
                        $ID_produs = $result1["ID_produs"];     //selectam ID-ul produsului in funtie de brand
                } 
            }

            $query2 = "SELECT * from client";
            $data2 = mysqli_query($conn, $query2);
            if ($data2->num_rows > 0) {
                while ($result2 = mysqli_fetch_assoc($data2)) {
                    if($result2["Nume"] == $nume && $result2["Prenume"] == $prenume )
                        $ID_client = $result2["ID_client"];     //selectam ID-ul clientului in funtie de nume si prenume
                }
            }
            //====================================

            $query7 = "SELECT * from comanda";
            $data7 = mysqli_query($conn, $query7);
                if ($data7->num_rows > 0) {
		            while ($result7 = mysqli_fetch_assoc($data7)) {
                        if($result7["ID_comanda"] == $comanda && $result7["ID_client"] == $ID_client && $result7["Data"] == $data_actuala){
                            //daca comanda exista, clientul exista(nume si prenume corecte) si nu e trecut de miezul noptii cand se proceseaza comanda
                            $sql7 = "INSERT INTO comanda_plasata (ID_comanda, ID_produs, Memorie_totala)
                                    VALUES('$comanda','$ID_produs','$memorie');";
                                    //putem adauga un produs la o comanda existenta
                            mysqli_query($conn, $sql7);
                            header("Location: ../comenzi.php?success/existing_order");
                            exit();
                        }
                    }
                }

            //=====================================
            //altfel se creeaza o comanda noua
            $sql1 = "INSERT INTO comanda (ID_client, Metoda_plata, ID_card, Data)
                                VALUES('$ID_client','$metoda_plata','$ID_card','$data_actuala')";
            mysqli_query($conn, $sql1);

            $query = "SELECT * FROM comanda ORDER BY ID_comanda DESC LIMIT 1";
            $data = mysqli_query($conn, $query);
            $result = mysqli_fetch_assoc($data);
            $ID_comanda_noua = $result["ID_comanda"];   //cautam ID-ul comenzii tocmai creata

            $sql2 = "INSERT INTO comanda_plasata (ID_comanda, ID_produs, Memorie_totala)
                                VALUES('$ID_comanda_noua','$ID_produs','$memorie')";
            mysqli_query($conn, $sql2);
            //si inseram un produs in acea comanda 
            //fiecare linie din comanda_plasata reprezinta un produs pe langa faptul ca este tabela de legatura
            header("Location: ../comenzi.php?success/new_order");
            exit();
        } else {
            header("Location: ../comenzi.php?date gresite");
            exit();
        }
    }       

    header("Location: ../comenzi.php?failed/whyyyyyyyyy?");

?>



