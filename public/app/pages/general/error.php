<?php $errno = $_APP['vars'][0] ?? 500; ?>
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
                                <img src="/assets/img/logo.png" alt="">
                                <h1 class="h3 mb-3 font-weight-normal"
                                    style="color:#000099"><?= $_SB->config()['name']; ?></h1>
                                <h2>Error <?= $errno ?></h2>
                                <?php if ($errno == 404) {
                                    ?>
                                    <p>The page you try to access cannot be resolved. Maybe you clicked on a defect
                                        link?</p>
                                    <p>If the problem persists, please contact the administrators.</p>
                                <?php } elseif ($errno == 403) { ?>
                                    <p>You do not have sufficient rights to access the requested site.</p>
                                    <p>To request the access rights please contact the administrators.</p>
                                <?php } elseif ($errno == 500) { ?>
                                    <p>The server encountered an internal error.</p>
                                    <p>If the problem persists, please contact the administrators.</p>
                                <?php } else { ?>
                                    <p>The server encountered an unknown error.</p>
                                    <p>If the problem persists, please contact the administrators.</p>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>