<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

// Main Menu
register_nav_menu('header', 'Main menu in site header');

// Footer Menu
register_nav_menu('footer', 'Footer menu');