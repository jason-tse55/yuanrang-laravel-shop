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
        //
//        注册组件路由
        $this->registerRoutes();

        // 怎么加载config配置文件
        $this->mergeConfigFrom(__DIR__ . '/../Config/member.php', "wap.member");

//        根据配置文件去加载路由中间件文件
        $this->registerRouteMiddleware();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMemberAuthConfig();
        //
        $this->loadViewsFrom(
            __DIR__ . '/../Resources/Views', 'view'
        );
    }

    protected function loadMemberAuthConfig()
    {
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

    private function routeConfiguration()
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

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        });
    }


}
