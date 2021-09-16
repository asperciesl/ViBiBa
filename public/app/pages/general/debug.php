<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <form method="post" class="form-signin">
                                <img src="/assets/img/logo.png" alt="">
                                <h1 class="h3 mb-3 font-weight-normal"
                                    style="color:#000099">Debug Info</h1>
                                <?php
                                    if(empty($_SB->config()['debug_info']) or $_SB->config()['debug_info'] == false){
                                        ?>
                                        <p>The debug screen has been disabled.</p>
                                        <?php
                                    }else{
                                        ?>
                                        <h2>$_SESSION</h2>
                                        <pre><?php var_dump($_SESSION);?></pre>
                                        <h2>$_COOKIE</h2>
                                        <pre><?php var_dump($_COOKIE);?></pre>
                                        <?php
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>