<?php
$_APP['site_structure'] = array(
    'maintenance' => array('call' => __DIR__ . '/../app/pages/general/maintenance.php', 'template' => 2),
    'dashboard' => array('call' => __DIR__ . '/../app/pages/general/dashboard.php', 'template' => 1),
    'login' => array('call' => __DIR__ . '/../app/pages/user/login.php', 'template' => 2),
    'logout' => array('call' => 'callback', 'callback' => function ($_SB, $_ARGS = null) {
        $_SB->user->logout();
        $_SB->redirect('login');
    }),
    'databases' => array('call' => __DIR__ . '/../app/pages/user/database_select.php', 'template' => 2),
    'languages' => array('call' => __DIR__ . '/../app/pages/user/lang_select.php', 'template' => 2),
    'sample/overview' => array('call' => __DIR__ . '/../app/pages/sample/sample_overview.php', 'template' => 1),
    'sample/summary' => array('call' => __DIR__ . '/../app/pages/sample/sample_summary.php', 'template' => 1),
    'sample/basket' => array('call' => __DIR__ . '/../app/pages/sample/sample_basket.php', 'template' => 1),
    'sample/orders' => array('call' => __DIR__ . '/../app/pages/sample/sample_orders.php', 'template' => 1),
    '#sample/orders/([A-Za-z0-9-_]+)/?#' => array('call' => __DIR__ . '/../app/pages/sample/sample_orders.php', 'template' => 1),
    'sample/search' => array('call' => 'callback', 'template' => 1, 'callback' => function ($_SB, $_ARGS = null) {
        if (!empty($_SB->cache->fetch('sample_search'))) {
            return __DIR__ . '/../app/pages/sample/sample_search_results.php';
        } else {
            return __DIR__ . '/../app/pages/sample/sample_search_form.php';
        }
    }),
    '#sample/search/([A-Za-z0-9-_]+)/([^/]+)/?#' => array('call' => __DIR__ . '/../app/pages/sample/sample_search_light.php', 'template' => 1),
    '#sample/detail/([A-Za-z0-9-_]+)/([^/]+)/?#' => array('call' => __DIR__ . '/../app/pages/sample/sample_search_light.php', 'template' => 1, 'args' => array('detail' => 1)),
    'sources/overview' => array('call' => __DIR__ . '/../app/pages/sources/sources_overview.php', 'template' => 1),
    '#sources/view/([A-Za-z0-9-_]+)/?#' => array('call' => __DIR__ . '/../app/pages/sources/sources_view.php', 'template' => 1),
    '#sources/upload/([A-Za-z0-9-_]+)/?#' => array('call' => 'callback', 'callback' => function ($_SB, $_ARGS = null) {
        $source_id = $_ARGS[1];
        if (empty($_SB->db_source_fetch_available()['id'][$source_id])) {
            $_SB->redirect('sources_overview');
        }
        return __DIR__ . '/../app/pages/sources/sources_upload.php';
    }),
    'licenses' => array('call' => __DIR__ . '/../app/pages/general/licenses.php', 'template' => 1),
    'experimental' => array('call' => __DIR__ . '/../app/pages/general/experimental.php', 'template' => 1),
    'contact' => array('call' => __DIR__ . '/../app/pages/general/contact.php', 'template' => 1),
    'error' => array('call' => __DIR__ . '/../app/pages/general/error.php', 'template' => 2)
);

$_APP['navigation'] = array(
    array(
        'name' => '',
        'entries' =>
            array(
                array('name' => 'Dashboard', 'uri' => '/app/dashboard', 'icon' => 'fas fa-fw fa-tachometer-alt')
            )
    ),
    array(
        'name' => 'Access Samples',
        'entries' =>
            array(
                array('name' => ucwords($_SB->language_output('sample_overview', 'ui')), 'uri' => '/app/sample/overview', 'icon' => 'fas fa-table'),
                array('name' => ucwords($_SB->language_output('sample_search', 'ui')), 'uri' => '/app/sample/search', 'icon' => 'fas fa-search'),
                array('name' => ucwords($_SB->language_output('sample_summary', 'ui')), 'uri' => '/app/sample/summary', 'icon' => 'fas fa-envelope'),
            )
    ),
    array(
        'name' => 'Request Samples',
        'entries' =>
            array(
                array('name' => ucwords($_SB->language_output('sample_basket', 'ui')), 'uri' => '/app/sample/basket', 'icon' => 'fas fa-shopping-cart'),
                array('name' => ucwords($_SB->language_output('sample_orders', 'ui')), 'uri' => '/app/sample/orders', 'icon' => 'fas fa-book')
            )
    ),
    array(
        'name' => 'Database Architecture',
        'entries' =>
            array(
                array('name' => ucwords($_SB->language_output('sources_overview', 'ui')), 'uri' => '/app/sources/overview', 'icon' => 'fas fa-keyboard')
            )
    ),
    array(
        'name' => 'General',
        'entries' =>
            array(
                array('name' => ucwords($_SB->language_output('database_select', 'ui')), 'uri' => '/app/databases', 'icon' => 'fas fa-database'),
                array('name' => ucwords($_SB->language_output('lang_select', 'ui')), 'uri' => '/app/languages', 'icon' => 'fas fa-flag'),
                array('name' => ucwords($_SB->language_output('licenses', 'ui')), 'uri' => '/app/licenses', 'icon' => 'fas fa-scroll'),
                array('name' => ucwords($_SB->language_output('experimental', 'ui')), 'uri' => '/app/experimental', 'icon' => 'fas fa-flask'),
                array('name' => ucwords($_SB->language_output('contact', 'ui')), 'uri' => '/app/contact', 'icon' => 'fas fa-envelope'),
                #array('name' => 'Logout', 'uri' => 'app/logout', 'icon' => 'fas fa-sign-out-alt')
            )
    )
);