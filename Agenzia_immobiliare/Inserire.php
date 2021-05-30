<?php
$host = "localhost";
        // nome del database
        $db = "agenzia";
        // username dell'utente in connessione
        $user = "root";
        // password dell'utente
        $password = "";

        /*
        blocco try/catch di gestione delle eccezioni
            */
        try {
        // stringa di connessione al DBMS
        $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        // impostazione dell'attributo per il report degli errori
        $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connessione1 = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        // impostazione dell'attributo per il report degli errori
        $connessione1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connessione2 = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        // impostazione dell'attributo per il report degli errori
        $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        if (isset($_POST['Nome']) && isset($_POST['Cognome']) && isset($_POST['dataNascita'])&& isset($_POST['CodF'])&& isset($_POST['dataAcq'])&& isset($_POST['tipo'])&& isset($_POST['Comune'])&& isset($_POST['InsAg'])&& isset($_POST['InsImm'])) {
            $tipo=$_POST['tipo'];
            
            $dataAcq=$_POST['dataAcq'];
            
            $CodF=$_POST['CodF'];
            
            $dataNascita=$_POST['dataNascita'];
            
            $Cognome=$_POST['Cognome'];
            
            $Nome=$_POST['Nome'];
            
            $Comune=$_POST['Comune'];
            
            $id_Agente=$_POST['InsAg'];
            
            $id_Immobile=$_POST['InsImm'];
            
            
            if($tipo == "Vendita"){
                $tipo=1;
            }else{
                $tipo=0;
            }
            /*echo ($tipo );
            echo ($dataAcq );
            echo ($CodF );
            echo ($dataNascita );
            echo ($Cognome );
            echo ($Nome );
            echo ($id_Agente);
            echo ($id_Immobile);
            echo($CodFis);
            echo($tipo);
            echo ($dataAcq);*/
            
            $q = $connessione->prepare("INSERT INTO acquirente ( Nome, Cognome, Codice_Fiscale, Data_di_Nascita, Comune_di_residenza) VALUES ('$Nome','$Cognome','$CodF','$dataNascita','$Comune')");
//          $q->bindParam(':Nome', $Nome);
//          $q->bindParam(':Cognome', $Cognome);
//          $q->bindParam(':Codice_Fiscale', $CodF);
//          $q->bindParam(':Data_di_Nascita', $dataNascita );
//          $q->bindParam(':Comune_di_residenza', $Comune);
            $q->execute();
                
            $c = $connessione1->prepare("INSERT INTO transazione (Id_Immobile, Id_Agente_2, Codice_Fiscale_A, Tipo, Data_di_Acquisto) VALUES ('$id_Immobile' ,'$id_Agente' ,'$CodF' ,'$tipo','$dataAcq')");
//            $c->bindParam(':Id_Immobile', $id_Immobile);
//            $c->bindParam(':id_Agente_2', $id_Agente);
//            $c->bindParam(':Codice_Fiscale_A', $CodF);
//            $c->bindParam(':Tipo', $tipo);
//            $c->bindParam(':Data_di_Acquisto', $dataAcq );
            $c->execute();
            
            
            print ('Righe che verranno inseriste:' . $q->rowCount() . '</br>');
            print ('Righe che verranno inseriste:' . $c->rowCount() . '</br>');
        // chiusura della connessione
            $x= $connessione2->prepare("DELETE FROM immobile WHERE(Id_Immobile = '".$Id_Immobile."')");
            $x->execute();
            
        $connessione2=null;
        $connessione1 = null;  
        $connessione = null;
        
        }  
        }catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }

?>