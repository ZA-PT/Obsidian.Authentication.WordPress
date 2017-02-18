<?php
/*
Plugin Name: Obsidian Authentication Plugin
Plugin URI:  https://github.com/ZA-PT/Obsidian.Authentication.WordPress
Description: A WordPress plugin provided a convenient to access Obsidian-based Authentication Server.
Version:     0.0.1
Author:      ZA-PT
Author URI:  http://www.za-pt.org
License:     Apache License 2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0.html
*/
define("ROOT_PATH",__DIR__);
require_once(ROOT_PATH."/authentication/resource-owner-password-credential-authentication.php");
require_once(ROOT_PATH."/helper/jwt.php");
require_once(ROOT_PATH."/hook-handler.php");
require_once(ROOT_PATH."/views/view-controller.php");
require_once(ROOT_PATH."/options/client-administrator-option-page.php");
$auth_mode = get_option("obsidian_auth_grant_mode");
/*setup hook for plugin installation*/
register_activation_hook(__FILE__,"obsidian_hook_handler::register_activation_hook_handler");
register_deactivation_hook(__FILE__,"obsidian_hook_handler::register_deactivation_hook_handler");

/*setup hook for Resource Owner Password Credential Mode*/
if($auth_mode=="password")
    add_filter("authenticate","obsidian_hook_handler::authenticate_handler",30,3);

/*setup hook for client option page*/
if(is_admin())
{
    $c_a_o_p = new client_administrator_option_page();
    $c_a_o_p->enable_page();
}

?>