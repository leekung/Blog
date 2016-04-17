<?php namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Blog\Events\Handlers\CreateMetaAllLocale;
use Modules\Blog\Events\Handlers\DeleteMetaAllLocale;
use Modules\Blog\Events\Handlers\CreateTagAllLocale;
use Modules\Blog\Events\PostWasCreated;
use Modules\Blog\Events\PostWasUpdated;
use Modules\Blog\Events\PostWasDeleted;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostWasCreated::class => [
            CreateTagAllLocale::class,
            CreateMetaAllLocale::class,
        ],
        PostWasUpdated::class => [
            CreateTagAllLocale::class,
            CreateMetaAllLocale::class,
        ],
        PostWasDeleted::class => [
            DeleteMetaAllLocale::class,
        ],
    ];
}
