@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="d-inline mb-4">Tutti i post</h1>
    <a class="btn btn-info d-flex align-items-center float-right mb-4" href="{{ route('admin.posts.create') }}">Crea un Post</a>
    <table class="table">
        <thead>
          
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Categoria</th>
            <td scope="col">Tags</td>
            <th scope="col">Azioni</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ empty($post->category) ? '-' : $post->category->name }}</td>
                    <td>
                      @forelse ($post->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->name }}</span>
                      @empty
                        -
                      @endforelse
                    </td>
                    <td>
                      <a class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">SHOW</a>
                      <a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>

                      <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                      class="d-inline"
                      onsubmit="return confirm('confermi l\'eliminazione di: {{ $post->title }} ?')">
                      @method('DELETE')
                      @csrf
                        <button type="submit" class="btn btn-danger">DELETE</button>
                      </form>
                      
                    </td>
                </tr>                
            @endforeach
        </tbody>
      </table>
      {{ $posts->links() }}

      <div>
        <h2>Elenco post divisi per categorie</h2>
        @foreach ($categories as $category)
          <h3>{{ $category->name }}</h3>
          <ul>
            @foreach ($category->posts as $post)
              <li><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></li>
            @endforeach
          </ul>
        @endforeach
      </div>


</div>
@endsection
