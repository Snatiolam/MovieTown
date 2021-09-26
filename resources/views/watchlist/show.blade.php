@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')

    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header text-center h1">
                <h1>{{ $data['watchlist']->getName() }}</h1>
                <h5>{{ $data['watchlist']->getDescription() }}</h5>
            </div>
            <!--<div class="card-header h1 text-center">{{ $data['watchlist']->getName() }}</div>-->
            <div class="card-body">
                @if ($data['watchlist']->movies->count() === 0)
                    <p class="card-text text-center">Your watchlist do not contain any movie - Go on and create an epic
                        one!!!</p>
                @else

                    <div class="row row-cols-3 row-cols-md-3 justify-content-center">

                        @foreach ($data['watchlist']->movies as $movie)
                            <div class="col mb-4">
                                <div class="card text-center h-100" style="width: 18rem;">

                                    <img src="{{ URL::asset('storage/' . $movie->getId() . '.png') }}"
                                        class="card-img-top text-center img-thumbnail">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">
                                            <a
                                                href="{{ route('movie.show', ['id' => $movie->getId()]) }}">{{ $movie->getTitle() }}</a>
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $movie->getPlot() }}</h6>
                                        <div class="mt-auto" >
                                            <form
                                                action="{{ route('watchlist.removeMovie', ['id' => $movie->getId()]) }} "
                                                method="post">
                                                @csrf

                                                <input type="hidden" name="watchlist_id"
                                                    value="{{ $data['watchlist']->getId() }}">
                                                <input class="btn btn-danger" type="submit" value="Remove">
                                            </form>
                                        </div>
                                        <!-- <a href="#" class="card-link">Delete</a> -->
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="text-center">
                    <a class="btn btn-primary card-link mt-4" href="{{ route('movie.list') }}" role="button">
                        Add movies
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
