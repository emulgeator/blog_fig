<?php
declare(strict_types = 1);

namespace Tests\Unit\App\Rules\UniqueBlogPostTitle;

use App\BlogPost;
use App\Rules\UniqueBlogPostTitle;
use Mockery;
use Tests\TestCase;

abstract class TestAbstract extends TestCase
{
    /** @var \Mockery\MockInterface */
    protected $blogHandler;

    protected function setUp()
    {
        $this->blogHandler = Mockery::mock('\App\Handlers\BlogHandler');
    }

    protected function getUniqueBlogPostTitleObject(string $postId)
    {
        return new UniqueBlogPostTitle($postId, $this->blogHandler);
    }

    protected function expectGetBlogPostByTitle(string $title, ?BlogPost $expectedResult)
    {
        $this->blogHandler
            ->shouldReceive('getPostByTitle')
            ->once()
            ->with($title)
            ->andReturn($expectedResult);
    }
}

