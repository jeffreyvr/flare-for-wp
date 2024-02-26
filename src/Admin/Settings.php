<?php

namespace Jeffreyvr\FlareForWp\Admin;

use Jeffreyvr\WPSettings\WPSettings;
use Jeffreyvr\WPSimpleEncryption\WPSimpleEncryption;

class Settings
{
    private static string $encryptionKey = 'FLARE_FOR_WP_ENCRYPTION_KEY';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register']);

        add_filter('wp_settings_new_options_flare_api_key', [$this, 'encryptApiKey']);
    }

    public function register()
    {
        $settings = new WPSettings(__('Flare for WP'));

        $settings->set_menu_parent_slug('tools.php');

        $tab = $settings->add_tab(__('General', 'flareforwp'));

        $section = $tab->add_section('API');

        $section->add_option('text', [
            'name' => 'flare_api_key',
            'label' => __('API Key', 'flareforwp'),
            'type' => 'password',
        ]);

        $settings->make();
    }

    public static function encryptApiKey($value)
    {
        $wp_simple_encryption = new WPSimpleEncryption(self::$encryptionKey);

        return $wp_simple_encryption->encrypt($value);
    }

    public static function getApiKey()
    {
        $key = get_option('flare_for_wp')['flare_api_key'] ?? null;

        $wp_simple_encryption = new WPSimpleEncryption(self::$encryptionKey);

        return $wp_simple_encryption->decrypt($key);
    }
}
