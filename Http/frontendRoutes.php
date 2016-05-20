<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'products'], function (Router $router) {
    $router->bind('category', function ($slug) {
        $category = app('Modules\Blog\Repositories\CategoryRepository')->findBySlug($slug);
        if (!$category) {
           abort(404);
        }
        return $category;
    });

    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
    $router->get('', ['as' => $locale . '.blog', 'uses' => 'PublicController@index']);
    $router->get('{category}', ['as' => $locale . '.blog.category', 'uses' => 'PublicController@category']);
    $router->get('{category}/{slug}', ['as' => $locale . '.blog.slug', 'uses' => 'PublicController@show']);
});

//Add Favorite
$router->post('favorite', ['as' => 'favorite.save', 'uses' => 'PublicController@favorite']);
