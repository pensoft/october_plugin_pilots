<?php namespace Pensoft\Pilots;

use Backend;
use System\Classes\PluginBase;

/**
 * Pilots Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'Pilots',
            'description' => 'No description provided yet...',
            'author'      => 'Pensoft',
            'icon'        => 'icon-plane'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return [];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'pensoft.pilots.access' => [
                'tab' => 'Pilots',
                'label' => 'Manage pilots'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return [
            'pilots' => [
                'label'       => 'Pilots',
                'url'         => Backend::url('pensoft/pilots/pilots'),
                'icon'        => 'icon-plane',
                'permissions' => ['pensoft.pilots.*'],
                'order'       => 500,
            ],
        ];
    }
}
