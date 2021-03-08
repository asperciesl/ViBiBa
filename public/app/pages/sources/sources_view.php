<?php
$_GET['source_id'] = $_APP['vars'][1] ?? null;
$source = $_SB->db_source_fetch_available()['id'][$_GET['source_id']];
?>
<div class="card mb-3">
    <div class="card-header">
        <?php echo ucwords($_SB->language_output('heading', "sources_view")); ?>
        | <?php echo '#' . $source['source_id'] . ' ' . $source['source_name_' . $_SB->lang()]; ?>
    </div>
    <div class="card-body">
        <?php
        $table['data'] = $_SB->db_source_fetch_interface(NULL, $_GET['source_id']);
        $table['header'] = $_SB->db_source_fetch_fields(NULL, $_GET['source_id']);
        $table_name = 'db_source_table_' . $_GET['source_id'];
        $header['hiearchy_ordered'] = array();
        if (empty($table['header']) or empty($table['data'])) {
            ?>
            <p><?= $_SB->language_output('missing_config', 'ui') ?></p>
            <?php
        } else {
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
                    <?php
                    foreach ($table['header'] as $field_id => $field) {
                        ?>
                        <td>
                            <?php echo $row[$field]; ?>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
            </table> <?php
        }

        ?>
    </div>
</div>