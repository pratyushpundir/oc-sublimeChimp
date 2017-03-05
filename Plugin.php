<?php namespace SublimeArts\SublimeChimp;

use Backend;
use System\Classes\PluginBase;

/**
 * SublimeChimp Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Sublime Chimp',
            'description' => 'Create awesome MailChimp email campaigns right from your OctoberCMS site backend.',
            'author'      => 'SublimeArts',
            'icon'        => 'icon-line-chart'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'SublimeArts\SublimeChimp\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'sublimearts.sublimechimp.manage_campaigns' => [
                'tab' => 'Sublime Chimp',
                'label' => 'Manage Campaigns'
            ],
            'sublimearts.sublimechimp.manage_mailing_lists' => [
                'tab' => 'Sublime Chimp',
                'label' => 'Manage Mailing Lists'
            ],
            'sublimearts.sublimechimp.manage_templates' => [
                'tab' => 'Sublime Chimp',
                'label' => 'Manage Templates'
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'sublimechimp' => [
                'label'       => 'Sublime Chimp',
                'url'         => Backend::url('sublimearts/sublimechimp/campaigns'),
                'icon'        => 'icon-line-chart',
                'permissions' => ['sublimearts.sublimechimp.*'],
                'order'       => 500,

                'sideMenu' => [
                    'campaigns' => [
                        'label' => 'Campaigns',
                        'icon' => 'icon-envelope',
                        'url' => Backend::url('sublimearts/sublimechimp/campaigns'),
                        'permissions' => ['sublimearts.sublimechimp.*'],
                    ],
                    'mailinglists' => [
                        'label' => 'Mailing Lists',
                        'icon' => 'icon-list-ul',
                        'url' => Backend::url('sublimearts/sublimechimp/mailinglists'),
                        'permissions' => ['sublimearts.sublimechimp.*'],
                    ],
                    'templates' => [
                        'label' => 'Templates',
                        'icon' => 'icon-file-image-o',
                        'url' => Backend::url('sublimearts/sublimechimp/templates'),
                        'permissions' => ['sublimearts.sublimechimp.*'],
                    ],
                ]
            ],
        ];
    }
}
