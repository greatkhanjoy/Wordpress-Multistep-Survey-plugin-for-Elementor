<?php

/**
 * Plugin Name: Multi Step Survey - Greatkhanjoy
 * Description: Multistep wizard Survey for Elementor.
 * Version:     1.0.0
 * Author:      greatkhanjoy
 * Author URI:  https://greatkhanjoy.me/
 * Text Domain: gsurvey
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

//Load assets
function register_survey_widget_scripts()
{
    wp_register_script('gsurvey-script', plugins_url('build/index.js', __FILE__), array('wp-element'));
}
add_action('wp_enqueue_scripts', 'register_survey_widget_scripts');

function register_survey_widget_styles()
{
    wp_register_style('gsurvey-style', plugins_url('build/index.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'register_survey_widget_styles');



function gsurvey_editor_styles()
{
    wp_register_style('gsurvey-editor-style', plugins_url('build/index.css', __FILE__));
    wp_enqueue_style('gsurvey-editor-style');
}

add_action('elementor/editor/before_enqueue_styles', 'gsurvey_editor_styles');


function register_greatkhanjoy_survey_widget($widgets_manager)
{

    require_once(__DIR__ . '/widgets/greatkhanjoy_survey.php');
    require_once(__DIR__ . '/widgets/hello-world-widget-2.php');

    $widgets_manager->register(new \Elementor_Greatkhanjoy_Survey());
    $widgets_manager->register(new \Elementor_Hello_World_Widget_2());
}
add_action('elementor/widgets/register', 'register_greatkhanjoy_survey_widget');


add_action('rest_api_init', function () {
    register_rest_route('gsurvey/v1', 'send-email', array(
        'methods'  => WP_REST_Server::CREATABLE,
        'callback' => 'send_email_callback',
        'permission_callback' => function () {
            return true;
        },
    ));
});

function send_email_callback($request)
{
    $email_data = $request->get_json_params();

    $to = $email_data['to'];
    $subject = $email_data['subject'];
    $body = $email_data['body'];

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
    );

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        return new WP_REST_Response('Email sent successfully.', 200);
    } else {
        return new WP_REST_Response('Failed to send email.', 500);
    }
}
