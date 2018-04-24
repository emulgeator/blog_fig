<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Handlers\BlogHandler;
use App\BlogPost;
use App\Rules\ExistentBlogPostId;
use App\Rules\UniqueBlogPostTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /** @var BlogHandler */
    protected $blogHandler;

    public function __construct(BlogHandler $blogHandler)
    {
        $this->middleware('auth');
        $this->blogHandler = $blogHandler;
    }

    public function createPost()
    {
        return view('blog.createOrEditPost');
    }

    public function editPost(string $postId)
    {
        $post = $this->blogHandler->getPostById($postId);

        if (empty($post)) {
            abort(404);
        }

        return view(
            'blog.createOrEditPost',
            [
                'post' => $post
            ]
        );
    }

    public function savePost(Request $request)
    {
        $postId  = (string)$request->get('postId');
        $title   = (string)$request->get('title');
        $body    = (string)$request->get('body');
        $publish = (bool)$request->get('publish');
        $lead    = (string)$request->get('lead');;
        $status  = $publish ? BlogPost::STATUS_PUBLISHED : BlogPost::STATUS_NEW;
        $lead    = empty($lead) ? mb_substr($body, 0, 255) . ' ...' : $lead;

        $validationRules = [
            'postId' => [new ExistentBlogPostId($this->blogHandler)],
            'title'  => ['required', 'max:255', new UniqueBlogPostTitle($postId, $this->blogHandler)],
            'body'   => 'required'
        ];

        $validationMessages = [
            'body.required' => 'The :attribute field is required',
        ];

        $this->validate($request, $validationRules, $validationMessages);

        if (empty($postId)) {
            $this->blogHandler->createPost($title, $body, $status, $lead);
        }
        else {
            $this->blogHandler->updatePost($postId, $title, $body, $status, $lead);
        }

        return Redirect::back()->withInput(Input::toArray());
    }


    public function deletePost(string $postId)
    {
        $this->blogHandler->deletePost($postId);
    }

    public function publishPost(string $postId)
    {
        $this->blogHandler->setStatusPost($postId, BlogPost::STATUS_PUBLISHED);
    }

    public function unPublishPost(string $postId)
    {
        $this->blogHandler->setStatusPost($postId, BlogPost::STATUS_NEW);
    }
}
