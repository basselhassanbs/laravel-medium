@extends('articles.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @forelse ($articles as $article)
                <h2 class="mb-4"><u><a class="text-dark" href="/articles/{{ $article->id }}">{{$article->title}}</a></u></h2>
                
                <p>
                    <img src="{{ asset('/files/' . json_decode($article->filenames)[0]) }}" style="height:120px; width:200px" alt="">
                    {{-- <img src="{{ asset('/files/' . $article->filenames )  }}" style="height:120px; width:200px" alt=""> --}}
                </p>
                {{$article->excerpt}}
                <br><br><hr>
                @empty
                    <h2>No relevent articles yet.</h2>
                @endforelse
            </div>
        </div>
        
    </div>
@endsection