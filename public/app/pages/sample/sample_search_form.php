<div class="card mb-3">
    <div class="card-header">
        <?php echo ucwords($_SB->language_output('heading_search_form', "sample_search")); ?>
    </div>
    <div class="card-body">
        <p><?php echo ucwords($_SB->language_output('description_search_form', "sample_search")); ?></p>
        <form method="post">
            <input type="hidden" name="action" value="sample_search">
            <?php
            $counter = 0;
            foreach ($_SB->db_fields_fetch(false)['hierarchy_ordered'] as $parent) {
                $parent_id = $parent['field_parent_id'];
                $heading_class = $_SB->config()['ui']['sample_table']['heading_class'][$counter];
                $counter++;
                if ($counter == count($_SB->config()['ui']['sample_table']['heading_class'])) {
                    $counter = 0;
                }
                ?>
                <div class="card mb-3 <?php echo $heading_class; ?>">
                    <div class="card-header">
                        <?php echo $_SB->db_fields_fetch(false)['parents'][$parent[1]['field_parent_id']]['field_parent_name_' . $_SB->lang()]; ?>
                    </div>
                    <div class="card-body">
                        <?php
                        foreach ($parent as $field) {
                            if ($field['field_type'] == 8) {
                                continue;
                            }
                            ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <label for="<?php echo $field['field_name_internal']; ?>">
                                        <?php
                                        echo $field['field_name_' . $_SB->lang()];
                                        if ($field['field_type'] == 3) {
                                            echo ' (' . ucwords($_SB->language_output('format', "ui")) . ': ' . ucwords($_SB->language_output('format_date_string', "ui")) . ')';
                                        }
                                        ?>
                                    </label>
                                </div>
                                <div class="card-body">
                                    <?php
                                    #1: Textfield; 6: sample identifier; 7: multisample identifier
                                    if ($field['field_type'] == 1 or $field['field_type'] == 6 or $field['field_type'] == 7) {
                                        ?>
                                        <input type="text" class="form-control"
                                               id="<?php echo $field['field_name_internal']; ?>"
                                               name="<?php echo $field['field_name_internal']; ?>" value="<?php
                                        if (!empty($_POST[$field['field_name_internal']])) {
                                            echo $_POST[$field['field_name_internal']];
                                        }
                                        ?>">
                                        <?php
                                    } #2:Numerical
                                    elseif ($field['field_type'] == 2) {
                                        ?>
                                        <input type="number" class="form-control"
                                               id="<?php echo $field['field_name_internal']; ?>"
                                               name="<?php echo $field['field_name_internal']; ?>" value="<?php
                                        if (!empty($_POST[$field['field_name_internal']])) {
                                            echo $_POST[$field['field_name_internal']];
                                        }
                                        ?>"<?php if (!empty($field['field_option_1'])) {
                                            echo ' step="' . $field['field_option_1'] . '"';
                                        } ?>>
                                        <?php
                                    }#3: Date/time
                                    elseif ($field['field_type'] == 3) {
                                        ?>

                                        <input type="date" class="form-control"
                                               id="<?php echo $field['field_name_internal']; ?>"
                                               name="<?php echo $field['field_name_internal']; ?>" value="<?php
                                        if (!empty($_POST[$field['field_name_internal']])) {
                                            echo $_POST[$field['field_name_internal']];
                                        }
                                        ?>">
                                        <?php
                                    }#4: yes/no
                                    elseif ($field['field_type'] == 4) {
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                   name="<?php echo $field['field_name_internal']; ?>"
                                                   id="<?php echo $field['field_name_internal']; ?>_x"
                                                   value=""
                                                   checked>
                                            <label class="form-check-label"
                                                   for="<?php echo $field['field_name_internal']; ?>_x">
                                                ---
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                   name="<?php echo $field['field_name_internal']; ?>"
                                                   id="<?php echo $field['field_name_internal']; ?>_0" value="0">
                                            <label class="form-check-label"
                                                   for="<?php echo $field['field_name_internal']; ?>_0">
                                                <?php echo ucwords($_SB->language_output('no', "ui")); ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                   name="<?php echo $field['field_name_internal']; ?>"
                                                   id="<?php echo $field['field_name_internal']; ?>_1" value="1">
                                            <label class="form-check-label"
                                                   for="<?php echo $field['field_name_internal']; ?>_1">
                                                <?php echo ucwords($_SB->language_output('yes', "ui")); ?>
                                            </label>
                                        </div>
                                        <?php
                                    }#8: OU
                                    elseif ($field['field_type'] == 8) {

                                        ?>

                                        <select id="<?php echo $field['field_name_internal']; ?>"
                                                name="<?php echo $field['field_name_internal']; ?>"
                                                class="form-control">
                                            <option value="">---</option>
                                            <?php
                                            foreach ($_SB->user->ou_fetch() as $ou) {
                                                echo "<option value='" . $ou['ou_id'] . "'>" . $ou['ou_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }#9: numerical/multidimensional
                                    elseif ($field['field_type'] == 9) {
                                        ?>

                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $field['field_option_1']; $x++) {
                                                ?>
                                                <div class="col">
                                                    <label for="<?php echo $field['field_name_internal'] . '_' . $x; ?>">
                                                        <?php
                                                        echo $field['field_dimensions'][$x];
                                                        ?>
                                                    </label>
                                                    <input type="number" class="form-control"
                                                           id="<?php echo $field['field_name_internal'] . '_' . $x; ?>"
                                                           name="<?php echo $field['field_name_internal'] . '_' . $x; ?>"
                                                           value="<?php
                                                           if (!empty($_POST[$field['field_name_internal'] . '_' . $x])) {
                                                               echo $_POST[$field['field_name_internal'] . '_' . $x];
                                                           }
                                                           ?>">
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    #2:Numerical; 9: numerical/multidimensional
                                    if ($field['field_type'] == 2 or $field['field_type'] == 9) {
                                        ?>
                                        <br/>
                                        <label for="<?php echo $field['field_name_internal'] . '_operator'; ?>">
                                            <?php echo ucwords($_SB->language_output('operator', "ui")); ?>
                                        </label>
                                        <select id="<?php echo $field['field_name_internal'] . '_operator'; ?>"
                                                name="<?php echo $field['field_name_internal'] . '_operator'; ?>"
                                                class="form-control">
                                            <option value="=" <?php
                                            if (!empty($_POST[$field['field_name_internal'] . '_operator']) and $_POST[$field['field_name_internal'] . '_operator'] == '=') {
                                                echo 'checked';
                                            } ?>>=
                                            </option>
                                            <option value="<" <?php
                                            if (!empty($_POST[$field['field_name_internal'] . '_operator']) and $_POST[$field['field_name_internal'] . '_operator'] == '<') {
                                                echo 'checked';
                                            } ?>><
                                            </option>
                                            <option value=">" <?php
                                            if (!empty($_POST[$field['field_name_internal'] . '_operator']) and $_POST[$field['field_name_internal'] . '_operator'] == '>') {
                                                echo 'checked';
                                            } ?>>>
                                            </option>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <button type="submit"
                    class="btn btn-primary btn-block">
                <?php echo ucwords($_SB->language_output('submit', "ui")); ?>
            </button>
        </form>
    </div>
</div>