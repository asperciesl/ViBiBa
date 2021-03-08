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
                                    style="color:#000099"><?= $_SB->config()['name'] ?></h1><br/><br/><br/>
                                <?php
                                display_alerts($_SB);
                                ?>
                                <input type="hidden" name="action" value="lang_select">
                                <label for="lang_id"
                                       class="sr-only"><?= ucwords($_SB->language_output('database', "ui")) ?></label>
                                <select id="lang_id" class="form-control" name="lang_id">
                                    <?php
                                    foreach ($_SB->config()['languages']['data'] as $lang_id => $lang) {
                                        ?>
                                        <option
                                        value='<?= $lang_id ?>'><?= $lang['name'] ?></option><?php
                                    }
                                    ?>
                                </select> <br/>
                                <button class="btn btn-lg btn-primary btn-block"
                                        type="submit"><?= ucwords($_SB->language_output('lang_select', "ui")) ?></button>
                                <p class="mt-5 mb-3 text-muted"><?= ucfirst($_SB->language_output('footer', "ui")) ?></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>