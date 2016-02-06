<?php
/*
Plugin Name: WP Enqueue
Description: WordPress plugin to enqueue scripts and styles.
Version: 1.0.0
Author: Serge Boyko
Author URI: http://www.boykodev.com
*/

/* add menu and settings */
include_once('settings.php');

/* callback functions with content */
include_once('callbacks.php');

/* load scripts and styles */
include_once('load.php');

/* scan directories for scripts and styles */
include_once('scan_for_files.php');