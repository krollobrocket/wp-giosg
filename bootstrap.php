<?php
/**
 * Plugin Name: WP Giosg
 * Plugin URI: https://wordpress.org/plugins/wp-giosg/
 * Description: Integrates giosg with WordPress.
 * Version: 2.1.0
 * Requires at least: 3.1.0
 * Requires PHP: 7.4
 * Author: Cyclonecode
 * Author URI: https://stackoverflow.com/users/1047662/cyclonecode?tab=profile
 * Copyright: Cyclonecode
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-giosg
 * Domain Path: /languages
 *
 * @package wp-giosg
 * @author Cyclonecode
 */

namespace WPGiosg;

require_once __DIR__ . '/vendor/autoload.php';

use WPGiosg\Adapter\WoocommerceStoreAdapter;
use WPGiosg\Plugin\DI\Container;
use WPGiosg\Plugin\Settings\Settings;

function get_giosg_container()
{
    return $GLOBALS['giosg_container'];
}

$GLOBALS['giosg_container'] = $container = new Container();
$container['settings'] = function (Container $container) {
    return new Settings(Plugin::SETTINGS_NAME);
};
$container['plugin'] = function (Container $container) {
    return new Plugin($container['settings']);
};
$container['adapter'] = function (Container $container) {
    return new WoocommerceStoreAdapter();
};

add_action(
    'after_setup_theme',
    function () {
        get_giosg_container()['plugin'];
    }
);

register_activation_hook(__FILE__, Plugin::class . '::activate');
register_uninstall_hook(__FILE__, Plugin::class . '::delete');
