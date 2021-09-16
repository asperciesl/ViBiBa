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
                                        <h2>JWT</h2>
                                        <?php

                                        if (!empty($_CONFIG['jwt']['issuer']) and !empty($_CONFIG['jwt']['aud']) and $_SB->user->user_current() == false) {
                                            $issuer = $_CONFIG['jwt']['issuer'];
                                            $aud = $_CONFIG['jwt']['aud'];

                                            $cfAuth = $_COOKIE['CF_Authorization'] ?? '';

                                            function getKey($jwksUrl)
                                            {
                                                $client = new GuzzleHttp\Client();
                                                $res = $client->request('GET', $jwksUrl);

                                                if ($res->getStatusCode() != '200') {
                                                    throw new \Exception('Could not fetch JWKS');
                                                }

                                                $json = $res->getBody();
                                                $jwks = json_decode($json);
                                                $key_id = $jwks->keys[0]->kid;

                                                $jwkConverter = new JWKConverter();
                                                $key = $jwkConverter->toPEM((array)$jwks->keys[0]);
                                                return [$key_id => $key];
                                            }

                                            if (!empty($cfAuth)) {
                                                try {
                                                    $id_token = rawurldecode($cfAuth);
                                                    $key = getKey($_CONFIG['jwt']['url']);
                                                    $signature_verifier = new AsymmetricVerifier($key);
                                                    $token_verifier = new IdTokenVerifier($issuer, $aud, $signature_verifier);
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