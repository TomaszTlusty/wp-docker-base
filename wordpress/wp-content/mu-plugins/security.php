<?php
/**
 * Security hardening - must-use plugin
 */

remove_action("wp_head", "wp_generator");
add_filter("the_generator", "__return_empty_string");

add_action("init", function () {
    if (!is_admin() && isset($_GET["author"])) {
        wp_redirect(home_url(), 301);
        exit();
    }
});

add_filter("rest_endpoints", function ($endpoints) {
    if (isset($endpoints["/wp/v2/users"])) {
        unset($endpoints["/wp/v2/users"]);
    }
    if (isset($endpoints["/wp/v2/users/(?P<id>[\d]+)"])) {
        unset($endpoints["/wp/v2/users/(?P<id>[\d]+)"]);
    }
    return $endpoints;
});

add_filter("login_errors", function () {
    return "Nieprawidłowe dane logowania.";
});

add_filter("xmlrpc_enabled", "__return_false");

if (!defined("DISALLOW_FILE_EDIT")) {
    define("DISALLOW_FILE_EDIT", true);
}

// Wyłącz zbędne rzeczy w panelu które spowalniają
add_action("admin_init", function () {
    remove_action("welcome_panel", "wp_welcome_panel");
    remove_menu_page("site-health.php");
});

add_action("init", function () {
    if (is_admin()) {
        wp_deregister_script("heartbeat");
    }
});
