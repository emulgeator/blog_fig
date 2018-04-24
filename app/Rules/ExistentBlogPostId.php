<?php

namespace App\Rules;

use App\Handlers\BlogHandler;
use Illuminate\Contracts\Validation\Rule;

class ExistentBlogPostId implements Rule
{
    /** @var BlogHandler  */
    protected $blogHandler;

    public function __construct(BlogHandler $blogHandler)
    {
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
        $post = $this->blogHandler->getPostById($value);

        return !empty($post);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The blog post does not exist';
    }
}
