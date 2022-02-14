<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //由于MySQL 版本低于 5.7.7
        //需要手动配置迁移命令生成的默认字符串长度
        // Schema::defaultStringLength(191); // 目前使用的mysql是5.7.30 

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
