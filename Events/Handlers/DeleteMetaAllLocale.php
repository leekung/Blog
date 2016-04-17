<?php

namespace Modules\Blog\Events\Handlers;

use Modules\Blog\Entities\Post;

class DeleteMetaAllLocale
{
    /**
     * @param PostWasDeleted $event
     */
    public function handle($event)
    {
        $model = new Post();
        $model->id = $event->postId;
        $model->meta->each(function ($item, $key) {
            $item->delete();
        });
    }
}
