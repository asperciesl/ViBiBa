<div class="card mb-3">
    <div class="card-header">
        <?= ucwords($_SB->language_output('my_sources_heading', "sources_overview")) ?>
    </div>
    <div class="card-body">
        <p><?= $_SB->language_output('my_sources_description', "sources_overview") ?></p>
        <hr/>
        <ul>
            <?php
            if (!empty($_SB->db_source_fetch_available())){
                foreach ($_SB->db_source_fetch_available()['id'] as $source) {
                    ?>
                    <li>
                        <a href="/app/sources/upload/<?php echo $source['source_id']; ?>/">
                            <?php echo '#' . $source['source_id'] . ' - ' . $source['source_name_' . $_SB->config()['languages']['default']]; ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <?= ucwords($_SB->language_output('all_sources_heading', "sources_overview")) ?>
    </div>
    <div class="card-body">
        <p><?= $_SB->language_output('all_sources_description', "sources_overview") ?></p>
        <hr/>
        <ul>
            <?php
            if(!empty($_SB->db_source_fetch_all())){
                foreach ($_SB->db_source_fetch_all()['id'] as $source) {
                    ?>
                    <li>
                        <a href="/app/sources/view/<?php echo $source['source_id']; ?>/">
                            <?php echo '#' . $source['source_id'] . ' - ' . $source['source_name_' . $_SB->config()['languages']['default']]; ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>