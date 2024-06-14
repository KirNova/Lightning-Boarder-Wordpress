<?php
/*
Plugin Name: Lightning Border
Description: Fügt automatisch generierte realistische Blitze hinzu, die sich nach und nach aufbauen und im Footer enden, und 70% von der oberen Mitte der Seite ausgehen.
Version: 3.1
Author: <a href="https://rabenschatten.de/" target="_blank">Kir Nova</a>
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Einbindepfade definieren
define('LIGHTNING_BORDER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('LIGHTNING_BORDER_PLUGIN_URL', plugin_dir_url(__FILE__));

// CSS einbinden
function lightning_border_enqueue_styles() {
    wp_enqueue_style('lightning-border-style', LIGHTNING_BORDER_PLUGIN_URL . 'css/style.css', array(), '3.1');
}
add_action('wp_enqueue_scripts', 'lightning_border_enqueue_styles');

// JavaScript einbinden
function lightning_border_enqueue_scripts() {
    wp_enqueue_script('lightning-border-script', LIGHTNING_BORDER_PLUGIN_URL . 'js/script.js', array(), '3.1', true);
    wp_localize_script('lightning-border-script', 'lightningSettings', array(
        'color' => get_option('lightning_color', 'white'),
        'frequency' => get_option('lightning_frequency', 5),
        'offset' => get_option('lightning_offset', 0.4),
        'amount' => get_option('lightning_amount', 2),
    ));
}
add_action('wp_enqueue_scripts', 'lightning_border_enqueue_scripts');

// Einstellungsseite einbinden
require_once LIGHTNING_BORDER_PLUGIN_DIR . 'includes/settings-page.php';

// Einstellungsmenü hinzufügen
function lightning_border_settings_menu() {
    add_menu_page(
        'Lightning Border Einstellungen', // Seitentitel
        'Lightning Border', // Menütext
        'manage_options', // Capability
        'lightning-border-settings', // Menü-Slug
        'lightning_border_settings_page', // Callback-Funktion
        'dashicons-lightning', // Symbol-URL
        61 // Position im Menü
    );
}
add_action('admin_menu', 'lightning_border_settings_menu');

// Plugin Update-Checker einrichten
require LIGHTNING_BORDER_PLUGIN_DIR . 'vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/KirNova/Lightning-Boarder-Wordpress/',
    __FILE__,
    'lightning-border'
);

// Optional: GitHub-Zugangstoken hinzufügen
$updateChecker->setAuthentication('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');
