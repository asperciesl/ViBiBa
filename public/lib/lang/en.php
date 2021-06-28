<?php

/****************************
 ************ UI ************
 ****************************/

$_LANG['ui']['footer'] = "Virtual BioBanking (ViBiBa) is an Open-Source platform for easy management of decentralised sample storage and processing as part of modern liquid biopsy multicenter trial groups. <br/>For citation information and further reference please visit our <a href='https://github.com/asperciesl/vibiba/'>GitHub</a> repository.";
$_LANG['ui']['username'] = 'username';
$_LANG['ui']['password'] = 'password';
$_LANG['ui']['login'] = 'login';
$_LANG['ui']['logout'] = 'logout';
$_LANG['ui']['logout_message'] = 'Do you really want to be logged out?';
$_LANG['ui']['cancel'] = 'cancel';
$_LANG['ui']['database'] = 'database';
$_LANG['ui']['database_select'] = 'select database';
$_LANG['ui']['lang_select'] = 'select language';
$_LANG['ui']['languages'] = 'languages';
$_LANG['ui']['error'] = 'error';
$_LANG['ui']['ou'] = 'labs';
$_LANG['ui']['sample_overview'] = 'overview';
$_LANG['ui']['sample_search'] = 'search';
$_LANG['ui']['sample_summary'] = 'summary';
$_LANG['ui']['sample_basket'] = 'basket';
$_LANG['ui']['sample_orders'] = 'orders';
$_LANG['ui']['sources_overview'] = 'sources';
$_LANG['ui']['contact'] = 'contact';
$_LANG['ui']['download'] = 'download';
$_LANG['ui']['download_excel'] = 'download excel file';
$_LANG['ui']['delimiter'] = 'delimiter';
$_LANG['ui']['enclosure'] = 'enclosure';
$_LANG['ui']['escape'] = 'escape';
$_LANG['ui']['skip_lines'] = 'skip X lines (e.g. 2 means that the first two lines will be skipped and the column titles will be found in line 3)';
$_LANG['ui']['submit'] = 'submit';
$_LANG['ui']['accept'] = 'accept';
$_LANG['ui']['deny'] = 'deny';
$_LANG['ui']['overwrite'] = 'overwrite';
$_LANG['ui']['add'] = 'add';
$_LANG['ui']['format'] = 'format';
$_LANG['ui']['format_date_string'] = 'DD.MM.YYYY';
$_LANG['ui']['no'] = 'no';
$_LANG['ui']['yes'] = 'yes';
$_LANG['ui']['operator'] = 'operator';
$_LANG['ui']['input'] = 'input';
$_LANG['ui']['table_select'] = 'Select a table';
$_LANG['ui']['description'] = 'description';
$_LANG['ui']['continuous_read'] = 'Read all worksheets as one (merge)';
$_LANG['ui']['missing_config'] = 'Configuration or Data Missing';
$_LANG['ui']['licenses'] = 'licenses';
$_LANG['ui']['experimental'] = 'experimental';

/********************************************
 ************ UI/Sample_table ************
 ********************************************/
$_LANG['sample_table']['parameter_language'] = '';
/*$_LANG['sample_table']['parameter_language'] = '
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
}';*/

/********************************************
 ************ UI/Sample_overview ************
 ********************************************/

$_LANG['sample_overview']['heading'] = 'sample overview';
$_LANG['sample_overview']['description'] = '';

/********************************************
 ************ UI/Sample_detail ************
 ********************************************/

$_LANG['sample_detail']['heading'] = 'sample detail';
$_LANG['sample_detail']['description'] = '';

/********************************************
 ************ UI/sample_search ************
 ********************************************/

$_LANG['sample_search']['heading_results'] = 'sample search results';
$_LANG['sample_search']['heading_search_form'] = 'sample search';
$_LANG['sample_search']['description_results'] = '';
$_LANG['sample_search']['description_search_form'] = '';

/********************************************
 ************ UI/Sample_summary ************
 ********************************************/

$_LANG['sample_summary']['heading'] = 'sample summary';
$_LANG['sample_summary']['description'] = '';

/********************************************
 ************ UI/Sample_Basket **************
 ********************************************/

$_LANG['sample_basket']['heading'] = 'sample basket';
$_LANG['sample_basket']['description'] = '';

$_LANG['sample_basket']['heading_form'] = 'sample basket';
$_LANG['sample_basket']['description_form'] = '';

$_LANG['sample_basket']['order_description'] = 'order description';
$_LANG['sample_basket']['order_priority'] = 'order priority';
$_LANG['sample_basket']['order_priority_0'] = 'Low';
$_LANG['sample_basket']['order_priority_1'] = 'Medium';
$_LANG['sample_basket']['order_priority_2'] = 'High';

/********************************************
 ************ UI/Sample_order ***************
 ********************************************/

$_LANG['sample_order']['heading'] = 'orders';
$_LANG['sample_order']['description'] = '';
$_LANG['sample_order']['show_order'] = 'show order';
$_LANG['sample_order']['no_orders'] = 'There are currently no orders.';

/********************************************
 ************ UI/Sources_Overview ************
 ********************************************/

$_LANG['sources_overview']['my_sources_heading'] = 'sources of my organizational unit (ou)';
$_LANG['sources_overview']['my_sources_description'] = 'Please find below a list of sources that your OU can manage. If you want to add a source please contact the Samplebank administrators.';

$_LANG['sources_overview']['all_sources_heading'] = 'all sources (read view only)';
$_LANG['sources_overview']['all_sources_description'] = 'Please find below a list of all sources that are part of the database. If you want to add a source please contact the Samplebank administrators.';

/********************************************
 ************ UI/sources_upload ************
 ********************************************/

$_LANG['sources_upload']['heading'] = 'source upload';
$_LANG['sources_upload']['description'] = '';
$_LANG['sources_upload']['continue'] = 'Continue (this will overwrite all previous data from that source!)';
$_LANG['sources_upload']['success'] = 'The Dataset has been imported successfully!';
$_LANG['sources_upload']['failure'] = 'The Dataset Import has failed!';
$_LANG['sources_upload']['cancel'] = 'The Dataset Import has been canceled!';
$_LANG['sources_upload']['description_plugin'] = 'The Source consists of {upload_count} table(s). Please read the information below, to make sure your first line contains only valid column titles (without the quotation marks or whitespaces).';
$_LANG['sources_upload']['table_name_display'] = 'table display name';
$_LANG['sources_upload']['table_name_internal'] = 'table internal name';
$_LANG['sources_upload']['allowed_columns'] = 'allowed columns';
$_LANG['sources_upload']['table_preview_description'] = 'Preview of the uploaded data, only the first 20 entries are shown.';
$_LANG['sources_upload']['disabled'] = 'The administrator has disabled the manual upload of data for this source. This may be to allow for automatic data import, which bypasses the upload form.';
$_LANG['sources_upload']['plugin_processing'] = 'The plugin is processing the uploaded data. Please wait...';
$_LANG['sources_upload']['cache_processing'] = 'The database is caching the new data. Please wait...';
$_LANG['sources_upload']['plugin_success'] = 'The plugin successfully processed the uploaded data!';
$_LANG['sources_upload']['plugin_failure'] = 'The plugin failed while processing the uploaded data! Please retry or contact an administrator.';


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