<?php

namespace Yuanrang\LaravelShop\Wap\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class MemberServiceProviders extends ServiceProvider
{
    //member组件需要注入的中间件
    protected $routeMiddleware = [
        'wechat-oauth' => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class,
    ];

    protected $middlewareGroups = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        注册组件路由
        $this->registerRoutes();

        // 怎么加载config配置文件
        $this->mergeConfigFrom(__DIR__ . '/../Config/member.php', "wap.member");

//        根据配置文件去加载路由中间件文件
        $this->registerRouteMiddleware();

        $this->registerPublishing();
        $this->loadMigrationsFrom(__DIR__. '/../Database/migrations');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMemberAuthConfig();
        $this->loadViewsFrom(
            __DIR__ . '/../Resources/Views', 'view'
        );
    }

    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            //                  [当前组件的配置文件路径 =》 这个配置复制那个目录] , 文件标识
            // 1. 不填就是默认的地址 config_path 的路径 发布配置文件名不会改变
            // 2. 不带后缀就是一个文件夹
            // 3. 如果是一个后缀就是一个文件
            $this->publishes([__DIR__.'/../Config' => config_path('wap')], 'laravel-shop-wap-member-config');
        }
    }

    protected function loadMigrationsFrom($path)
    {
        if ($this->app->runningInConsole()) {
            $this->callAfterResolving('migrator', function ($migrator) use ($path) {
                $migrator->path($path);
            });
        }
    }

    protected function loadMemberAuthConfig()
    {
        // Arr 基础操方法封装
        // 这个数组合并之后，一定要再此保持laravel项目中
//        config(Arr::dot(config('wap.member.official_account', []), 'wechat.official_account.'));
        config(Arr::dot(config('wap.member.auth', []), 'auth.'));
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }

    protected function routeConfiguration()
    {
        return [
//            定义路由的命名空间
            'namespace' => 'Yuanrang\LaravelShop\Wap\Member\Http\Controllers',
//            前缀
            'prefix' => 'wap/member',
//            中间件
            'middleware' => 'web'
        ];
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        });
    }


}
