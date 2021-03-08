table = sample_table_init(table, "/api/sampletable/?<?php
if (!empty($_SITE['sample_table'])) {
    echo http_build_query($_SITE['sample_table']);
}
    ?>");
table.on("draw", function () {
<?php
    if(!empty($_SITE['sample_table']['special_basket_checkbox'])){
            ?>
        setTimeout(function () {
            $(".basket_button_wrapper").each(function () {
                var el = $(this);
                el.load("/api/button_basket/", {
                <?php
                    #pk: el.data("id")
                $fields = $_SB->db_fields_fetch();
                $fields_identifier = array_merge($fields['field_type'][6], $fields['field_type'][7]);
                $a = 0;
                $fields_identifier[] = array('field_name_internal' => 'button_id');
                foreach ($fields_identifier as $field) {
                    if ($a != 0) {
                        echo ",";
                    }
                    echo $field['field_name_internal'] . ':  el.data("' . $field['field_name_internal'] . '")';
                    $a++;
                }
                    ?>
            });
            });
        }, 1000);
    <?php
    }
        ?>
});