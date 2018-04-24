@extends('layouts.app')

@section('title')
    New post
@endsection

@php
if (empty($post)) {
    $postId      = '';
    $title       = old('title');
    $lead        = old('lead');
    $body        = old('body');
    $isPublished = old('publish');
}
else {
    $postId      = $post->id;
    $title       = $post->title;
    $lead        = $post->lead;
    $body        = $post->body;
    $isPublished = $post->status == \App\BlogPost::STATUS_PUBLISHED ? 1 : 0;
}
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Create post</h1>
                <div class="panel panel-default">
                    <form method="post" action="{{ url('/save') }}" id="editForm">
                        {{ csrf_field() }}

                        <input type="hidden" name="postId" value="{{ $postId }}"/>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <input type="text" id="title" class="form-control" name="title" value="{{ $title }}" required/>
                        </div>

                        <div class="form-group">
                            <label for="lead" class="col-md-4 control-label">Lead text</label>
                            <textarea id="body" class="form-control" name="body" rows="4">{{ $lead }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">Post Body</label>
                            <textarea id="body" class="form-control" name="body" rows="15" required>{{ $body }}</textarea>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="publish" @if ($isPublished) checked="checked" @endif> Publish right away
                            </label>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="save" value="Save" class="btn btn-lg btn-success" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
