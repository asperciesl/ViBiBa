<?php
$_GET['order_id'] = $_APP['vars'][1] ?? null;
$orders = $_SB->db_samples_order_fetch();
?>
    <div class="card mb-3">
        <div class="card-header">
            <?php echo ucwords($_SB->language_output('heading', "sample_order")); ?>
        </div>
        <div class="card-body">
            <p><?php echo($_SB->language_output('description', "sample_order")); ?></p>
            <hr/>
            <?php
            if (!empty($orders)) {
                ?>
                <div class="row">
                    <?php foreach ($orders as $order) {
                        ?>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    #<?php echo $order['order_id']; ?>
                                </div>
                                <div class="card-body">
                                    <?php echo htmlentities($order['order_description']); ?>
                                    <br/>
                                    <a class="card-link btn btn-primary btn-block"
                                       href="/app/sample/orders/<?php echo $order['order_id']; ?>/">
                                        <?php echo($_SB->language_output('show_order', "sample_order")); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
                <?php
            }else{
                echo($_SB->language_output('no_orders', "sample_order"));
            }
            ?>
        </div>
    </div>
<?php
if (!empty($_GET['order_id']) and !empty($orders[$_GET['order_id']])) {
    $order = $orders[$_GET['order_id']];
    $_SITE['sample_table']['order'] = 1;
    $_SITE['sample_table']['order_id'] = $_GET['order_id'];
    $_FOOTER[] = array('type' => 'preset', 'value' => 'sample_table');
    $_FOOTER[] = array('type' => 'preset', 'value' => 'button_bar');
    ?>
    <div class="card mb-3">
        <div class="card-header">
            #<?php echo $order['order_id']; ?>
        </div>
        <div class="card-body">
            <div id="button_bar_frame"></div>
            <div id="table_wrapper">
                <?php require_once(__DIR__ . "/../../template/sample_table.php"); ?>
            </div>
        </div>
    </div>
    <?php
}
?>