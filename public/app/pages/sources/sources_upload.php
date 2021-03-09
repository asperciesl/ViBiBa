<?php
$source_id = $_APP['vars'][1] ?? null;
$source = $_SB->db_source_fetch_available()['id'][$source_id];
if (!empty($_SB->cache->fetch('db_source_upload')) and $_SB->cache->fetch('db_source_upload')['source_id'] != $source['source_id']) {
    $_SB->cache->clear('db_source_upload');
}
if (!empty($_POST['action']) and $_POST['action'] == 'source_upload_decision') {
    if ($_POST['decision'] == 'accept') {
        if (!empty($_RETURN['source_upload_decision']) and $_RETURN['source_upload_decision']) {
            $_FOOTER[] = array('type' => 'preset', 'value' => 'callback', 'args' => array('id' => 'plugin_call', 'url' => $_SB->config()['url'] . 'api/plugin/?db_id=' . $_SB->db_current()['db_id'] . '&source_id=' . $source['source_id']));
        }
    }
}
?>
<div class="card mb-3">
    <div class="card-header">
        <?= ucwords($_SB->language_output('heading', "sources_upload")) ?>
        | #<?= $source['source_id'] ?> <?= $source['source_name_' . $_SB->lang()] ?>
    </div>
    <div class="card-body">
        <p><?= $_SB->language_output('description', "sources_upload") ?></p>
        <hr/>
        <?php
        if (!empty($_POST['action']) and $_POST['action'] == 'source_upload_decision') {
            if ($_POST['decision'] == 'accept') {
                if (!empty($_RETURN['source_upload_decision']) and $_RETURN['source_upload_decision']) { ?>
                    <div class="alert alert-success">
                        <?= $_SB->language_output('success', "sources_upload") ?>
                    </div>
                    <div id="plugin_call">
                        <div class="alert alert-warning">
                            <div class="spinner-grow" role="status">
                                <span class="sr-only"> Loading...</span>
                            </div>
                            <?= $_SB->language_output('plugin_processing', "sources_upload") ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger">
                        <?= $_SB->language_output('failure', "sources_upload") ?>
                    </div>
                    <?php
                }
            } elseif ($_POST['decision'] == 'cancel') {
                ?>
                <div class="alert alert-primary">
                    <?= $_SB->language_output('cancel', "sources_upload") ?>
                </div>
                <?php
            }
        } elseif (!empty($_SB->cache->fetch('db_source_upload'))) {
            require_once(__DIR__ . '/elements/upload_preview.php');
        } else {
            require_once(__DIR__ . '/elements/upload_wrapper.php');
        }
        ?>
    </div>
</div>