<?php
require_once(__DIR__ . '/lib/autoload.php');
$uri = explode('/', $_SERVER['REQUEST_URI']);
if(!empty($_GET['error'])){
    $uri = array('','app','error');
    $_APP['vars'][0] = $_GET['error'];
}
unset($uri[0]);

/***********************
 **** Form Actions *****
 ***********************/

if (!empty($_POST['action'])) {
    if ($_POST['action'] == 'login') {
        if ($_SB->user->user_login($_POST["user_alias"], $_POST["user_password"])) {
            $_SB->redirect('database_select');
        }
    } elseif ($_POST['action'] == 'database_select') {
        if ($_SB->db_select($_POST['db_id'])) {
            $_SB->redirect('sample_overview');
        }
    } elseif ($_POST['action'] == 'lang_select') {
        if ($_SB->lang_select($_POST['lang_id'])) {
            $_SB->redirect('sample_overview');
        }
    } elseif ($_POST['action'] == 'source_upload_csv') {
        $_RETURN['db_source_upload'] = $_SB->db_source_upload_init($_POST['source_id'], $_POST['source_upload_data'], "csv", array(
            "delimiter" => $_POST['source_upload_delimiter'],
            "enclosure" => $_POST['source_upload_enclosure'],
            "escape" => $_POST['source_upload_escape'],
            "table_id" => $_POST["source_upload_table_id"],
            "skip_lines" => $_POST["source_upload_skip_lines"]
        ));
    } elseif ($_POST['action'] == 'source_upload_xlsx') {
        if (is_uploaded_file($_FILES['source_upload_data']['tmp_name'])) {
            $_RETURN['db_source_upload'] = $_SB->db_source_upload_init($_POST['source_id'], file_get_contents($_FILES['source_upload_data']['tmp_name']), "xlsx", array(
                "skip_lines" => $_POST["source_upload_skip_lines"] ?? null, "continuous_read" => $_POST["source_upload_continuous_read"] ?? false
            ));
        }
    } elseif ($_POST['action'] == 'source_upload_decision') {
        if ($_POST['decision'] == 'accept') {
            $_RETURN['source_upload_decision'] = $_SB->db_source_upload_finish();
        } elseif ($_POST['decision'] == 'cancel') {
            $_SB->cache->clear('db_source_upload');
        }
    } elseif ($_POST['action'] == 'sample_search') {
        $_SB->db_samples_search_prepare($_POST);
    } elseif ($_POST['action'] == 'fields_parents_display_toggle') {
        $fields = array($_POST['field_parent_id'] => $_POST['toggle_to_' . $_POST['field_parent_id']]);
        $_SB->db_fields_parents_display_set($fields);
    } elseif ($_POST['action'] == 'basket_add') {
        $_SB->db_samples_basket_add($_POST);
    } elseif ($_POST['action'] == 'basket_remove') {
        $_SB->db_samples_basket_remove($_POST);
    } elseif ($_POST['action'] == 'basket_place_order') {
        $_SB->db_samples_order_add($_POST['order_description'] ?? null, $_POST['order_priority'] ?? 0);
    }
}

/***********************
 **** URI Routing *****
 ***********************/

if ($uri[1] == 'app') {
    unset($uri[1]);
    $uri_string = implode('/', $uri);
    if (empty($_APP['site_structure'][$uri_string])) {
        $_APP['current'] = preg_match_array($uri_string, array_keys($_APP['site_structure']));
        if ($_APP['current'] == false) {
            $_APP['current'] = "error";
            $_APP['vars'][0] = 404;
        }else{
            preg_match($_APP['current'], $uri_string, $_APP['vars']);
        }
    }else{
        $_APP['current'] = $uri_string;
    }
    # Checks if site requires a callback function e.g. for advanced access protection or redirects
    if ($_APP['site_structure'][$_APP['current']]['call'] == 'callback') {
        $_APP['site_structure'][$_APP['current']]['call'] = $_APP['site_structure'][$_APP['current']]['callback']($_SB, $_APP['vars']);
    }
    if(!empty($_APP['site_structure'][$_APP['current']]['args'])){
        $_APP['vars'] = array_merge($_APP['vars'], $_APP['site_structure'][$_APP['current']]['args']);
    }
    $_APP['call'] = $_APP['site_structure'][$_APP['current']]['call'];
    if (!empty($_APP['site_structure'][$_APP['current']]['template']) and $_APP['site_structure'][$_APP['current']]['template'] == 2) {
        require_once(__DIR__ . '/app/template/template_2.php');
    } else {
        require_once(__DIR__ . '/app/template/template_1.php');
    }

} elseif ($uri[1] == 'api') {
    unset($uri[1]);
    $uri_string = implode('/', $uri);
    if ($uri[2] == 'buttons_toggle') {
        require_once(__DIR__ . "/api/buttons_toggle_display.php");
    } elseif ($uri[2] == 'button_basket') {
        require_once(__DIR__ . "/api/button_basket.php");
    } elseif ($uri[2] == 'sampletable') {
        require_once(__DIR__ . "/api/sampletable.php");
    } elseif ($uri[2] == 'sample_download') {
        require_once(__DIR__ . "/api/sample_download.php");
    } elseif ($uri[2] == 'sampletable_load') {
        $_SITE['sample_table'] = $_GET;
        require_once(__DIR__ . '/app/template/sample_table.php');
    } elseif ($uri[2] == 'plugin') {
        require_once(__DIR__ . '/api/plugin_run.php');
    } elseif ($uri[2] == 'db_build') {
        require_once(__DIR__ . '/api/db_build.php');
    } elseif ($uri[2] == 'db_cache') {
        require_once(__DIR__ . '/api/db_cache.php');
    }
    if (!empty($response)) {
        echo json_encode($response);
    }
}

$_SB = NULL;