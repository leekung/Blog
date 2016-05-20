<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => config('asgard.blog.config.route-prefix')], function (Router $router) {
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
    $router->get(config('asgard.blog.config.route-posts'), ['as' => $locale . '.blog', 'uses' => 'PublicController@index']);
    $router->get(config('asgard.blog.config.route-posts-slug'), ['as' => $locale . '.blog.slug', 'uses' => 'PublicController@show']);
});
