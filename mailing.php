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
    <h1> Mail Versand</h1>
    <h2> Bitte wählen</h2>
    <input type = 'radio' value = '0' name = 'member'>
    <label> An alle Personen </label>
    <br>
    <input type = 'radio' value = '1' name = 'member'>
    <label> Nur Personen, die Mitglied in einem Verein sind? </label>
    <br>
    <input type = 'radio' value = '2' name = 'member'>
    <label> Nur Personen, die keine Mitglieder in einem Verein sind? </label>

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
    <br>
    <label> Bitte Betreff angeben</label><br>
    <input type = 'text' name = 'subject' placeholder = 'Betreff'>
    <br><br>
    <span> Bitte eine Nachricht eingeben!</span><br>
    <textarea cols = '50' rows = '5' name = 'message' placeholder = 'Enter some news'></textarea>
    <br><br>
    <input type="submit" value = "Versenden" />
    <input type = 'hidden' value = 'true' name = 'sendMail'>

</form>

</body>
</html>