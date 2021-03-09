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
                                <?php
                                display_alerts($_SB);
                                ?>
                                <input type="hidden" name="action" value="login">
                                <img src="/assets/img/logo.png" alt="">
                                <h1 class="h3 mb-3 font-weight-normal"
                                    style="color:#000099"><?= $_SB->config()['name']; ?></h1>
                                <label for="inputEmail"
                                       class="sr-only"><?= ucfirst($_SB->language_output('username', "ui")) ?></label>
                                <input type="text" id="inputEmail" class="form-control form-control-login"
                                       placeholder="<?= ucfirst($_SB->language_output('username', "ui")) ?>"
                                       name="user_alias" value="<?= $_POST['user_alias'] ?? '' ?>" required
                                       autofocus>
                                <label for="inputPassword"
                                       class="sr-only"><?= ucfirst($_SB->language_output('password', "ui")) ?></label>
                                <input type="password" id="inputPassword" class="form-control form-control-login"
                                       placeholder="<?= ucfirst($_SB->language_output('password', "ui")) ?>"
                                       name="user_password" required>
                                <?php if ($_SB->user->ou_fetch() != false and count($_SB->user->ou_fetch()) > 1) {
                                    ?>
                                    <label for="lab_id"
                                           class="sr-only"><?= ucfirst($_SB->language_output('ou', "ui")) ?></label>
                                    <select class="form-control" name="lab_id" id="lab_id">
                                        <?php
                                        foreach ($_SB->user->ou_fetch() as $ou) {
                                            ?>
                                            <option value='<?= $ou["ou_id"] ?>'><?= $ou["ou_name"] ?></option><?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                } ?> <br/>
                                <button class="btn btn-lg btn-primary btn-block"
                                        type="submit"><?= ucfirst($_SB->language_output('login', "ui")) ?></button>
                                <p class="mt-5 mb-3 text-muted"><?= ucfirst($_SB->language_output('footer', "ui")) ?></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>