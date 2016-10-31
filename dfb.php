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

    if (!empty($_GET['saveData'])) {


    $forename = $_GET['forename'];
    $surname = $_GET['surname'];
    $mail = $_GET['mail'];
    $member = $_GET['member'];

    if ( (!empty($forename)) && (!empty($surname))&& (!empty($mail) )) {

        if ($member == 'on'){
            $member = 1;
        } else{
            $member = 0;
        }




        $getAllClubs = mysqli_query($db, "INSERT INTO dfbmitglieder (id, vorname, nachname, mitglied, email) values (NULL,'" . $forename . "','" . $surname . "','" . $member . "','" . $mail . "')");

        $lastInsertID = mysqli_query($db, "SELECT LAST_INSERT_ID() as lastID");
        $zeile = mysqli_fetch_array( $lastInsertID);
        $lastID =  $zeile['lastID'];


        $ligaArray = $_GET['liga'];
        foreach ($ligaArray as $liga) {
            mysqli_query($db, "INSERT INTO whichliga (dfb_mitglied, liga) values ('" . $lastID . "','" . $liga . "')");
        }


        if (!$getAllClubs) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
       // INSERT INTO `dfbmitglieder` (`id`, `vorname`, `nachname`, `mitglied`, `email`) VALUES (NULL, 'thomas', 'kapfhammer', '0', 'thomas@thomas');


           // mysqli_query($db, "INSERT INTO whichliga value ('" . $newClub . "',1)");

        echo "<script type='text/javascript'>alert('Daten erfolgreich gespeichert!')</script>";

    } else{
        echo "<script type='text/javascript'>alert('Fornular bitte korrekt füllen!')</script>";
    }
    }
  ?>


</head>
<body>



    <form action= ""    >
        <h1> Fußballnewsletter</h1>
        <h2> Bitte Kontaktdatein eingeben</h2>
        <label >Vorname:</label>



        <input type = 'text' name = 'forename' value = '' ><br>
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
                echo "<input type = 'checkbox' value = '" . $zeile['liga'] . "' name = 'liga[]'>";
                echo "<label>" . $zeile['liga'] . "</label>";
                echo "<br>";
            }
            ?>

        <input type="submit" value = "Abbonieren" />
        <input type = 'hidden' value = 'true' name = 'saveData'>

    </form>

</body>
</html>