<?php namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Blog\Events\Handlers\CreateTagAllLocale;
use Modules\Blog\Events\PostWasCreated;
use Modules\Blog\Events\UserWasUpdated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostWasCreated::class => [
            CreateTagAllLocale::class,
        ],
        UserWasUpdated::class => [
            CreateTagAllLocale::class,
        ],
    ];
}
