<?php
declare(strict_types = 1);

namespace App\Handlers;

use App\Exceptions\InvalidParameterException;
use Illuminate\Database\Eloquent\Collection;
use App\BlogPost;

class BlogHandler
{
    public function getPostList(bool $onlyPublished): Collection
    {
        $post = $onlyPublished
            ? BlogPost::where('status', '=', BlogPost::STATUS_PUBLISHED)
            : BlogPost::where('status', '<>', BlogPost::STATUS_DELETED);

        return $post
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPostByTitle(string $title): ?BlogPost
    {
        /** @var Collection $posts */
        $posts = BlogPost::where('title', '=', $title)
            ->get();

        return $posts->isEmpty() ? null : $posts->get(0);
    }

    public function getPostById(string $postId): ?BlogPost
    {
        return BlogPost::find($postId);
    }

    public function createPost(string $title, string $body, string $status, string $lead)
    {
        $this->validateStatus($status);

        $post = new BlogPost();

        $post->title  = $title;
        $post->body   = $body;
        $post->status = $status;
        $post->lead   = $lead;

        $post->save();
    }

    public function updatePost(string $postId, string $title, string $body, string $status, string $lead)
    {
        $post = $this->getPostById($postId);

        if (empty($post)) {
            throw new InvalidParameterException('Blog Post "' . $postId . '" does not exist');
        }

        $post->title  = $title;
        $post->body   = $body;
        $post->status = $status;
        $post->lead   = $lead;

        $post->save();
    }

    public function deletePost(string $postId)
    {
        $post = BlogPost::find($postId);

        if (!empty($post)) {
            $post->delete();
        }
    }

    public function setStatusPost(string $postId, string $status)
    {
        $this->validateStatus($status);

        $post = BlogPost::find($postId);

        if (!empty($post)) {
            $post->status = $status;
            $post->save();
        }
    }

    protected function validateStatus(string $status)
    {
        if (!in_array($status, BlogPost::getValidStatuses())) {
            throw new InvalidParameterException('Invalid status given: ' . $status);
        }
    }
}
