<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"
                         style="background: url('/assets/img/probes.jpeg') no-repeat;background-size: cover;"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <form method="post" class="form-signin">
                                <img src="/assets/img/logo.png" alt=""><br/>
                                <h1 class="h3 mb-3 font-weight-normal"
                                    style="color:#000099"><?php echo $_SB->config()['name']; ?></h1><br/><br/><br/>
                                <?php
                                if ($_SB->db_fetch() != false) {
                                    display_alerts($_SB);
                                    ?>
                                    <input type="hidden" name="action" value="database_select">
                                    <label for="db_id"
                                           class="sr-only"><?php echo ucwords($_SB->language_output('database', "ui")); ?></label>
                                    <select id="db_id" class="form-control" name="db_id">
                                        <?php
                                        foreach ($_SB->db_fetch() as $db) {
                                            ?>
                                            <option
                                            value='<?= $db["db_id"] ?>'><?= $db["db_name_" . $_SB->lang()] ?></option><?php
                                        }
                                        ?>
                                    </select> <br/>
                                    <button class="btn btn-lg btn-primary btn-block"
                                            type="submit"><?php echo ucwords($_SB->language_output('database_select', "ui")); ?></button>
                                    <?php
                                } else {
                                    #Edge case if user has no access to any database
                                    $_SB->alerts->add("error", 406);
                                    display_alerts($_SB);
                                }
                                ?>
                                <p class="mt-5 mb-3 text-muted"><?= ucfirst($_SB->language_output('footer', "ui")) ?></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>