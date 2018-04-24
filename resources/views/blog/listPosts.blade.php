@extends('layouts.app')

@section('title')
    Blog
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @forelse ($posts as $post)
                            <div class="mt-4 col-md-12">
                                <a href="{{ url('/post', [$post->id]) }}">
                                    {{ $post->title }}
                                </a>

                                @if (\Illuminate\Support\Facades\Auth::check())
                                    @switch($post->status)
                                        @case(\App\BlogPost::STATUS_NEW)
                                            <strong>Not Published</strong>
                                            @break

                                        @case(\App\BlogPost::STATUS_PUBLISHED)
                                            <strong>Published</strong>
                                            @break
                                    @endswitch
                                @endif

                                <div>
                                    {{ $post->lead  }}
                                </div>
                            </div>
                        @empty
                            <h3>No posts to display</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

