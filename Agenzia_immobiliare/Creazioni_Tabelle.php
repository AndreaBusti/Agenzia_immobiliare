<?php

class Crea_Tabs {

    public $connessione = null;

    function tab_Acquirente() {
        global $connessione;
        try {
            // creazione e popolamento della tabella
            $crea_tb = $connessione->exec("CREATE TABLE IF NOT EXISTS Acquirente (
            Nome varchar(30) NOT NULL,
            Cognome varchar(30) NOT NULL,
            Codice_Fiscale varchar(16) NOT NULL,
            Data_di_Nascita date,
            Comune_di_residenza varchar(30) NOT NULL,
            PRIMARY KEY (Codice_fiscale)
            )");
        } catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }
    }
    
    function tab_Venditore() {
        global $connessione;
        try {
            // creazione e popolamento della tabella
            $crea_tb = $connessione->exec("CREATE TABLE IF NOT EXISTS Venditore (
            Nome varchar(30) NOT NULL,
            Cognome varchar(30) NOT NULL,
            Codice_Fiscale varchar(16) NOT NULL,
            Data_di_Nascita date,
            Comune_di_residenza varchar(30) NOT NULL,
            Id_Agente int (10) NOT NULL,
            PRIMARY KEY (Codice_Fiscale),
            FOREIGN KEY (Id_Agente) REFERENCES Agente (Id_Agente)
            )");
        } catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }
    }

    function tab_Agente() {
        global $connessione;
        try {
            /*
              blocco try/catch di gestione delle eccezioni
             */
            // stringa di connessione al DBMS
            // creazione e popolamento della tabella
            $crea_tb = $connessione->exec("CREATE TABLE IF NOT EXISTS Agente (
            Id_Agente int(10) NOT NULL AUTO_INCREMENT,
            Agente varchar(30) NOT NULL,
            Password varchar(30) NOT NULL,
            Nome_Utente varchar(30) NOT NULL,
            PRIMARY KEY (Id_Agente)
            )");
        } catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }
    }
    
    function tab_Immobile() {
        global $connessione;
        try {
            /*
              blocco try/catch di gestione delle eccezioni
             */
            // stringa di connessione al DBMS
            // creazione e popolamento della tabella
            $crea_tb = $connessione->exec("CREATE TABLE IF NOT EXISTS Immobile (
            Id_Immobile int(10) NOT NULL AUTO_INCREMENT,
            Tipo_Imm varchar(20) NOT NULL,
            Comune varchar(30) NOT NULL,
            Via varchar(30) NOT NULL,
            N_Civ varchar(4) NOT NULL,
            Piano int(3) NOT NULL,
            Posto_auto bit,
            Garage bit,
            Metri_quadri float(10) NOT NULL,
            Codice_Fiscale_V varchar(16) NOT NULL,
            PRIMARY KEY (Id_Immobile),
            FOREIGN KEY (Codice_Fiscale_V) REFERENCES Venditore (Codice_Fiscale)
            )");
        } catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }
    }
    
    function tab_Transazione() {
        global $connessione;
        try {
            /*
              blocco try/catch di gestione delle eccezioni
             */
            // creazione della tabella
            $crea_tb = $connessione->exec("CREATE TABLE IF NOT EXISTS Transazione (
            Id_Immobile int(10) NOT NULL ,
            Id_Agente_2 int(10) NOT NULL ,
            Codice_Fiscale_A varchar(16) NOT NULL ,
            Tipo int(1) NOT NULL,
            Data_di_Acquisto date,
            FOREIGN KEY (Id_Immobile) REFERENCES Immobile (Id_Immobile),
            FOREIGN KEY (Id_Agente_2) REFERENCES Agente (Id_Agente),
            FOREIGN KEY (Codice_Fiscale_A) REFERENCES Acquirente (Codice_Fiscale)
            )");
        } catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }
    }

    function connect() {
        global $connessione;
        $host = "localhost";
        // nome del database
        $db = "agenzia";
        // username dell'utente in connessione
        $user = "root";
        // password dell'utente
        $password = "";
        try {
            /*
              blocco try/catch di gestione delle eccezioni
             */
            // stringa di connessione al DBMS
            $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Attenzione' . $e->getMessage();
        }
    }
}
    
$ogg = new Crea_Tabs();
$ogg->connect();
$ogg->tab_Agente();
$ogg->tab_Acquirente();
$ogg->tab_Venditore();
$ogg->tab_Transazione();
$ogg->tab_Immobile();

?>

