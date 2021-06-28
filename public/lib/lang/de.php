<?php

/****************************
 ************ UI ************
 ****************************/

$_LANG['ui']['footer'] = "Virtual BioBanking (ViBiBa) is an Open Source platform for intelligent distributed sample management. To find out more and for citation reference please visit ...";
$_LANG['ui']['username'] = 'Benutzername';
$_LANG['ui']['password'] = 'Passwort';
$_LANG['ui']['login'] = 'login';
$_LANG['ui']['logout'] = 'logout';
$_LANG['ui']['logout_message'] = 'Möchten Sie sich wirklich abmelden?';
$_LANG['ui']['cancel'] = 'abbrechen';
$_LANG['ui']['database'] = 'Datenbank';
$_LANG['ui']['database_select'] = 'Datenbank auswählen';
$_LANG['ui']['lang_select'] = 'Sprache auswählen';
$_LANG['ui']['languages'] = 'Sprache';
$_LANG['ui']['error'] = 'Fehler';
$_LANG['ui']['ou'] = 'Labore';
$_LANG['ui']['sample_overview'] = 'Übersicht';
$_LANG['ui']['sample_search'] = 'Suche';
$_LANG['ui']['sample_summary'] = 'Zusammenfassung';
$_LANG['ui']['sample_basket'] = 'Merkliste';
$_LANG['ui']['sample_orders'] = 'Bestellungen';
$_LANG['ui']['sources_overview'] = 'Quellen';
$_LANG['ui']['contact'] = 'Kontakt';
$_LANG['ui']['download'] = 'download';
$_LANG['ui']['download_excel'] = 'download excel file';
$_LANG['ui']['delimiter'] = 'Trennzeichen';
$_LANG['ui']['enclosure'] = 'enclosure';
$_LANG['ui']['escape'] = 'escape';
$_LANG['ui']['skip_lines'] = 'X Zeilen überspringen (z.B. bedeutet "2", dass die ersten zwei Zeilen übersprungen werden und die Spaltennamen in Zeile 3 gesucht wernde)';
$_LANG['ui']['submit'] = 'Absenden';
$_LANG['ui']['accept'] = 'Akzeptieren';
$_LANG['ui']['deny'] = 'Ablehnen';
$_LANG['ui']['overwrite'] = 'Überschreiben';
$_LANG['ui']['add'] = 'Hinzufügen';
$_LANG['ui']['format'] = 'format';
$_LANG['ui']['format_date_string'] = 'DD.MM.YYYY';
$_LANG['ui']['no'] = 'Nein';
$_LANG['ui']['yes'] = 'Ja';
$_LANG['ui']['operator'] = 'operator';
$_LANG['ui']['input'] = 'Eingabe';
$_LANG['ui']['table_select'] = 'Tabelle auswählen';
$_LANG['ui']['description'] = '';
$_LANG['ui']['continuous_read'] = 'Alle Arbeitsblätter als eins zusammenfügen (merge)';
$_LANG['ui']['missing_config'] = 'Konfiguration oder Daten fehlen';
$_LANG['ui']['licenses'] = 'Lizenzen';
$_LANG['ui']['experimental'] = 'Experimentell';

/********************************************
 ************ UI/Sample_table ************
 ********************************************/
$_LANG['sample_table']['parameter_language'] = '';
$_LANG['sample_table']['parameter_language'] = '
"language": {
    "decimal": ",",
    "emptyTable": "Keine Daten verfügbar",
    "info": "Zeige _START_ bis _END_ von _TOTAL_ Einträgen",
    "infoEmpty": "Zeige 0 bis 0 von 0 Einträgen",
    "infoFiltered": "(gefiltert von _MAX_ verfügbaren Einträgen)",
    "infoPostFix": "",
    "thousands": ".",
    "lengthMenu": " _MENU_ Einträge anzeigen",
    "loadingRecords": "Läd...",
    "processing": "Verarbeite...",
    "search": "Suchen:",
    "zeroRecords": "Keine passenden Einträge gefunden",
    "paginate": {
        "first": "Erste",
        "last": "Letzte",
        "next": "Nächste",
        "previous": "Zurück"
    },
    "aria": {
        "sortAscending": ": Aufsteigend sortieren",
        "sortDescending": ": Absteigend sortieren"
    }
}';

/********************************************
 ************ UI/Sample_overview ************
 ********************************************/

$_LANG['sample_overview']['heading'] = 'Proben Übersicht';
$_LANG['sample_overview']['description'] = '';

/********************************************
 ************ UI/Sample_detail ************
 ********************************************/

$_LANG['sample_detail']['heading'] = 'Proben Detail';
$_LANG['sample_detail']['description'] = '';

/********************************************
 ************ UI/sample_search ************
 ********************************************/

$_LANG['sample_search']['heading_results'] = 'Suchergebnis';
$_LANG['sample_search']['heading_search_form'] = 'Proben Suche';
$_LANG['sample_search']['description_results'] = '';
$_LANG['sample_search']['description_search_form'] = '';

/********************************************
 ************ UI/Sample_summary ************
 ********************************************/

$_LANG['sample_summary']['heading'] = 'Proben Zusammenfassung';
$_LANG['sample_summary']['description'] = '';

/********************************************
 ************ UI/Sample_Basket **************
 ********************************************/

