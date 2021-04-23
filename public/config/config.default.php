<?php
$_CONFIG['url'] = 'http://localhost/';
$_CONFIG['name'] = 'ViBiBa';

$_CONFIG['mysql']['host'] = 'db';
$_CONFIG['mysql']['user'] = 'docker';
$_CONFIG['mysql']['password'] = 'docker';
$_CONFIG['mysql']['db'] = 'docker';

$_CONFIG['api']['secret'] = 'PleaseChangeTheSecret!';

$_CONFIG['user_management']['tables']['user'] = 'main_users';
$_CONFIG['user_management']['tables']['ou'] = 'main_ou';

$_CONFIG['user_management']['user']['fields'][] = array("name" => "user_alias", "required" => true, "auth" => true);
$_CONFIG['user_management']['user']['fields'][] = array("name" => "user_mail", "required" => true, "auth" => true);
$_CONFIG['user_management']['user']['fields'][] = array("name" => "user_password", "required" => true, "auth" => true);

$_CONFIG['user_management']['user']['fields'][] = array("name" => "ou_id", "required" => true);

$_CONFIG['user_management']['user']['fields'][] = array("name" => "user_firstname", "required" => true);
$_CONFIG['user_management']['user']['fields'][] = array("name" => "user_lastname", "required" => true);
$_CONFIG['user_management']['user']['fields'][] = array("name" => "user_sex", "required" => false);
$_CONFIG['user_management']['user']['fields'][] = array("name" => "user_salutation", "required" => true);

$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_name", "required" => true, "auth" => true);
$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_short", "required" => true, "auth" => true);
$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_city", "required" => false);
$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_adress", "required" => false);
$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_phone", "required" => false);
$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_fax", "required" => false);
$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_contact", "required" => false);
$_CONFIG['user_management']['ou']['fields'][] = array("name" => "ou_description", "required" => false);

$_CONFIG['mail']['host'] = '';
$_CONFIG['mail']['user'] = '';
$_CONFIG['mail']['password'] = '';
$_CONFIG['mail']['from'] = '';
$_CONFIG['mail']['port'] = 465;
$_CONFIG['mail']['sleep'] = 2;

$_CONFIG['languages']['default'] = 'en';
$_CONFIG['languages']['data']['en']['name'] = 'English';
$_CONFIG['languages']['data']['en']['country_code'] = 'GB';
$_CONFIG['languages']['data']['de']['name'] = 'Deutsch';
$_CONFIG['languages']['data']['de']['country_code'] = 'DE';

$_CONFIG['ui']['sample_table']['heading_class'][] = '';
$_CONFIG['ui']['sample_table']['heading_class'][] = '';

$_CONFIG['maintenance'] = false;
$_CONFIG['debug'] = false;

$_CONFIG['jwt']['issuer'] = '';
$_CONFIG['jwt']['aud'] = '';
$_CONFIG['jwt']['url'] = '';