<html>
<head>
    <meta charset="utf-8">
    <title>Voting</title>
</head>
<body>
<h1>Verein wählen</h1>
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
        echo "<script type='text/javascript'>alert('Neuer Verein erfolgreich hinzugefügt!')</script>";
    }else{
        echo "<script type='text/javascript'>alert('Verein bereits vorhanden')</script>";
    }
}

?>



<form action= ""   >
    <select name = "choosenClub" style = "width : 200px;">
        <option value = ""> </option>
        <?php
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
        </select>
        <input type="submit" value = "Abstimmen" />
        <input type = 'hidden' value = 'true' name = 'voteClub'>
</form>

<form action= "">
    <input type = 'hidden' value = 'true' name = 'addClub'>
    <input name = 'newClub' type = 'text' value = '' style = "width : 200px;">
    <input type = 'submit' value = "Hinzufuegen">
</form>


<img src="3dpiegraph.php">

</body>
</html>