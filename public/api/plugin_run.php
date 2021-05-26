<?php
$source_id = $_GET['source_id'];
$source = $_SB->db_source_fetch_all($_GET['db_id'])['id'][$source_id];
if (!empty($source['plugin_name']) and $_SB->db_source_plugin_config($source['plugin_name']) !== false) {
    $plugin = $_SB->db_source_plugin_config($source['plugin_name']);
}
if (file_exists(__DIR__ . '/../plugins/' . $source['plugin_name'] . '/plugin.php')) {
    require_once(__DIR__ . '/../plugins/' . $source['plugin_name'] . '/plugin.php');
} else {
    ?>
    <div class="alert alert-warning">
        <div class="spinner-grow" role="status">
            <span class="sr-only"> Loading...</span>
        </div>
        <?= $_SB->language_output('cache_processing', "sources_upload") ?>
    </div>
    <script>
        $(document).ready(function () {
            $("#plugin_call").load("<?= $_SB->config()['url'] . 'api/db_cache/?db_id=' . $_SB->db_current()['db_id'] ?>");
        });
    </script>
    <?php
    exit();
}

$plugin_class = new vibiba_plugin($_SB);
$response = $plugin_class->plugin_run($_GET['db_id'], $_GET['source_id'], $plugin);

if ($response == true) {
    ?>
    <div class="alert alert-success">
        <?= $_SB->language_output('plugin_success', "sources_upload") ?>
    </div>
    <div class="alert alert-warning">
        <div class="spinner-grow" role="status">
            <span class="sr-only"> Loading...</span>
        </div>
        <?= $_SB->language_output('cache_processing', "sources_upload") ?>
    </div>
    <script>
        $(document).ready(function () {
            $("#plugin_call").load("<?= $_SB->config()['url'] . 'api/plugin/?db_cache=' . $_SB->db_current()['db_id'] ?>");
        });
    </script>
    <?php
} else {
    ?>
    <div class="alert alert-danger">
        <?= $_SB->language_output('plugin_failure', "sources_upload") ?>
    </div>
    <?php
}
$response = '';