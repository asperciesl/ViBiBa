<script>
    $("#button_bar_frame").load("/api/buttons_toggle/?<?php
        if (!empty($_SITE['sample_table'])) {
            echo http_build_query($_SITE['sample_table']);
        }
        ?>", function () {
    });
</script>