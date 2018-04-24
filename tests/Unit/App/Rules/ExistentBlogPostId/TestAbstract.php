<?php
declare(strict_types = 1);

namespace Tests\Unit\App\Rules\ExistentBlogPostId;

use App\BlogPost;
use App\Rules\ExistentBlogPostId;
use Mockery;
use Tests\TestCase;

abstract class TestAbstract extends TestCase
{
    /** @var \Mockery\MockInterface */
    protected $blogHandler;

    /** @var  string */
    protected $postId = 'postId';

    protected function setUp()
    {
        $this->blogHandler = Mockery::mock('\App\Handlers\BlogHandler');
    }

    protected function getExistentBlogPostIdObject()
    {
        return new ExistentBlogPostId($this->blogHandler);
    }

    protected function expectGetBlogPostById(?BlogPost $expectedResult)
    {
        $this->blogHandler
            ->shouldReceive('getPostById')
            ->once()
            ->with($this->postId)
            ->andReturn($expectedResult);
    }
}