$_LANG['sample_basket']['heading'] = 'Merkliste';
$_LANG['sample_basket']['description'] = '';

$_LANG['sample_basket']['heading_form'] = 'Bestellung aufgeben';
$_LANG['sample_basket']['description_form'] = '';

$_LANG['sample_basket']['order_description'] = 'Beschreibung';
$_LANG['sample_basket']['order_priority'] = 'Priorität';
$_LANG['sample_basket']['order_priority_0'] = 'Low';
$_LANG['sample_basket']['order_priority_1'] = 'Medium';
$_LANG['sample_basket']['order_priority_2'] = 'High';

/********************************************
 ************ UI/Sample_order ***************
 ********************************************/

$_LANG['sample_order']['heading'] = 'Bestellungen';
$_LANG['sample_order']['description'] = '';
$_LANG['sample_order']['show_order'] = 'Bestellung anzeigen';
$_LANG['sample_order']['no_orders'] = 'Es liegen keine Bestellungen vor.';

/********************************************
 ************ UI/Sources_Overview ************
 ********************************************/

$_LANG['sources_overview']['my_sources_heading'] = 'Quellen meiner Organisationseinheit (ou)';
$_LANG['sources_overview']['my_sources_description'] = 'Untenstehend finden Sie alle Quellen, welche Sie Ihre OU verwaltet. Falls Sie eine Quelle hinzufügen möchten kontaktieren Sie bitte die Datenbank Administratoren.';

$_LANG['sources_overview']['all_sources_heading'] = 'Alle Quellen (Leseansicht)';
$_LANG['sources_overview']['all_sources_description'] = 'Untenstehend finden Sie alle Quellen, welche Teil der Datenbank sind.';

/********************************************
 ************ UI/sources_upload ************
 ********************************************/

$_LANG['sources_upload']['heading'] = 'Datensatz Hochladen';
$_LANG['sources_upload']['description'] = '';
$_LANG['sources_upload']['continue'] = 'Fortfahren (Alle bisherigen Daten werden überschrieben!)';
$_LANG['sources_upload']['success'] = 'Der Datensatz wurde erfolgreich importiert.';
$_LANG['sources_upload']['failure'] = 'Der Datensatz konnte nicht erfolgreich importiert werden!';
$_LANG['sources_upload']['cancel'] = 'Der Import wurde abgebrochen.';
$_LANG['sources_upload']['description_plugin'] = 'Die Quelle besteht aus {upload_count} Tabellen. Bitte lesen Sie die untenstehenden Informationen und stellen Sie sicher, dass die erste Zeile nur gültige Spaltennamen enthält (ohne Anführungszeichen und Leerzeichen)';
$_LANG['sources_upload']['table_name_display'] = 'Anzeige Name';
$_LANG['sources_upload']['table_name_internal'] = 'Interner Name';
$_LANG['sources_upload']['allowed_columns'] = 'Erlaubte Spaltennamen';
$_LANG['sources_upload']['table_preview_description'] = 'Vorschau des hochgeladenen Datensatzes. Es werden nur die ersten 20 Zeilen angezeigt.';
$_LANG['sources_upload']['disabled'] = 'Der Administrator hat das manuelle Hochladen für diese Datenquelle deaktiviert.';


/********************************************
 ************ UI/sources_view ***************
 ********************************************/

$_LANG['sources_view']['heading'] = 'source view';
$_LANG['sources_view']['description'] = '';

/*****************************************
 ************ Errors *********************
 *****************************************
 ************ General (1-99) *************
 *****************************************/
$_LANG['error']['001'] = 'No default language set!';
$_LANG['error']['002'] = 'Default language is invalid!';
$_LANG['error']['003'] = 'You are not logged in!';
$_LANG['error']['004'] = 'Please fill out all required fields!';
$_LANG['error']['005'] = 'Selected language is invalid!';

/********************************************
 ************ Generate (101-199) ************
 ********************************************/
$_LANG['error']['100'] = "Task failed";

/*****************************************
 ************ MySQL (201-299) ************
 *****************************************/

$_LANG['error']['201'] = 'Database error. Entry could not be inserted!';
$_LANG['error']['202'] = 'Database error. Table could not be created';

/*****************************************
 ************ OU (301-399) ************
 *****************************************/

$_LANG['error']['301'] = 'Organizational Unit (OU) could not be found!';

/*********************************************
 ************ DB+Source (401-499) ************
 *********************************************/

$_LANG['error']['401'] = 'Database (DB) could not be found!';
$_LANG['error']['402'] = 'Insufficient rights to open this database!';
$_LANG['error']['403'] = 'You have not selected any database!';
$_LANG['error']['404'] = 'You have not selected any source!';
$_LANG['error']['405'] = 'The selected source is invalid!';
$_LANG['error']['406'] = 'Your Organizational Unit (OU) has no access rights for any database!';
$_LANG['error']['407'] = 'Invalid headings!';
$_LANG['error']['408'] = 'one or multiple worksheets do not have a matching title';
$_LANG['error']['409'] = 'no valid worksheets provided. upload aborted';


/*****************************************
 ************ User (501-599) ************
 *****************************************/

$_LANG['error']['501'] = 'User could not be found!';
$_LANG['error']['502'] = 'The given credentials are invalid!';

/*****************************************
 ************ Internal (999) ************
 *****************************************/

$_LANG['error']['999'] = 'Internal server error!';