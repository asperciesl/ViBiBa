<?php
$_CONFIG['version'] = "0.9.1";
gc_collect_cycles();
if (file_exists(__DIR__ . '/../config/config.php')) {
    require_once(__DIR__ . '/../config/config.php');
} elseif (file_exists(__DIR__ . '/../config/config.default.php')) {
    require_once(__DIR__ . '/../config/config.default.php');
} else {
    echo "Error: No config file given";
    exit();
}

if (empty($_CONFIG)) {
    $maintenance = true;
    $_APP['call'] = __DIR__ . '/../app/pages/general/maintenance.php';
    require_once(__DIR__ . '/../app/template/template_1.php');
    exit();
}

require_once(__DIR__ . '/../vendor/autoload.php');
$_LANG = array();
require_once(__DIR__ . "/lang/en.php");
require_once(__DIR__ . '/dep/mysqli_wrapper.php');
require_once(__DIR__ . '/dep/cache.php');
#require_once(__DIR__ . '/dep/php_mail_daemon.php');
require_once(__DIR__ . '/dep/user_management.php');
require_once(__DIR__ . '/dep/table_parser.php');
require_once(__DIR__ . '/dep/alerts.php');
require_once(__DIR__ . '/dep/func.php');
require_once(__DIR__ . '/vibiba.php');
require_once(__DIR__ . '/vibiba_plugin_proto.php');

session_start();

if (!empty($_SESSION['SB']['current']['lang']) and !empty($_CONFIG['languages']['data'][$_SESSION['SB']['current']['lang']])) {
    #strlen to avoid exploits
    if (strlen($_SESSION['SB']['current']['lang']) <= 3) {
        if (file_exists(__DIR__ . "/lang/" . $_SESSION['SB']['current']['lang'] . '.php')) {
            require_once(__DIR__ . "/lang/" . $_SESSION['SB']['current']['lang'] . '.php');
        }
    }
}

$_SB = new vibiba($_CONFIG, $_LANG);
require_once(__DIR__ . '/../config/site_structure.php');
if (empty($_SESSION['debug']) and $_CONFIG['maintenance']) {
    $maintenance = true;
} else {
    $maintenance = false;
}

/*****************************
 **** JWT Automatic Login ****
 *****************************/

use Auth0\SDK\Helpers\Tokens\AsymmetricVerifier;
use Auth0\SDK\Helpers\Tokens\IdTokenVerifier;
use CoderCat\JWKToPEM\JWKConverter;

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
            if(!empty($user_identity['email'])){
                $_SB->user->user_login($user_identity['email'], NULL, 'force');
            }
        } catch (\Exception $e) {
        }
    }
}

/*****************************
 **** Automatic Redirect *****
 *****************************/
if ($maintenance) {
    if ($_SERVER['REQUEST_URI'] != '/app/maintenance') {
        $_SB->redirect('maintenance');
    }
} elseif ($_SERVER['REQUEST_URI'] == '/app/maintenance') {
    $_SB->redirect('index');
}

if ($_SB->user->user_current() == false) {
    if (explode('/', $_SERVER['REQUEST_URI'])[1] == 'api' and !empty($_CONFIG['api']['secret']) and !empty($_POST['api_secret']) and $_CONFIG['api']['secret'] == $_POST['api_secret']) {
        #API Access Exception
    } elseif ($_SERVER['REQUEST_URI'] != '/app/login' and $_SERVER['REQUEST_URI'] != '/app/debug') {
        $_SB->redirect('login');
    }
} elseif ($_SB->db_current() == false and $_SERVER['REQUEST_URI'] != '/app/databases') {
    $_SB->redirect('database_select');
} elseif ($_SERVER['REQUEST_URI'] == '/app/login') {
    $_SB->redirect('index');
}



unset($_CONFIG);
