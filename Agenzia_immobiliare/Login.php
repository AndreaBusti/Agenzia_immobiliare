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
session_start();
if (!isset($_SESSION['tentativi'])) {
    $_SESSION['tentativi'] = 0;
}


if ($_SESSION['tentativi'] < 3) {

    try {
        // stringa di connessione al DBMS
        $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        // impostazione dell'attributo per il report degli errori
        $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['NomeUtente']) && isset($_POST['Password']) && isset($_SESSION['tentativi'])) {
            $NomeUtente = $_POST['NomeUtente'];
            $Pwd = $_POST['Password'];
            //$Tent == $_POST['tentativi'];
            $x = 0;
            $sql = "SELECT * FROM agente";
            foreach ($connessione->query($sql) as $riga) {
                if ($NomeUtente == $riga['Nome_Utente'] && $Pwd == $riga['Password'] && $x == 0) {
                    echo("Ben Tornato " . $NomeUtente);
                    $x = 1;
                    if($NomeUtente ==="andrea_busti" && $Pwd === "busti"){
                        $c=1;
                    }
                }
            }
            if ($x == 0) {
                $_SESSION['tentativi'] = $_SESSION['tentativi'] + 1;
                echo("il NOME UTENTE o la PASSWORD sono errati " . $_SESSION['tentativi']);
                header("Location: index.html");
            } else if($x == 1 && $c == 0){
                header("Location: InserimentoImm.html");
                } else{
                    echo 'sisauibaibdiubsdibaiudbiuabsdibaibsdib';
                    header("Location: InserAd.html");
                }
            }
            if ($_SESSION['tentativi'] == 3) {
                
                echo("se sei un agente immobiliare e non sei loggato fatti inserisre dall'admin");
                header("Location: index.html");
                $_SESSION['tentativi'] = 0;
            }
            // chiusura della connessione
            $connessione = null;
        
    } catch (PDOException $e) {
        echo 'Attenzione' . $e->getMessage();
    }
}
?>
