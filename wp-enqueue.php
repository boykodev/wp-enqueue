<?php

/*
Plugin Name: WP Enqueue
Description: WordPress plugin to enqueue scripts and styles.
Version: 1.0.0
Author: Serge Boyko
Author URI: http://www.boykodev.com
*/

/* helper class */
include_once('helper.php');

class WP_Enqueue_Plugin {

    private $options = array();
    private $option_map = array();

    public function __construct() {
        $this->set_options();
        $this->set_option_map();
    }

    private function set_options() {
        $options = array(
            'scripts' => array(
                'path' => 'wpenq_scripts_path',
                'cond' => 'wpenq_scripts_cond',
                'conditions' => array(
                    'head', 'footer', 'admin', 'home', 'page', 'single', 'category', 'archive'
                )
            ),
            'styles' => array(
                'path' => 'wpenq_styles_path',
                'cond' => 'wpenq_styles_cond',
                'conditions' => array(
                    'head', 'admin', 'home', 'single', 'page', 'category', 'archive'
                )
            )
        );

        foreach ((array)$options as $domain => $option) {
            foreach ((array)$option as $alias => $value) {
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

    private function set_option_map() {
        $domains = array('scripts', 'styles');

        foreach ((array)$domains as $domain) {
            if (!empty($this->get_option($domain, 'path') &&
                !empty($this->get_option($domain, 'cond')))
            ) {
                $this->option_map[$domain] = WP_Enqueue_Helper::array_map_duplicates(
                    $this->get_option($domain, 'path'), $this->get_option($domain, 'cond')
                );
            }
        }
    }

    public function get_option_map($domain) {
        return WP_Enqueue_Helper::isset_array(
            $this->option_map, $domain, array()
        );
    }

    public function get_option($domain, $alias) {
        return WP_Enqueue_Helper::isset_array(
            $this->options, array($domain, $alias, 'option_value'), array()
        );
    }

    public function get_option_name($domain, $alias) {
        return WP_Enqueue_Helper::isset_array(
            $this->options, array($domain, $alias, 'option_name'), ''
        );
    }

    public function get_conditions($domain) {
        return WP_Enqueue_Helper::isset_array(
            $this->options, array($domain, 'conditions'), array()
        );
    }
}

$wpenq = new WP_Enqueue_Plugin();

/* add menu and settings */
include_once('settings.php');

/* enqueue scripts and styles */
include_once('enqueue.php');