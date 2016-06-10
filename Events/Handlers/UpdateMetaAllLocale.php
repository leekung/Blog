<?php

namespace Modules\Blog\Events\Handlers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Blog\Entities\Post;

/**
 * Class UpdateMetaAllLocale
 * @package Modules\Blog\Events\Handlers
 */
class UpdateMetaAllLocale
{
    /**
     * @param PostWasUpdated $event
     */
    public function handle($event)
    {
        $locales = LaravelLocalization::getSupportedLocales();
        $model = Post::find($event->postId);

        foreach ($locales as $locale => $language) {
            $model->setLocale($locale);
            if (isset($event->data[$locale]['metable'])) {
                foreach ($event->data[$locale]['metable'] as $source => $meta) {
                    foreach ($meta as $name => $content) {
                        $content = trim($content);
                        if (!empty($content)) {
                            $model->updateMeta($name, $content);
                        }
                    }
                }
            }
        }
    }
}
