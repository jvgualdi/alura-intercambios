<?php

function alura_intercambios_adding_theme_resources(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'alura_intercambios_adding_theme_resources');

function alura_intercambios_registration_menu(){
    register_nav_menu('menu-navegacao', 'Menu Navegação');
}

add_action('init', 'alura_intercambios_registration_menu');