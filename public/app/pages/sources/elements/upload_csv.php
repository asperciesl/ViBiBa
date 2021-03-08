<?php if (!empty($source)) { ?>
    <form method="post">
        <input type="hidden" name="action" value="source_upload_csv">
        <input type="hidden" name="source_id" value="<?= $source['source_id'] ?>">
        <?php if (!empty($plugin_config['upload'])) { ?>
            <div class="form-group">
                <label for="source_upload_table_id"><?= ucwords($_SB->language_output('table_select', "ui")) ?></label>
                <select class="form-control" id="source_upload_table_id">
                    <?php foreach ($plugin_config['upload'] as $key => $value) { ?>
                        <option value="<?= $key ?>"><?= $value["name"] ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
        <label for="source_upload_data">
            <?= ucwords($_SB->language_output('input', "ui")) ?>
        </label>
        <textarea class="form-control" name="source_upload_data"
                  id="source_upload_data"><?= $_POST['source_upload_data'] ?? null ?></textarea><br/>
        <label for="source_upload_skip_lines">
            <?= ucwords($_SB->language_output('skip_lines', "ui")) ?>
        </label><br/>
        <input class="form-control" type="text" name="source_upload_skip_lines"
               id="source_upload_skip_lines"
               placeholder="<?= ucwords($_SB->language_output('skip_lines', "ui")) ?>"
               value="<?= $_POST['source_upload_skip_lines'] ?? null ?>"><br/>
        <label for="source_upload_delimiter">
            <?= ucwords($_SB->language_output('delimiter', "ui")); ?>
        </label><br/>
        <input class="form-control" type="text" name="source_upload_delimiter"
               id="source_upload_delimiter"
               placeholder="<?= ucwords($_SB->language_output('delimiter', "ui")) ?>"
               value="<?= $_POST['source_upload_delimiter'] ?? null ?>"><br/>
        <label for="source_upload_enclosure">
            <?= ucwords($_SB->language_output('enclosure', "ui")) ?>
        </label><br/>
        <input class="form-control" type="text" name="source_upload_enclosure"
               id="source_upload_enclosure"
               placeholder="<?= ucwords($_SB->language_output('enclosure', "ui")) ?>"
               value="<?= $_POST['source_upload_enclosure'] ?? null ?>"><br/>
        <label for="source_upload_escape">
            <?php echo ucwords($_SB->language_output('escape', "ui")); ?>
        </label><br/>
        <input class="form-control" type="text" name="source_upload_escape" id="source_upload_escape"
               placeholder="<?= ucwords($_SB->language_output('escape', "ui")) ?>"
               value="<?= $_POST['source_upload_escape'] ?? null ?>"><br/>
        <button type="submit"
                class="btn btn-primary btn-block">
            <?= ucwords($_SB->language_output('submit', "ui")) ?>
        </button>
    </form>
<?php } ?>