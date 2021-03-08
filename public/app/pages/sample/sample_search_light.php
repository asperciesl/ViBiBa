<?php
$_SITE['sample_table'] = array('field_name_internal' => $_APP['vars'][1] ?? null, 'value' =>$_APP['vars'][2] ?? null);
$_SITE['sample_table']['offset'] = 1;
$_SITE['sample_table']['special_basket_checkbox'] = 1;
if (empty($_APP['vars']['detail'])) {
    $_SITE['sample_table']['search_light'] = 1;
} else {
    $_SITE['sample_table']['detail'] = 1;
}

$_FOOTER[] = array('type' => 'preset', 'value' => 'sample_table');
$_FOOTER[] = array('type' => 'preset', 'value' => 'button_bar');
?>
<div class="card mb-3">
    <div class="card-header">
        <?php echo ucwords($_SB->language_output('heading', "sample_detail")); ?>
    </div>
    <div class="card-body">
        <p><?php echo($_SB->language_output('description', "sample_detail")); ?></p>
        <a class="btn btn-primary" href="/app/sample/overview/download"
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