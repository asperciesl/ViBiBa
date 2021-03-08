<?php
$_SITE['sample_table']['offset'] = 1;
$_SITE['sample_table']['special_basket_checkbox'] = 1;
$_SITE['sample_table']['search'] = 1;
$_FOOTER[] = array('type' => 'preset', 'value' => 'sample_table');
?>

<div class="card mb-3">
    <div class="card-header">
        <?php echo ucwords($_SB->language_output('heading_results', "sample_search")); ?>
    </div>
    <div class="card-body">
        <p><?php echo($_SB->language_output('description_results', "sample_search")); ?></p>
        <a class="btn btn-primary" href="/app/sample/search/download"
           target="_blank"><?php echo ucwords($_SB->language_output('download_excel', "ui")); ?></a>
        <a class="btn btn-primary"
           href="/app/sample/basket"><?php echo ucwords($_SB->language_output('sample_basket', "ui")); ?></a>
        <hr/>
        <div id="button_bar_frame"></div>
        <div id="table_wrapper">
            <?php require_once(__DIR__ . "/../../template/sample_table.php"); ?>
        </div>
    </div>
</div>