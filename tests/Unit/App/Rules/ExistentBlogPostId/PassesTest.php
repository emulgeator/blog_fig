<?php
declare(strict_types = 1);

namespace Tests\Unit\App\Rules\ExistentBlogPostId;

use App\BlogPost;

class PassesTest extends TestAbstract
{
    /** @var string */
    protected $attribute = 'attr';

    public function testWhenPostDoesNotExist_shouldReturnFalse()
    {
        $this->expectGetBlogPostById(null);

        $result = $this->getExistentBlogPostIdObject()->passes($this->attribute, $this->postId);

        $this->assertFalse($result);
    }

    public function testWhenPostExists_shouldReturnTrue()
    {
        $this->expectGetBlogPostById($this->getBlogPost());

        $result = $this->getExistentBlogPostIdObject()->passes($this->attribute, $this->postId);

        $this->assertTrue($result);
    }

    protected function getBlogPost(): BlogPost
    {
        $blogPost = new BlogPost();
        $blogPost->id = $this->postId;

        return $blogPost;
    }
}
