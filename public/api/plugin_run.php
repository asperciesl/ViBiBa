<?php
$source_id = $_GET['source_id'];
$source = $_SB->db_source_fetch_all($_GET['db_id'])['id'][$source_id];
if (!empty($source['plugin_name']) and $_SB->db_source_plugin_config($source['plugin_name']) !== false) {
    $plugin = $_SB->db_source_plugin_config($source['plugin_name']);
}
if(file_exists(__DIR__.'/../plugins/'.$source['plugin_name'].'/plugin.php')){
    require_once (__DIR__.'/../plugins/'.$source['plugin_name'].'/plugin.php');
}else{
    exit();
}

$plugin_class = new vibiba_plugin($_SB);
$response = $plugin_class->plugin_run($_GET['db_id'], $_GET['source_id'], $plugin);

if($response == true){
    ?>
    <div class="alert alert-success">
        <?= $_SB->language_output('plugin_success', "sources_upload") ?>
    </div>
    <?php
}else{
    ?>
    <div class="alert alert-danger">
        <?= $_SB->language_output('plugin_failure', "sources_upload") ?>
    </div>
    <?php
}
$response = '';