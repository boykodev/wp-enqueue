<?php

/*
Plugin Name: WP Enqueue
Plugin URI: https://github.com/boykodev/wp-enqueue
Description: This plugin makes it dramatically easier to enqueue scripts and styles. Manage it from a separate option menu page. You can enqueue in `head` or in `footer`, enqueue in admin dashboard, enqueue only for homepage, enqueue for all pages/posts/categories/archives or enqueue for a specific page/post/category. Choose from any script/style in theme folder or from a specific plugin folder. It has never been so easy before!
Version: 2.0
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
*/

class WP_Enqueue_Plugin {

    private static $instance = null;

    private function __construct() {
        // TODO constructor
    }

    static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    static function install() {
        // TODO plugin install code
        // do not generate any output here
    }

    static function uninstall() {
        // TODO plugin uninstall code
        // do not generate any output here
    }
}

register_activation_hook(__FILE__, array('WP_Enqueue_Plugin', 'install'));
register_deactivation_hook(__FILE__, array('WP_Enqueue_Plugin', 'uninstall'));