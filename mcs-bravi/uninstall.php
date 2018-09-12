<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
  die();

define( 'MCS_BRAVI_FILE', __FILE__ );
define( 'MCS_BRAVI_DIR', plugin_dir_path( __FILE__ ) );

include dirname(__FILE__) . '/../../../wp-config.php';

require_once("vendor/autoload.php");

global $wpdb;

$tableFavorite = $wpdb->prefix . \Mcs\Bravi\ValueObject\SettingApi::TABLE_FAVORITE;
$tableSettings = $wpdb->prefix . \Mcs\Bravi\ValueObject\SettingApi::TABLE_SETTINGS;

$wpdb->query("DROP TABLE " . $tableFavorite);
$wpdb->query("DROP TABLE " . $tableSettings);