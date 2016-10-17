    <?php
        // Verbindung zur Datenbank erstellen.
        $db = mysqli_connect("localhost", "root", "", "datenbanken2");

        // Verbindung überprüfen
        if (mysqli_connect_errno()) {
            printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
            exit();
        }
        else{
            echo "Verbindung erfolgreich!!!";
        }

    $getAllClubs = mysqli_query($db, "SELECT Verein
                                      FROM `fußballvereine` ");
    echo $getAllClubs;

    function insertNewClub ($db, $name)
    {
        $sql = "INSERT INTO Fußballverein (Verein, Stimmen)
        VALUES ($name, 0)";

        if ($db->query($sql) === TRUE) {
            echo "Neuer Verein angelegt";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    }
    // Antwort der Datenbank in ein assoziatives Array übergeben
    $resultat = mysqli_fetch_assoc($befehl);
    echo 

    // MySQL-Version aus dem Resultat-Array auslesen
    //echo "Wir arbeiten mit MySQL-Version {$resultat['version']}";

    // Verbindung zum Datenbankserver beenden
    mysqli_close($db);
    ?>
