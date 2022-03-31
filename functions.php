<?php

function alura_intercambios_taxonomy_registration(){
    register_taxonomy(
        'paises',
        'destinos',
        array(
            'labels' => array('name' => 'Países'),
            'hierarchical' => true
        )
    );
}
add_action('init', 'alura_intercambios_taxonomy_registration');

function alura_intercambios_customized_post_registration(){
    register_post_type('destinos',
        array(
            'labels' => array('name' => 'Destinos'),
            'public' => true,
            'menu_position' => 0,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-admin-site'
        )
        );
}
add_action('init', 'alura_intercambios_customized_post_registration');

function alura_intercambios_adding_theme_resources(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'alura_intercambios_adding_theme_resources');

function alura_intercambios_registration_menu(){
    register_nav_menu('menu-navegacao', 'Menu Navegação');
}

add_action('init', 'alura_intercambios_registration_menu');