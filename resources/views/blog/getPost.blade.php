@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>{{ $post->title }}</h1>

                        {{ $post->body }}
                    </div>
                </div>

                @if (\Illuminate\Support\Facades\Auth::check())
                    <div class="mt-4 col-md-12">
                        {{ csrf_field() }}

                        <button id="buttonBlogPostEdit" class="btn-success" data-url="{{ url('/edit', [$post->id]) }}">Edit</button>

                        <button id="buttonBlogPostDelete" class="btn-danger" data-url="{{ url('/delete', [$post->id]) }}">Delete</button>

                        @if ($post->status == \App\BlogPost::STATUS_NEW)
                            <button id="buttonBlogPostPublish" class="btn-info" data-url="{{ url('/publish', [$post->id]) }}">Publish</button>
                        @else
                            <button id="buttonBlogPostUnPublish" class="btn-warning" data-url="{{ url('/un-publish', [$post->id]) }}">Un Publish</button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/page/getPost.js') }}" defer></script>
