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
        
        

        
        if (isset($_POST['Nome']) && isset($_POST['Cognome']) && isset($_POST['Via'])&& isset($_POST['comune'])&& isset($_POST['N_Civ'])&& isset($_POST['metri']) && isset($_POST['PAuto'])) {
            
            $metri=$_POST['metri'];
            
            $via=$_POST['Via'];
            
            $NCiv=$_POST['N_Civ'];
            
            $Cognome=$_POST['Cognome'];
            
            $Nome=$_POST['Nome'];
            
            $comune=$_POST['comune'];
            
            $tipo=$_POST['TipImm'];
            
            $PAuto=$_POST['PAuto'];
            
            $garage=$_POST['gar'];
            
            $piano=$_POST['pia'];
            if($PAuto === "on"){
                $PAuto=1;
            } else {
                $PAuto=0;
            }
            if($garage === "on"){
                $garage=1;
            } else {
                $garage=0;
            }
            echo ($garage);
            echo ($PAuto);
            
            $sql = "SELECT venditore.Nome, venditore.Cognome FROM venditore";
            foreach ($connessione->query($sql) as $riga) {
                if ($Nome == $riga['Nome'] && $Cognome == $riga['Cognome']) {
                    $CodF=$riga['Codice_Fiscale'];
                    $q = $connessione->prepare("INSERT INTO immobile ( Tipo_Imm, Comune, Via, N_Civ, Piano, Posto_auto, Garage, Metri_quadri, Codice_Fiscale_V ) VALUES (:tipo_Imm, :comune, :via, :n_Civ, :pia, :pos, :garage, :metri_quadri, :codice_Fiscale_V)");
                    $q->bindParam(':tipo_Imm', $tipo);
                    $q->bindParam(':comune', $comune);
                    $q->bindParam(':via', $via);
                    $q->bindParam(':n_Civ', $NCiv);
                    $q->bindParam(':pia', $piano);
                    $q->bindParam(':pos', $PAuto);
                    $q->bindParam(':garage', $garage);
                    $q->bindParam(':metri_quadri', $metri);
                    $q->bindParam(':codice_Fiscale_V', $CodF);
                    $q->execute();
                    print ('Righe che verranno inseriste:' . $q->rowCount() . '</br>');
                }
                header("Location: InsVen2.html");
            }
        // chiusura della connessione
        $connessione = null;  
        }  
        }catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }

?>

