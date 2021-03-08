<?php
if (!empty($source)) {
    ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="source_upload_xlsx">
        <input type="hidden" name="source_id" value="<?= $source['source_id'] ?>">
        <label for="xlsx_source_upload_data">
            <?= ucwords($_SB->language_output('input', "ui")); ?>
        </label><br/>
        <input type="file" id="xlsx_source_upload_data" name="source_upload_data"
               aria-describedby="xlsx_source_upload_data">
        <br/><br/>
        <label for="xlsx_source_upload_skip_lines">
            <?= ucwords($_SB->language_output('skip_lines', "ui")) ?>
        </label><br/>
        <input class="form-control" type="text" name="source_upload_skip_lines"
               id="xlsx_source_upload_skip_lines"
               placeholder="<?= ucwords($_SB->language_output('skip_lines', "ui")) ?>"
               value="<?= $_POST['source_upload_skip_lines'] ?? null ?>"><br/>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="source_upload_continuous_read"
                   name="source_upload_continuous_read">
            <label class="form-check-label" for="source_upload_continuous_read">
                <?= ucwords($_SB->language_output('continuous_read', "ui")) ?>
            </label>
        </div>
        <br/>
        <button type="submit"
                class="btn btn-primary btn-block">
            <?= ucwords($_SB->language_output('submit', "ui")) ?>
        </button>
    </form>
<?php } ?>