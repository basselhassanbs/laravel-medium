@extends('articles.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>{{$article->title}}</h2>

                <p>{{$article->body}}</p>

                <br><br>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                    </tr>
                    </thead>
                    <tbody>
                       <tr>
                           <td>
                            @foreach (json_decode($article->filenames) as $picture)
                            <img src="{{ asset('/files/'.$picture) }}" style="height:120px; width:200px" alt="">
                            @endforeach
                           </td>
                      </tr>
                    </tbody>
                </table>

                <p>
                    @foreach ($article->tags as $tag)
                        <a class="text-white badge badge-primary" style="font-size: 1.1em;" href="">{{ $tag->name }}</a>
                    @endforeach
                </p>
            </div>
        </div>
    </div>
@endsection