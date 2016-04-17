<?php

namespace Modules\Blog\Events\Handlers;

use Mcamara\LaravelLocalization\LaravelLocalization;
use Modules\Blog\Entities\TagTranslation;

class CreateTagAllLocale
{

    /**
     * @param PostWasCreated|UserWasUpdated $event
     */
    public function handle($event)
    {
        $localize = new LaravelLocalization;
        $locales = $localize->getSupportedLocales();
        $current_tags = isset($event->data['tags']) ? $event->data['tags'] : [];
        $tag_translation = new TagTranslation();

        if (!empty($current_tags)) {

            foreach ($current_tags as $post_tag_id) {
                $current_translation = $tag_translation->where('tag_id', '=', $post_tag_id)->first();
                foreach ($locales as $locale => $language) {
                    if ($locale != $current_translation->locale) {
                        $locale_translation = $tag_translation->where('tag_id', '=', $post_tag_id)->where('locale', '=', $locale)->first();
                        if (!$locale_translation) {
                            $tag_translation->create([
                                'name' => $current_translation->name,
                                'tag_id' => $current_translation->tag_id,
                                'slug' => $current_translation->slug,
                                'locale' => $locale,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
