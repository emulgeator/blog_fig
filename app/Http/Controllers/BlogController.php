<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Handlers\BlogHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    /** @var BlogHandler  */
    protected $blogHandler;

    protected $isLoggedIn;

    public function __construct(BlogHandler $blogHandler)
    {
        $this->blogHandler = $blogHandler;

        $this->middleware(function ($request, $next) {
            $this->isLoggedIn = Auth::check();
            return $next($request);
        });

    }

    public function listPosts()
    {
        $onlyPublished = !$this->isLoggedIn;
        $posts         = $this->blogHandler->getPostList($onlyPublished);

        return view(
            'blog.listPosts',
            [
                'posts' => $posts,
            ]
        );
    }

    public function getPost(string $postId)
    {
        $post = $this->blogHandler->getPostById($postId);

        if (empty($post)) {
            return Redirect::intended('/');
        }

        return view(
            'blog.getPost',
            [
                'post' => $post
            ]
        );
    }
}
