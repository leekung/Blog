<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => config('asgard.blog.config.route-prefix')], function (Router $router) {
    $router->get(config('asgard.blog.config.route-posts'), ['as' => 'public.blog', 'uses' => 'PublicController@index']);
    $router->get(config('asgard.blog.config.route-posts-slug'), ['as' => 'public.blog.slug', 'uses' => 'PublicController@show']);
});
