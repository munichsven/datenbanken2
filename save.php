<html>
<head>





</head>
<body>

<?php
$club = $_GET['choosenClub'];
echo "Es wurde gewählt: $club";

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
        $voteQuery = mysqli_query($db, "UPDATE fussballvereine SET Stimmen = Stimmen + 1 WHERE Verein = '" . $club ."'" );



        if (!$voteQuery) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        mysqli_close($db);


?>



<form action= ""    >
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
</form>






<img src="3dpiegraph.php">


</body>
</html>