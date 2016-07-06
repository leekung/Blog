<?php namespace Modules\Blog\Events;

use Modules\Media\Contracts\DeletingMedia;

class PostWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    public $postClass;
    /**
     * @var int
     */
    public $postId;

    public function __construct($postId, $postClass)
    {
        $this->postClass = $postClass;
        $this->postId = $postId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->postId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->postClass;
    }
}
