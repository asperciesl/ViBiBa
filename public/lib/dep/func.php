<?php


function preg_match_array($value, $patterns)
{
    foreach ($patterns as $pattern) {
        try {
            @preg_match($pattern, $value, $matches);
        } catch (Exception $e) {
        }
        if (!empty($matches)) {
            return $pattern;
        }
    }
    return false;
}

/****************************
 **** Display Functions *****
 ****************************/
/*
 *
 * $header['parents'] => $_SB->db_fields_fetch(true)['parents_ordered']
 * $header['parents'][X]['parent_id']
 * $header['parents'][X]['field_parent_name']
 * $header['hiearchy'] => $_SB->db_fields_fetch(true)['hierarchy']
 * $header['hiearchy'][parent_id]
 * $header['hiearchy_ordered'] => $_SB->db_fields_fetch(true)['hierarchy_ordered']
 *
*/
function display_table($table_name, $header, $offset = NULL, $heading_class = NULL)
{

    global $_SB;
    global $_SITE;

    if (empty($header['parents'])) {
        $header['hiearchy_ordered'] = array(0 => $header['hiearchy_ordered']);
    }

    if (empty($offset) and !empty($_SITE['sample_table']['offset'])) {
        $offset = $_SITE['sample_table']['offset'];
    }

    if (!is_numeric($offset) or $offset < 0 or empty($offset)) {
        $offset = 0;
    }

    if (empty($heading_class)) {
        if(!empty($_SB->config()['ui']['sample_table']['heading_class'])){
            $heading_class = $_SB->config()['ui']['sample_table']['heading_class'];
        }else{
            $heading_class = array();
        }
    }
    ?>
<table class="table table-bordered table-striped table-responsive" id="<?php echo $table_name; ?>>">
    <thead id="<?php echo $table_name; ?>_head">
    <?php if (!empty($header['parents'])) {
        ?>
        <tr>
            <?php
            $counter = 0;
            if ($offset > 0) {
                ?>
                <th colspan="<?php echo $offset; ?>"></th>
                <?
            }
            foreach ($header['parents'] as $parent) {
                $parent_id = $parent['field_parent_id'];
                $heading_class[$parent_id] = $heading_class[$counter];
                $counter++;
                if ($counter == count($heading_class)) {
                    $counter = 0;
                }
                ?>
                <th colspan="<?php echo count($header['hiearchy'][$parent_id]); ?>"
                    class="<?php echo $heading_class[$parent_id]; ?>">
                    <?php echo $parent['field_parent_name']; ?>
                </th>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    <tr>
        <?php
        if ($offset > 0) {
            ?>
            <th colspan="<?php echo $offset; ?>"></th>
            <?php
        }
        foreach ($header['hiearchy_ordered'] as $parent) {
            foreach ($parent as $field) {
                ?>
                <th data-toggle="tooltip" data-placement="top" title="<?php if (!empty($field["field_tooltip"])) {
                    echo $field['field_tooltip'];
                } ?>"
                    class="<?php if (!empty($heading_class[$field["field_parent_id"]])) {
                        echo $heading_class[$field["field_parent_id"]];
                    } ?>">
                    <?php echo $field['field_name']; ?>
                </th>
                <?php
            }
        }
        ?>
    </tr>
    </thead>
    <?php
}

/**
 * @var vibiba
 */
function display_alerts($_SB){
    if (!empty($_SB->alerts->fetch("error"))) {
        foreach ($_SB->alerts->fetch("error") as $error) {
            if (is_numeric($error)) {
                $error_heading = ucwords($_SB->language_output('error', "ui")) . ' ' . $_SB->language_output($error, "ui") . ' #' . $error;
                $error_body = ucwords($_SB->language_output($error, "error"));
            } elseif (is_numeric(explode('/', $error)[0])) {
                $error_id = explode('/', $error)[0];
                $error_heading = ucwords($_SB->language_output('error', "ui")) . ' ' . $_SB->language_output('error', "ui") . ' #' . $error;
                $error_body = $_SB->language_output($error_id, "error");
            } else {
                $error_heading = ucwords($_SB->language_output('error', "ui"));
                $error_body = $error;
            }
            ?>
    <div class="alert alert-danger" role="alert">
        <?php if (!empty($error_heading)) { ?>
            <h4 class="alert-heading"><?= $error_heading ?></h4>
        <?php }
        if (!empty($error_heading)) { ?>
            <p><?= $error_body ?></p>
        <?php } ?>
    </div>
    <?php
        }
    }
    if (!empty($_SB->alerts->fetch("success"))) {
    foreach ($_SB->alerts->fetch("success") as $success) {
    ?>
    <div class="alert alert-success" role="alert">
        <p><?= $_SB->language_output($success, "success") ?></p>
    </div><?php
    }
    }

}