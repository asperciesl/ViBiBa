<?php
if (!empty($_SB->cache->fetch('db_source_upload'))) {
    ?>
    <form method="post">
        <input type="hidden" name="action" value="source_upload_decision">
        <button class="btn btn-block btn-success" type="submit" name="decision" value="accept">
            <?= $_SB->language_output('continue', "sources_upload") ?>
        </button>
        <button class="btn btn-block btn-danger" type="submit" name="decision" value="cancel">
            <?= ucwords($_SB->language_output('cancel', "ui")) ?>
        </button>
    </form><br/><br/>
    <?php
    foreach ($_SB->cache->fetch('db_source_upload')['data'] as $table) {
        ?>
        <div class="card mb-3">
            <div class="card-header">
                Preview #<?= $table['table_id'] ?> <?= $table['table_name'] ?>
            </div>
            <div class="card-body">
                <p>
                    <?= $_SB->language_output('table_preview_description', "sources_upload") ?>
                </p>
                <?php
                $data = array();
                $table_name = 'db_source_upload_table_' . $table['table_id'];
                $header['hiearchy_ordered'] = array();
                foreach ($table['header'] as $header_raw) {
                    $header['hiearchy_ordered'][] = array('field_name' => $header_raw, 'field_parent_id' => 0);
                }
                display_table($table_name, $header);
                ?>
                <tbody>
                <?php
                $table['data'] = array_slice($table['data'], 0, 20);
                foreach ($table['data'] as $row) {
                    ?>
                    <tr>
                        <?php foreach ($table['header'] as $field_id => $field) { ?>
                            <td>
                                <?php echo $row[$field]; ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
        <br/><br/>
        <?php
    }
}