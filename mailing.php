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

    if (!empty($_GET['sendMail'])) {


        $subject = $_GET['subject'];
        $message = $_GET['message'];

        echo "Betreff: " . $subject;
        echo "<br>";
        echo "Nachricht: " . $message;
        echo "<br>";

            if ($member == '1'){
                $memberSQL = " AND a.mitglied = '1' ";
            } else if ($member == '2'){
                $memberSQL = " AND a.mitglied = '0' ";
            }else if ($member == '0'){
                $memberSQL = "";
            } else{
            echo "<script type='text/javascript'>alert('Bitte Personenkreis wählen')</script>";
            }
        $ligaString = "";
        $first = true;
        $ligaArray = $_GET['liga'];
        foreach ($ligaArray as $liga) {
            if ($first){
                $ligaString += "b.liga = '" . $liga . "'";
                $first = false;
            }else {
                $ligaString += "OR b.liga = '" . $liga . "'";
            }

        }


        "SELECT a.mail from  dfbmitglieder a join whichliga b on (b.dfbmitglied = a.id) where " . memberSQL . " AND (". $ligaString .")";
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