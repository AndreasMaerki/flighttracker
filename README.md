flighttracker
=============

Semesterarbeit Fluginformationssystem

Hinweise für die Entwickler:

Datenbank einrichten:
Zuerst struktur sql importieren, dann die Daten. Die Zugangsdaten zur Datenbank können dem config.php entnommen werden.

Datenbankzugriffe:
Alle zugriffe erfolgen über den SearchController. Eine Ausnahme bildet die autocomplete funktion im java script.

MVC:
Nach möglichkeit soll das MVC Prinzip strikt angewandt werden. Bei Unklarheiten, oder wenn ein
Lösungsansatz zu komplex erscheint, kann im Einzelfall und nach Rücksprache mit der Gruppe 
davon abgewichen werden. Vorrang hat die Einhaltung des 
Zeitplans und die Funktionalität, da diese Aspekte stärker in die Bewertung des Projektes einflissen werden.


Weitere Bestimmungen zu Implementierungen:

Controller:
Sämtliche Controller erben vom abstrakten Controller.

Views:
Sämtliche Views erben von der abstrakten View-Klasse.

Allgemein:
Variabel-Namen und Kommentare in englischer Sprache.


Features:
Die Funktionalität richtet sich nach der Aufgabenstellung der ABB-TS
