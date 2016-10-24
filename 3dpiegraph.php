<?php // content="text/plain; charset=utf-8"
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_pie.php');
require_once ('src/jpgraph_pie3d.php');






        // Verbindung zur Datenbank erstellen.
        $db = mysqli_connect("localhost", "root", "", "datenbanken2");

        // Verbindung überprüfen
        if (mysqli_connect_errno()) {
            printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
            exit();
        }
        else{

        }
        $getAllClubs = mysqli_query($db, "SELECT  Verein, Stimmen
                                      FROM `fussballvereine` WHERE Stimmen > 0 ");
        if (!$getAllClubs) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
$legend = array();
        $data = array();
        while ($zeile = mysqli_fetch_array( $getAllClubs)) {
            array_push($data,  $zeile['Stimmen']);
            array_push($legend,  $zeile['Verein']);
        }




        mysqli_close($db);







// Some data
//$data = array(40,60,21,33);

// Create the Pie Graph.
$graph = new PieGraph(350,250);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("Abstimmungsergebnis:");

// Create
$p1 = new PiePlot3D($data);
$p1->SetLegends($legend);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');

$graph->Stroke();

?>