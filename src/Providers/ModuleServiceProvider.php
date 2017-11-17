<?php

namespace Btybug\FrontSite\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'manage');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'manage');

        $tubs = [
            'manage_settings' => [
                [
                    'title' => 'General',
                    'url' => '/admin/front-site/settings',
                ],
                [
                    'title' => 'Frontend',
                    'url' => '/admin/front-site/settings/frontend',
                ],
                [
                    'title' => 'Notifications',
                    'url' => '/admin/front-site/settings/notifications',
                ],
                [
                    'title' => 'URL menger',
                    'url' => '/admin/front-site/settings/url-menger',
                ],
                [
                    'title' => 'Admin Emails',
                    'url' => '/admin/front-site/settings/adminemails',
                ],
                [
                    'title' => 'Api settings',
                    'url' => '/admin/front-site/settings/api-settings',
                ],
                [
                    'title' => 'Language',
                    'url' => '/admin/front-site/settings/lang',
                ]
            ],
            'frontend_manage' => [

                [
                    'title' => 'Pages',
                    'url' => '/admin/front-site/structure/front-pages',
                ],
                [
                    'title' => 'Menus',
                    'url' => '/admin/front-site/structure/menus',
                ],
                [
                    'title' => 'Classify',
                    'url' => '/admin/front-site/structure/classify',
                ],
                [
                    'title' => 'Filters',
                    'url' => '/admin/front-site/structure/filters',
                ],
                [
                    'title' => 'Hooks',
                    'url' => '/admin/front-site/frontend/hooks',
                ]
            ],
            'page_edit' => [
                [
                    'title' => 'Settings',
                    'url' => '/admin/front-site/frontend/pages/settings/{id}',
                ], [
                    'title' => 'General',
                    'url' => '/admin/front-site/frontend/pages/general/{id}',
                ],
            ],
            'manage_emails' => [
                [
                    'title' => 'Emails',
                    'url' => '/admin/front-site/emails/{id}',
                ], [
                    'title' => 'Settings',
                    'url' => '/admin/front-site/emails/settings',
                ],
            ]
        ];
        \Eventy::action('my.tab', $tubs);
        
      //  \Btybug\btybug\Models\Routes::registerPages('sahak.avatar/manage');

    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }
}
