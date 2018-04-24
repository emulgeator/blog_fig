<?php
declare(strict_types = 1);

namespace Tests\Unit\App\Rules\UniqueBlogPostTitle;

use App\BlogPost;

class PassesTest extends TestAbstract
{
    /** @var string */
    protected $attribute = 'attr';

    /** @var string  */
    protected $title = 'test_title';

    /** @var string  */
    protected $postId = 'postId';

    public function postIdProvider()
    {
        return [
            [$this->postId],
            ['']
        ];
    }

    /**
     * @dataProvider postIdProvider
     */
    public function testWhenPostDoesNotExist_shouldReturnTrue(string $postId)
    {
        $this->expectGetBlogPostByTitle($this->title, null);

        $result = $this->getUniqueBlogPostTitleObject($postId)->passes($this->attribute, $this->title);

        $this->assertTrue($result);
    }

    public function testWhenTitleBelongsToGivenPost_shouldReturnTrue()
    {
        $this->expectGetBlogPostByTitle($this->title, $this->getBlogPost($this->postId));

        $result = $this->getUniqueBlogPostTitleObject($this->postId)->passes($this->attribute, $this->title);

        $this->assertTrue($result);
    }

    public function testWhenTitleBelongsToAnotherPost_shouldReturnFalse()
    {
        $this->expectGetBlogPostByTitle($this->title, $this->getBlogPost('anotherPostId'));

        $result = $this->getUniqueBlogPostTitleObject($this->postId)->passes($this->attribute, $this->title);

        $this->assertFalse($result);
    }

    protected function getBlogPost($postId): BlogPost
    {
        $blogPost = new BlogPost();
        $blogPost->id    = $postId;
        $blogPost->title = $this->title;

        return $blogPost;
    }
}
