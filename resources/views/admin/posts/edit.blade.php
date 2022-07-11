@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1>Stai editando: {{ $post->title }}</h1>

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul class="m-0 p-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
      value="{{ old('title', $post->title) }}">
      @error('title')
        <p class="text-danger"> {{ $message }}</p>
      @enderror
    </div>
    <div class="mb-3 d-flex flex-column">
      <label for="content" class="form-label">Contenuto</label>
      <textarea class="form-control @error('title') is-invalid @enderror" name="content" id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
      @error('content')
        <p class="text-danger"> {{ $message }} </p>
        
      @enderror
    </div>

    <div>
      <select class="form-select mb-3" name="category_id">
        <option value="">Seleziona una categoria</option>
        @foreach ($categories as $category)
          <option @if($category->id == old('category_id', $post->category->id)) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Invia</button>
  </form>
  </div>
@endsection