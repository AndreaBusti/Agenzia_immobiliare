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
        
        
        if (isset($_POST['Nome']) && isset($_POST['pass'])&& isset($_POST['Nome_U'])) {
            
            $Nome_U=$_POST['Nome_U'];
            
            $Pass=$_POST['pass'];
            
            $Nome=$_POST['Nome'];
          
            
            
            $q = $connessione->prepare("INSERT INTO agente (Agente , Password, Nome_Utente) VALUES (:Nome, :pass , :Nome_U)");
            $q->bindParam(':Nome', $Nome);
            $q->bindParam('pass', $Pass);
            $q->bindParam(':Nome_U', $Nome_U);
            $q->execute();
            
            print ('Righe che verranno inseriste:' . $q->rowCount() . '</br>');
            //print ('Righe che verranno inseriste:' . $c->rowCount() . '</br>');
        // chiusura della connessione
        $connessione = null;  
        }  
        }catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }


