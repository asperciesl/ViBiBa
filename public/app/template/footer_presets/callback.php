<?php
if (!empty($_CALLBACK)) {
    ?>
    <script>
        $(document).ready(function () {
            $("#<?= $_CALLBACK['id'] ?>").load("<?= $_CALLBACK['url'] ?>");
        });
    </script>
    <?php
}
?>
