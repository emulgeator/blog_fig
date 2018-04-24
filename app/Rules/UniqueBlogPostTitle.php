<?php

namespace App\Rules;

use App\Handlers\BlogHandler;
use Illuminate\Contracts\Validation\Rule;

class UniqueBlogPostTitle implements Rule
{
    /** @var BlogHandler  */
    protected $blogHandler;

    /** @var string */
    protected $postId;

    public function __construct(string $postId, BlogHandler $blogHandler)
    {
        $this->postId      = $postId;
        $this->blogHandler = $blogHandler;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $post = $this->blogHandler->getPostByTitle($value);

        if (empty($post) || $post->id == $this->postId) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A blog post with this title already exists';
    }
}
