<?php

namespace App\Providers;

use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewServiceProvider as DefaultViewServiceProvider;

/**
 * Automatically prepend an additional view paths based on a config variable
 */
class ViewServiceProvider extends DefaultViewServiceProvider
{
    
    /**
     * Register the view finder implementation and add the paths to theme view files
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            
            $paths = $app['config']['view.paths'];
       
            array_unshift($paths, base_path() . '/resources/site-views/' . $app['config']['sites']['key']);

            return new FileViewFinder($app['files'], $paths);
        });
    }

}