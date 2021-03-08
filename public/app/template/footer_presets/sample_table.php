<?php
$url = '/api/datatables_samples.php';
if(!empty($_SITE['sample_table']['search'])){

}
?>
<script>
    var table = "";
    $(document).ready(function () {
        <?php require_once(__DIR__.'/sample_table_core.php'); ?>
    });
</script>