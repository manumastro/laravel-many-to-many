@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    @if ($post->category)
      <h3>Categoria: {{ $post->category->name }}</h3>
    @endif

    @if ($post->tags)
      @foreach ($post->tags as $tag)
        <h4>Tags: {{ $tag->name }}</h4>
      @endforeach
    @endif

    <p>
      {{ $post->content }}
    </p>
    <a class="btn btn-primary " href="{{ route('admin.posts.index') }}">Torna All'elenco</a>
</div>
@endsection
