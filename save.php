<html>
<head>





</head>
<body>




<?php

// Verbindung zur Datenbank erstellen.
$db = mysqli_connect("localhost", "root", "", "datenbanken2");

// Verbindung überprüfen
if (mysqli_connect_errno()) {
    printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
    exit();

}

if (!empty($_GET['voteClub'])) {
    if (empty($club = $_GET['choosenClub'])) {
        echo "<script type='text/javascript'>alert('Bitte Verein auswählen!!!')</script>";

    } else {
        mysqli_query($db, "UPDATE fussballvereine SET Stimmen = Stimmen + 1 WHERE Verein = '" . $club . "'");
        $countParticipant = mysqli_query($db, "Select sum(Stimmen) as Anzahl from fussballvereine");
        $zeile = mysqli_fetch_array($countParticipant);
        $count = $zeile['Anzahl'];
        echo "<script type='text/javascript'>alert('Wahl erfolgreich durchgeführt. Es haben bereits ' + $count +' Personen abgestimmt!' )</script>";

    }
}elseif (!empty($_GET['addClub']) && $newClub = $_GET['newClub']) {

    $checkQuery = mysqli_query($db, "SELECT * FROM fussballvereine where Verein = '" . $newClub . "'");
    $zeile = mysqli_fetch_array( $checkQuery);
    if ($zeile == ''){
        mysqli_query($db, "INSERT INTO fussballvereine value ('" . $newClub . "',1)");
    }else{
        echo "<script type='text/javascript'>alert('Verein bereits vorhanden')</script>";
    }


}
mysqli_close($db);
?>



<form action= ""   >
    <select name = "choosenClub">
        <option value = ""> </option>
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
        $getAllClubs = mysqli_query($db, "SELECT Verein, Stimmen
                                      FROM `fussballvereine` ");
        if (!$getAllClubs) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        while ($zeile = mysqli_fetch_array( $getAllClubs))
        {
            echo "<option value = ". $zeile['Verein'] . "    >". $zeile['Verein'] . " ". $zeile['Stimmen'] . " </option>";
        }
        mysqli_close($db);
        ?>

<input type="submit" value = "Abstimmen" />
        <input type = 'hidden' value = 'true' name = 'voteClub'>
</form>


<form action= "">
<input type = 'hidden' value = 'true' name = 'addClub'>
<input name = 'newClub' type = 'text' value = ''>
<input type = 'submit' value = "Hinzufuegen">
</form>



<img src="3dpiegraph.php">


</body>
</html>