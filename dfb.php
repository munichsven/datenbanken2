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

        echo $mail .   $surename . $mail;
        $liga1 = $_GET['liga1'];
        echo $liga1;
        $liga2 = $_GET['liga2'];
        echo $liga2;
        $liga2 = $_GET['liga2'];
        echo $liga2;

           // mysqli_query($db, "UPDATE fussballvereine SET Stimmen = Stimmen + 1 WHERE Verein = '" . $club . "'");
            //$countParticipant = mysqli_query($db, "Select sum(Stimmen) as Anzahl from fussballvereine");
            //$zeile = mysqli_fetch_array($countParticipant);
           // $count = $zeile['Anzahl'];
           // echo "<script type='text/javascript'>alert('Wahl erfolgreich durchgeführt. Es haben bereits ' + $count +' Personen abgestimmt!' )</script>";


    }
  ?>


</head>
<body>

<form >
    Vorname: <input type = 'text' name = 'forename'><br>
    Nachname: <input type = 'text' name = 'surname'><br>
    e-Mail Adresse:<input type = 'eMail' name = 'mail'><br>
    <input type = 'checkbox' value = 'true' name = 'liga[]' >1.Liga <br>
    <input type = 'checkbox' value = 'true' name = 'liga[]' >2.Liga <br>
    <input type = 'checkbox' value = 'true' name = 'liga[]' >3.Liga <br>
    <input type = 'checkbox' value = 'true' name = 'liga[]' >Regionalliga <br>
    <input type = 'checkbox' value = 'true' name = 'liga[]' >WM 2016 <br>
    <input type = 'checkbox' value = 'true' name = 'liga[]'>DFB <br>
    <input type = 'submit' value = 'Daten speichern'>




</body>
</html>