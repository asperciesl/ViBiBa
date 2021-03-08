<?php
if (!empty($_GET['url'])) {
    unset($_GET['url']);
}
$display = array_keys($_SB->db_fields_parents_display_fetch());
if (!empty($_GET['reload_table'])) {
    $reload_table = true;
} else {
    $reload_table = false;
}
$_SITE['sample_table'] = $_GET;
$_GET['reload_table'] = 1;
?>
    <form method="post" id="button_bar" class="form-inline">
        <input type="hidden" name="action" value="fields_parents_display_toggle">
        <?php

        foreach ($_SB->db_fields_fetch(false)['parents_ordered'] as $order => $parent) {
            if ($order == 0) {
                continue;
            }
            $parent_id = $parent['field_parent_id'];
            ?>
            <input type="hidden" name="toggle_to_<?php echo $parent_id; ?>" value="<?php
            if (in_array($parent_id, $display)) {
                echo 0;
            } else {
                echo 1;
            } ?>">
            <button type="submit"
                    class="button_bar_buttons btn <?php
                    if (in_array($parent_id, $display)) {
                        echo 'btn-primary';
                    } else {
                        echo 'btn-secondary';
                    } ?> mb-2" name="field_parent_id"
                    value="<?php echo $parent_id; ?>">
                <?php echo $parent['field_parent_name_' . $_SB->lang()]; ?>
            </button>
            <?php
        } ?>
    </form>
<?php #require_once(__DIR__ . '/../template/footer_js.php');
?>
    <script>
        $(".button_bar_buttons").click(function (event) {
            event.preventDefault();
            var request_method = $(this).closest('form').attr("method");
            var form_data = $(this).closest('form').serializeArray();
            form_data.push({name: this.name, value: this.value});
            $.ajax({
                url: '/api/buttons_toggle/?<?php echo http_build_query($_GET); ?>',
                type: request_method,
                data: form_data
            }).done(function (response) { //
                $("#button_bar_frame").html(response);
                $("#table_wrapper").load("/api/sampletable_load/?<?php echo http_build_query($_GET); ?>", function () {
                });
            });
        });
        <?php
        if($reload_table){
        ?>
        clearTimeout(timeout_tabelle);
        var timeout_tabelle = setTimeout(function () {
            table.destroy(function () {

            });
            if (!$.fn.dataTable.isDataTable('#sample_table')) {
                <?php require_once(__DIR__ . '/../app/template/footer_presets/sample_table_core.php');?>
            }
        }, 1000);
        <?php
        }
        ?>
    </script>
<?php
$_SB = null;
?>