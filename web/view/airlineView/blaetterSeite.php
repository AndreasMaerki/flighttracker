<?php
$seite = $_GET["seite"];  //Abfrage auf welcher Seite man ist

//Wenn man keine Seite angegeben hat, ist man automatisch auf Seite 1
if(!isset($seite))
   {
   $seite = 1;
   }

//Verbindung zu Datenbank aufbauen

$link = mysql_connect("localhost","Username","Passwort") or die ("Keine Verbindung moeglich");
mysql_select_db("Datenbank") or die ("Die Datenbank existiert nicht");


//Einträge pro Seite: Hier 15 pro Seite
$eintraege_pro_seite = 15;

//Ausrechen welche Spalte man zuerst ausgeben muss:

$start = $seite * $eintraege_pro_seite - $eintraege_pro_seite;


//Tabelle Abfragen
//Tabelle hei&szlig;t hier einfach: Tabelle
$abfrage = "SELECT * FROM Tabelle LIMIT $start, $eintraege_pro_seite";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
    {
   echo $row->id."<br>"; // Hier die Ausgabe der Einträge
   }


//Jetzt kommt das "Inhaltsverzeichnis",
//sprich dort steht jetzt: Seite: 1 2 3 4 5


//Wieviele Einträge gibt es überhaupt

//Wichtig! Hier muss die gleiche Abfrage sein, wie bei der Ausgabe der Daten
//also der gleiche Text wie in der Variable $abfrage, blo&szlig; das hier das LIMIT fehlt
//Sonst funktioniert die Blätterfunktion nicht richtig,
//und hier kann nur 1 Feld abgefragt werden, also id

$result = mysql_query("SELECT id FROM Tabelle");
$menge = mysql_num_rows($result);

//Errechnen wieviele Seiten es geben wird
$wieviel_seiten = $menge / $eintraege_pro_seite;

//Ausgabe der Seitenlinks:
echo "<div align=\"center\">";
echo "<b>Seite:</b> ";


//Ausgabe der Links zu den Seiten
for($a=0; $a < $wieviel_seiten; $a++)
   {
   $b = $a + 1;

   //Wenn der User sich auf dieser Seite befindet, keinen Link ausgeben
   if($seite == $b)
      {
      echo "  <b>$b</b> ";
      }

   //Aus dieser Seite ist der User nicht, also einen Link ausgeben
   else
      {
      echo "  <a href=\"?seite=$b\">$b</a> ";
      }


   }
echo "</div>";
?> 