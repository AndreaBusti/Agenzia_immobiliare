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
        
       
        
        if (isset($_POST['Nome']) && isset($_POST['Cognome']) && isset($_POST['dataNascita'])&& isset($_POST['CodF'])&& isset($_POST['Comune'])&& isset($_POST['InsAg'])) {

            $CodF=$_POST['CodF'];
            
            $dataNascita=$_POST['dataNascita'];
            
            $Cognome=$_POST['Cognome'];
            
            $Nome=$_POST['Nome'];
            
            $Comune=$_POST['Comune'];
            
            $id_Agente=$_POST['InsAg'];
            
            
            $q = $connessione->prepare("INSERT INTO venditore (Nome, Cognome, Codice_Fiscale, Data_di_Nascita, Comune_di_residenza, Id_Agente) VALUES ('$Nome','$Cognome','$CodF','$dataNascita','$Comune','$id_Agente')");
            /*$q->bindParam(':Nome', $Nome);
            $q->bindParam(':Cognome', $Cognome);
            $q->bindParam(':Codice_Fiscale', $CodF);
            $q->bindParam(':Data_di_Nascita', $dataNascita );
            $q->bindParam(':Comune_di_residenza', $Comune);*/
            $q->execute();
            
            print ('Righe che verranno inseriste:' . $q->rowCount() . '</br>');
            //print ('Righe che verranno inseriste:' . $c->rowCount() . '</br>');
        // chiusura della connessione
        $connessione = null;  
        }  
        }catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }

?>
