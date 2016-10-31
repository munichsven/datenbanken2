<html>
<head>

    <?php

    // Verbindung zur Datenbank erstellen.
    $db = mysqli_connect("localhost", "root", "", "datenbanken2");

    // Verbindung überprüfen
    if (mysqli_connect_errno()) {
        printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
        exit();

    }


    if ($forename = $_GET['forename'] && $surname = $_GET['surname'] && $mail = $_GET['mail']) {
        $member = 0;

        echo $forename;

        $getAllClubs = mysqli_query($db, "INSERT INTO dfbmitglieder (id, vorname, nachname, mitglied, email) values (NULL,'" . $forename . "','" . $surname . "','" . $member . "','" . $mail . "')");

        if (!$getAllClubs) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
       // INSERT INTO `dfbmitglieder` (`id`, `vorname`, `nachname`, `mitglied`, `email`) VALUES (NULL, 'thomas', 'kapfhammer', '0', 'thomas@thomas');


           // mysqli_query($db, "INSERT INTO whichliga value ('" . $newClub . "',1)");



    }
  ?>


</head>
<body>



    <form action= ""    >
        <h1> Fußballnewsletter</h1>
        <h2> Bitte Kontaktdatein eingeben</h2>
        <label >Vorname:</label>
        <input type = 'text' name = 'forename'><br>
        <label>Nachname:</label>
        <input type = 'text' name = 'surname'><br>
        <label>E-Mail Adresse:</label>
        <input type = 'eMail' name = 'mail'><br>
        <input type = 'checkbox'  name = 'member'>
        <label> Mitglied in einem Verein? </label>

        <br><br>
        <h2>Gewünschte Ligen wählen</h2>

            <?php
            $getAllClubs = mysqli_query($db, "SELECT liga
                                      FROM `newsgroup` ");
            if (!$getAllClubs) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
            }
            while ($zeile = mysqli_fetch_array( $getAllClubs))
            {
                echo "<input type = 'checkbox' value = 'true' name = 'liga[]'>";
                echo "<label>" . $zeile['liga'] . "</label>";
                echo "<br>";
            }
            ?>

        <input type="submit" value = "Abbonieren" />

    </form>

</body>
</html>