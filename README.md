flighttracker
=============

Semesterarbeit Fluginformationssystem

Hinweise für die Entwickler:

Datenbank einrichten:datenbank 
Zuerst struktur sql importieren, dann die Daten. Die Zugangsdaten zur Datenbank können im config.php bestimmt werden.

Datenbankzugriffe:
Alle zugriffe haben über den SearchController zu erfolgen. Eine Ausnahme bildet die autocomplete funktion im java script.

MVC
Nach möglichkeit soll das MVC Prinzip strikt angewandt werden. Bei unklarheiten, oder wenn ein
Lösungsansatz zu komplex erscheint, kann im einzelfall und nach rücksprache mit der Gruppe 
davon abgewichen werden. Vorrang hat die Einhaltung des 
Zeitplans und die Funktionalität, da diese Aspekte stärker in die Bewertung des Projektes einflissen werden.


Weitere Bestimmungen:

Controller:
Sämtliche Controller haben vom abstrakten Controller zu erben

Views:
Sämtliche Views erben von der abstrakten View-Klasse

Allgemein:
Variabel-Namen werden auf englisch vergeben.
Kommentare sollten ebenfalls in englischer Sprache sein.
