<?php
$_SITE['sample_table']['basket'] = 1;
$_SITE['sample_table']['offset'] = 1;
$_SITE['sample_table']['special_basket_checkbox'] = 1;
$_FOOTER[] = array('type' => 'preset', 'value' => 'sample_table');
$_FOOTER[] = array('type' => 'preset', 'value' => 'button_bar');
?>
<div class="card mb-3">
    <div class="card-header">
        <?= ucwords($_SB->language_output('heading', "sample_basket")) ?>
    </div>
    <div class="card-body">
        <p><?= ($_SB->language_output('description', "sample_basket")) ?></p>
        <a class="btn btn-primary" href="/api/sample_download/?basket=1"
           target="_blank"><?= ucwords($_SB->language_output('download_excel', "ui")) ?></a>
        <hr/>
        <div id="button_bar_frame"></div>
        <div id="table_wrapper">
            <?php require_once(__DIR__ . "/../../template/sample_table.php"); ?>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <?= ucwords($_SB->language_output('heading_form', "sample_basket")) ?>
    </div>
    <div class="card-body">
        <p><?= $_SB->language_output('description_form', "sample_basket") ?></p>
        <form method="post">
            <input type="hidden" name="action" value="basket_place_order">
            <label for="order_description"><?= ucwords($_SB->language_output('order_description', "sample_basket")) ?></label>
            <textarea id="order_description" name="order_description" class="form-control"></textarea>
            <br/>
            <label for="order_priority">
                <?= ucwords($_SB->language_output('order_priority', "sample_basket")) ?>
            </label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="order_priority" id="order_priority_0" value="0"
                       checked>
                <label class="form-check-label" for="order_priority_0">
                    <?= ucwords($_SB->language_output('order_priority_0', "sample_basket")) ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="order_priority" id="order_priority_1" value="1">
                <label class="form-check-label" for="order_priority_1">
                    <?= ucwords($_SB->language_output('order_priority_1', "sample_basket")) ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="order_priority" id="order_priority_2" value="2">
                <label class="form-check-label" for="order_priority_2">
                    <?= ucwords($_SB->language_output('order_priority_2', "sample_basket")) ?>
                </label>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">
                <?= ucwords($_SB->language_output('submit', "ui")) ?>
            </button>
        </form>
    </div>
</div>