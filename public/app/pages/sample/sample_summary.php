<?php
$summary = $_SB->db_samples_summary();
$fields = $_SB->db_fields_fetch();
$ous = $_SB->user->ou_fetch();
?>
<div class="card mb-3">
    <div class="card-header">
        <?= ucwords($_SB->language_output('heading', "sample_summary")) ?>
    </div>
    <div class="card-body">

        <p><?= ($_SB->language_output('description', "sample_summary")) ?></p>

        <table class="table table-responsive table-bordered table-striped">
            <thead>
            <tr>
                <th>Category</th>
                <th>Type</th>
                <th>Sample Count</th>
                <?php
                $first_line = $summary[array_key_first($summary)];
                $first_line = $first_line[array_key_first($first_line)];
                foreach ($first_line as $key => $value) {
                    if($key == 'count'){
                        continue;
                    }
                    echo '<th>' . $fields['flat_by_name'][$key]['field_name_' . $_SB->lang()] . '</th>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($summary as $category => $types) {
                if($category == 'ou_id'){
                    #$type = $ous[$type]['ou_short'];
                    continue;
                }
                foreach ($types as $type => $values) {

                    if ($category == 'all'){
                        $category_name = 'all';
                    }else{
                        $category_name = $fields['flat_by_name'][$category]['field_name_' . $_SB->lang()];
                    }

                    ?>
                    <tr>
                        <th><?= $category_name; ?></th>
                        <th><?= $type ?></th>
                        <td><?= implode('</td><td>', $values) ?></>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="<?= 2+count($values) ?>"></td>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>
    </div>
</div>