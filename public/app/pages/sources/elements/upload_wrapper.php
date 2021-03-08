<?php if (!empty($source)) {
    if (!empty($source['plugin_name']) and $_SB->db_source_plugin_config($source['plugin_name']) !== false) {
        $is_plugin = true;
        $upload_config = $_SB->db_source_plugin_config($source['plugin_name']);
        $upload_config['upload_count'] = count($upload_config['upload']);
    } else {
        $is_plugin = false;
        $upload_config['upload_count'] = 1;
        $upload_config['upload'] = array(array('name' => 'default', 'name_internal' => 'default', 'description' => '', 'fields' => $_SB->db_source_fetch_fields(null, $source['source_id'])));
    }

    ?>
    <p>
        <?= $_SB->language_output('description_plugin', "sources_upload", $upload_config) ?>
    </p>
    <?php
    if ($is_plugin and !empty($upload_config['disable_upload']) and $upload_config['disable_upload'] == true) {
        ?>
        <div class="alert alert-warning">
            <?= $_SB->language_output('disabled', "sources_upload") ?>
        </div>
        <?php
    } else {
        if ($is_plugin or true) { ?>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th><?= ucwords($_SB->language_output('table_name_display', "sources_upload")) ?></th>
                    <th><?= ucwords($_SB->language_output('table_name_internal', "sources_upload")) ?></th>
                    <th><?= ucwords($_SB->language_output('description', "ui")) ?></th>
                    <th><?= ucwords($_SB->language_output('allowed_columns', "sources_upload")) ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($upload_config['upload'] as $key => $value) {
                    ?>
                    <tr>
                        <td><?= $value["name"] ?? null ?></td>
                        <td><?= $value["name_internal"] ?? null ?></td>
                        <td><?= $value["description"] ?? null ?></td>
                        <td>'<?= implode("', '", $value["fields"] ?? array()) ?? null ?>'</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#xlsx" role="tab" aria-controls="home"
                   aria-selected="true">XLSX (Excel)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#csv" role="tab" aria-controls="profile"
                   aria-selected="false">CSV</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="xlsx" role="tabpanel" aria-labelledby="Excel Upload"><br/>
                <?php require_once(__DIR__ . '/upload_xlsx.php'); ?>
            </div>
            <div class="tab-pane fade" id="csv" role="tabpanel" aria-labelledby="CSV Upload"><br/>
                <?php require_once(__DIR__ . '/upload_csv.php'); ?>
            </div>
        </div>
    <?php }
}
?>