<?php
/**
 * Created by PhpStorm.
 * User: bc021
 * Date: 17-6-12
 * Time: 下午6:09
 */

namespace Notadd\Slide;

use Illuminate\Events\Dispatcher;
use Notadd\Slide\Listeners\CsrfTokenRegister;
use Notadd\Slide\Listeners\RouteRegister;
use Notadd\Content\Models\Article;
use Notadd\Content\Models\Page;
use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;

/**
 * Class Extension.
 */
class Extension extends AbstractExtension
{
    /**
     * Boot provider.
     */
    public function boot()
    {
        $this->app->make(Dispatcher::class)->subscribe(CsrfTokenRegister::class);
        $this->app->make(Dispatcher::class)->subscribe(RouteRegister::class);
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'slide');
        $this->publishes([
            realpath(__DIR__ . '/../resources/mixes/administration/dist/assets/extensions/slide') => public_path('assets/extensions/baidu-push'),
        ], 'public');
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../databases/migrations'));

        class_exists(Article::class) && Article::observe(ArticleObserver::class);
        class_exists(Page::class) && Page::observe(PageObserver::class);
    }

    /**
     * Description of extension
     *
     * @return string
     */
    public static function description()
    {
        return 'Notadd 幻灯片插件。';
    }

    /**
     * Installer for extension.
     *
     * @return \Closure
     */
    public static function install()
    {
        return function () {
            return true;
        };
    }

    /**
     * Name of extension.
     *
     * @return string
     */
    public static function name()
    {
        return '幻灯片插件';
    }

    /**
     * Get script of extension.
     *
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function script()
    {
        return asset('assets/extensions/slide/js/extension.min.js');
    }

    /**
     * Get stylesheet of extension.
     *
     * @return array
     */
    public static function stylesheet()
    {
        return [];
    }

    /**
     * Uninstall for extension.
     *
     * @return \Closure
     */
    public static function uninstall()
    {
        return function () {
            return true;
        };
    }

    /**
     * Version of extension.
     *
     * @return string
     */
    public static function version()
    {
        return '0.1.0';
    }
}