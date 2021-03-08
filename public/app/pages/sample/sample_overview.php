<?php
$_SITE['sample_table']['offset'] = 1;
$_SITE['sample_table']['special_basket_checkbox'] = 1;
$_FOOTER[] = array('type' => 'preset', 'value' => 'sample_table');
$_FOOTER[] = array('type' => 'preset', 'value' => 'button_bar');
?>
    <div class="card mb-3">
        <div class="card-header">
            <?= ucwords($_SB->language_output('heading', "sample_overview")) ?>
        </div>
        <div class="card-body">
            <p><?= ($_SB->language_output('description', "sample_overview")) ?></p>
            <a class="btn btn-primary" href="/app/sample/overview/download"
               target="_blank"><?= ucwords($_SB->language_output('download_excel', "ui")) ?></a>
            <a class="btn btn-primary"
               href="/app/sample/basket"><?= ucwords($_SB->language_output('sample_basket', "ui")) ?></a>
            <hr/>
            <div id="button_bar_frame"></div>
            <div id="table_wrapper">
                <?php require_once(__DIR__ . "/../../template/sample_table.php"); ?>
            </div>
        </div>
    </div>