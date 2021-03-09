<?php
require_once(__DIR__ . '/../../lib/autoload.php');
?>
<table class="table table-bordered table-striped" id="sample_table">
    <thead id="sample_table_head">
    <tr>
        <?php
        $counter = 0;
        if (!empty($_SITE['sample_table']['offset'])) {
            ?>
        <th colspan="<?= $_SITE['sample_table']['offset'] ?>"></th><?php
        }
        foreach ($_SB->db_fields_fetch(true)['parents_ordered'] as $parent) {
            $parent_id = $parent['field_parent_id'];
            $heading_class[$parent_id] = $_SB->config()['ui']['sample_table']['heading_class'][$counter];
            $counter++;
            if ($counter == count($_SB->config()['ui']['sample_table']['heading_class'])) {
                $counter = 0;
            }
            $x = $_SB->db_fields_fetch(true)['hierarchy'][$parent_id];
            ?>
        <th colspan="<?= count($_SB->db_fields_fetch(true)['hierarchy'][$parent_id]) ?>"
            class="<?= $heading_class[$parent_id] ?>">
            <?= $parent['field_parent_name_' . $_SB->lang()] ?>
            </th><?php
        }
        ?>
    </tr>
    <tr>
        <?php
        if (!empty($_SITE['sample_table']['offset'])) {
            ?><th colspan="' . $_SITE['sample_table']['offset'] . '"></th><?php
        }
        foreach ($_SB->db_fields_fetch(true)['hierarchy_ordered'] as $parent) {
            foreach ($parent as $field) {
                ?>
                <th data-toggle="tooltip" data-placement="top" title="<?= $field["field_tooltip"] ?>"
                    class="<?= $heading_class[$field["field_parent_id"]] ?>"><?= $field['field_name_' . $_SB->lang()] ?></th><?php
            }
        }
        ?>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>