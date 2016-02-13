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

    private $index = array();
    private $options = array();
    private $option_map = array();

    public function __construct() {
        $this->set_index();
        $this->set_options();
        $this->set_option_map();

        //$this->enqueue();
    }

    private function set_index() {
        $domains = array('scripts', 'styles');

        foreach ($domains as $domain) {
            $this->index[$domain] = 0;
        }
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
                    'head', 'admin', 'IE 10', 'IE 9', 'IE 8'
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

    private function set_option_map() {
        $domains = array('scripts', 'styles');

        foreach ($domains as $domain) {
            $this->option_map[$domain] = WP_Enqueue_Helper::array_map_duplicates(
                $this->get_option($domain, 'path'), $this->get_option($domain, 'cond')
            );
        }
    }

    private function enqueue() {
        //add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend'));
        //add_action('admin_enqueue_scripts', array($this, 'enqueue_admin'));
    }

    private function add_index($domain) {
        $this->index[$domain]++;
    }

    private function get_index($domain) {
        return $this->index[$domain];
    }

    public function get_option_map($domain) {
        return $this->option_map[$domain];
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

//add_action('wp_enqueue_scripts', array($wpenq, 'enqueue_frontend'));

/* add menu and settings */
include_once('settings.php');

/* callback functions with content */
include_once('callbacks.php');

/* load scripts and styles */
include_once('load.php');

/* enqueue plugin assets */
include_once('assets.php');