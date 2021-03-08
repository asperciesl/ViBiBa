<form method="post">
    <?php
    #pk: el.data("id")
    $fields = $_SB->db_fields_fetch();
    $fields_identifier = $fields['keys_single'];
    foreach ($fields_identifier as $field) {
        ?>
        <input type="hidden" name="<?php echo $field; ?>"
               value=<?php echo json_encode($_POST[$field]); ?>>
        <?php
        #echo ' data-' . $field['field_name_internal'] . ' = ' . json_encode($_POST[$field['field_name_internal']]);
    }
    $basket = $_SB->db_samples_basket_fetch_current();
    if (empty($basket[$_POST[$fields_identifier[0]]])) {
        $in_basket = false;
    } else {
        $in_basket = true;
    }
    if ($in_basket) {
        ?>
        <input type="hidden" name="action" value="basket_remove">
        <?php
    } else {
        ?>
        <input type="hidden" name="action" value="basket_add">
        <?php
    }
    ?>
    <input type="hidden" name="button_id" value="<?php echo $_POST['button_id'] ?>">
    <button type="submit" class="btn btn-primary basket_button" id="basket_button_<?php echo $_POST['button_id']; ?>">
        <?php
        if ($in_basket) {
            echo '[X]';
        } else {
            echo '[0]';
        }
        ?>
    </button>
</form>
<script>
    $("#basket_button_<?php echo $_POST['button_id']; ?>").click(function (event) {
        event.preventDefault();
        var request_method = $(this).closest('form').attr("method");
        var form_data = $(this).closest('form').serializeArray();
        form_data.push({name: this.name, value: this.value});
        $.ajax({
            url: '/api/button_basket/?<?php echo http_build_query($_GET); ?>',
            type: request_method,
            data: form_data
        }).done(function (response) { //
            $("#basket_button_wrapper_<?php echo $_POST['button_id'] ?>").html(response);
        });
    });
</script>