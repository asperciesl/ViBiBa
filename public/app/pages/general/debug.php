<?php
use Auth0\SDK\Helpers\Tokens\AsymmetricVerifier;
use Auth0\SDK\Helpers\Tokens\IdTokenVerifier;
use CoderCat\JWKToPEM\JWKConverter;
?>
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
                                        $_CONFIG = $_SB->config();
                                        if (!empty($_CONFIG['jwt']['issuer']) and !empty($_CONFIG['jwt']['aud'])) {
                                            ?>
                                            <h2>JWT</h2>
                                            <?php
                                            $issuer = $_CONFIG['jwt']['issuer'];
                                            $aud = $_CONFIG['jwt']['aud'];

                                            $cfAuth = $_COOKIE['CF_Authorization'] ?? '';

                                            if (!empty($cfAuth)) {
                                                try {
                                                    $id_token = rawurldecode($cfAuth);
                                                    ?>
                                                    <h3>$id_token</h3>
                                                    <pre><?php var_dump($id_token);?></pre>
                                                    <?php
                                                    $key = getKey($_CONFIG['jwt']['url']);
                                                    ?>
                                                    <h3>$key</h3>
                                                    <pre><?php var_dump($key);?></pre>
                                                    <?php
                                                    $signature_verifier = new AsymmetricVerifier($key);
                                                    ?>
                                                    <h3>$signature_verifier</h3>
                                                    <pre><?php var_dump($signature_verifier);?></pre>
                                                    <?php
                                                    $token_verifier = new IdTokenVerifier($issuer, $aud, $signature_verifier);
                                                    ?>
                                                    <h3>$token_verifier</h3>
                                                    <pre><?php var_dump($token_verifier);?></pre>
                                                    <?php
                                                    $user_identity = $token_verifier->verify($id_token);
                                                    ?>
                                                    <h3>$user_identity</h3>
                                                    <pre><?php var_dump($user_identity);?></pre>
                                                    <?php
                                                    if(!empty($user_identity['email'])){
                                                        $_SB->user->user_login($user_identity['email'], NULL, 'force');
                                                    }
                                                } catch (\Exception $e) {
                                                    ?>
                                                    <h3>Exception</h3>
                                                    <pre><?php var_dump($e);?></pre>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
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