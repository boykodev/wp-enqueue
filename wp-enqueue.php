<?php

/*
Plugin Name: WP Enqueue
Description: WordPress plugin to enqueue scripts and styles.
Version: 1.0.0
Author: Serge Boyko
Author URI: http://www.boykodev.com
*/

class WP_Enqueue_Plugin {

    private $options = array();

    public function __construct() {
        $this->set_options();
    }

    private function set_options() {
        $options = array(
            'scripts' => array(
                'path' => 'wpenq_scripts_path',
                'cond' => 'wpenq_scripts_cond',
                'conditions' => array(
                    'head', 'footer', 'admin'
                )
            ),
            'styles' => array(
                'path' => 'wpenq_styles_path',
                'cond' => 'wpenq_styles_cond',
                'conditions' => array(
                    'admin', 'IE 10', 'IE 9', 'IE 8'
                )
            )
        );

        foreach ($options as $domain => $option) {
            foreach ($option as $alias => $value) {
                $this->set_option($domain, $alias, $value);
            }
        }

    }

    private function set_option($domain, $alias, $value) {
        if ($alias == 'conditions') {
            $this->options[$domain][$alias] = $value;
        } else {
            $this->options[$domain][$alias]['option_name'] = $value;
            $this->options[$domain][$alias]['option_value'] = get_option($value);
        }
    }

    public function get_option($domain, $alias) {
        return $this->options[$domain][$alias]['option_value'];
    }

    public function get_option_name($domain, $alias) {
        return $this->options[$domain][$alias]['option_name'];
    }

    public function get_conditions($domain) {
        return $this->options[$domain]['conditions'];
    }
}

$wpenq = new WP_Enqueue_Plugin();

/* add menu and settings */
include_once('settings.php');

/* callback functions with content */
include_once('callbacks.php');

/* load scripts and styles */
include_once('load.php');

/* helper class */
include_once('helper.php');

/* enqueue plugin assets */
include_once('assets.php');