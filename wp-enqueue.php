<?php

/*
Plugin Name: WP Enqueue
Plugin URI: https://github.com/boykodev/wp-enqueue
Description: This plugin makes it dramatically easier to enqueue scripts and styles. Manage it from a separate option menu page. You can enqueue in `head` or in `footer`, enqueue in admin dashboard, enqueue only for homepage,
enqueue for all pages/posts/categories/archives or enqueue for a specific page/post/category. Choose from any script/style in theme folder or from a specific plugin folder. It has never been so easy before!
Version: 1.2.0
Author: Serge Boyko
Author URI: http://www.boykodev.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

/* helper class */
include_once('wpenq-helper.php');

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
            $path_option = $this->get_option($domain, 'path');
            $cond_option = $this->get_option($domain, 'cond');
            if (!empty($path_option) && !empty($cond_option)) {
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
include_once('wpenq-settings.php');

/* enqueue scripts and styles */
include_once('enqueue.php');