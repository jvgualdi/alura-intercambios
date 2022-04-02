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

function alura_intercambios_banners_registration(){
    register_post_type('banners',
        array(
            'labels' => array('name'=>'Banner'),
            'public' => true,
            'menu_position' => 1,
            'supports' => array('title', 'thumbnail'),
            'menu_icon' => 'dashicons-format-image'
        )
    );
}
add_action('init', 'alura_intercambios_banners_registration');

function alura_intercambios_metabox_registration(){
    add_meta_box(
        'ai_metabox_registration',
        'Texto para a home',
        'ai_callback_function',
        'banners'
    );
}
add_action('add_meta_boxes', 'alura_intercambios_metabox_registration');

function ai_callback_function($post){
    $texto_home_1 = get_post_meta($post->ID,'_texto_home_1', true);
    $texto_home_2 = get_post_meta($post->ID,'_texto_home_2', true);
    ?>
    <label for="texto_home_1">Texto 1</label>
    <input type="text" name="texto_home_1" style="width: 100%" value="<?= $texto_home_1 ?>"/>
    <br>
    <br>
    <label for="texto_home_2">Texto 2</label>
    <input type="text" name="texto_home_2" style="width: 100%" value="<?= $texto_home_2 ?>"/>
    <?php
}

function alura_intercambios_saving_metabox_data($post_id){
    foreach( $_POST as $key=>$value){
        if($key !== 'texto_home_1' && $key !== 'texto_home_2'){
            continue;
        }

        update_post_meta(
              $post_id,
            '_'. $key,
            $_POST[$key]
        );
    }
}
add_action('save_post','alura_intercambios_saving_metabox_data');

function alura_intercambios_adding_scripts(){
    if(is_front_page()){
        wp_enqueue_script('typed-js', get_template_directory_uri() . '/js/typed.min.js', array(), false, true);
        wp_enqueue_script('banner-text-js', get_template_directory_uri() . '/js/bannet-text.js', array('typed-js'), false, true);
    }
}
add_action('wp_enqueue_scripts', 'alura_intercambios_adding_scripts');