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

    if ($mail = $_GET['forename'] && $surename = $_GET['surname'] && $mail = $_GET['mail']) {





    }
  ?>


</head>
<body>



    <form action= ""   >
        <label>Vorname:</label>
        <input type = 'text' name = 'forename'><br>
        <label>Nachname:</label>
        <input type = 'text' name = 'surname'><br>
        <label>e-Mail Adresse:</label>
        <input type = 'eMail' name = 'mail'><br>
        <input type = 'radio' name = 'member'><br>
            <?php
            $getAllClubs = mysqli_query($db, "SELECT liga
                                      FROM `newsgroup` ");
            if (!$getAllClubs) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
            }
            while ($zeile = mysqli_fetch_array( $getAllClubs))
            {
                echo "<input type = 'checkbox' value = 'true' name = 'liga[]'>" . $zeile['liga'];
                echo "<br>";
            }
            mysqli_close($db);
            ?>

        <input type="submit" value = "Abbonieren" />
        <input type = 'hidden' value = 'true' name = 'voteClub'>
    </form>

</body>
</html>