<?php

namespace Jeffreyvr\FlareForWp;

use Jeffreyvr\FlareForWp\Admin\Settings;
use Spatie\FlareClient\Flare;

class FlareForWp
{
    /**
     * @var FlareForWp
     */
    private static $instance;

    public static function instance(): self
    {
        if (! isset(self::$instance) && ! (self::$instance instanceof FlareForWp)) {
            self::$instance = new FlareForWp();

            self::$instance->boot();
        }

        return self::$instance;
    }

    private function boot()
    {
        add_action('plugins_loaded', [$this, 'loadTextdomain']);
        add_action('plugins_loaded', [$this, 'setupFlare'], -1);

        new Settings();
    }

    public function setupFlare(): void
    {
        $apiKey = Settings::getApiKey();

        if ($apiKey) {
            $flare = Flare::make($apiKey)
                ->registerFlareHandlers();
        }
    }

    public function loadTextdomain(): void
    {
        load_plugin_textdomain(
            'flareforwp',
            false,
            dirname(plugin_basename(FLAREFORWP_PLUGIN_FILE)).'/languages/'
        );
    }
}
