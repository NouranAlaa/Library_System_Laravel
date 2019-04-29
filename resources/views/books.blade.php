@extends('layouts.app')

@section('content')
<div class="container">

    <!-- search bar  -->

    <div class="container">
        <div class="row">
            <form action="/search" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                        placeholder="Search Books"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search">Search </span>
                        </button>
                    </span>
                </div>
            </form>

            <div class="d-inline-flex orderPos">
                <h3 style="padding-right: 10px;"> Order By </h3>
                <div class="btn-group pull-right" data-toggle="buttons-radio">
                    <button class="btn btn-outline-primary">Rate</button>
                    <button class="btn btn-outline-info">Latest</button>
                </div>
            </div>
        </div>
    </div>

    <!-- end of search bar -->

    <hr>

    <div class="row">
        <!-- Side Bar for Categories -->
        <div class="col-md-3 left">

            <li class="list-group-item">
                <a href="#collapseA" data-toggle="collapse">
                    <a href="{{ url('/books')}}"> <span>Categories</span> </a>
                </a>
            </li>
            <ul class="list-group" id="collapseA">
                @foreach($Cates as $cats)
                <!-- display books by category -->
                <a href="{{ route('category', $cats->id) }}">
                    <li class="list-group-item lhover"></i> {{$cats->name}} </li>
                </a>
                @endforeach
            </ul>
        </div>
        <!-- end of Categories side bar  -->

        <!-- book Card -->
        @foreach ($books as $book)
        <div class="col-lg-3 col-md-6 mb-3">
            <!-- Card Narrower -->
            <div class="card card-cascade narrower">
                <!-- Title -->
                <div class="card-header d-inline-flex">
                    <h4 class="font-weight-bold">{{$book->title}}</h4>
                    <span style="margin-left: auto;"><i class="fa fa-heart fav"></i></span>
                </div>
                <!-- Card image -->
                <div class="view view-cascade overlay">
                    <!-- link to book by click image -->
                    <a href="{{ route('bookid', $book->id) }}">
                    <img class="imgg card-img-top" src="{{$book->image}}" alt="Card image cap" height="300" width="150">
                    </a>
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!-- Card content -->
                <div class="card-body card-body-cascade">
                    <!-- Author -->
                    <p class="card-text">By : {{$book->author}}</p>
                    <!-- Data -->
                    <ul class="list-unstyled list-inline rating mb-0">
                        <li class="list-inline-item"><i class="fa fa-star rateStr"> </i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item">
                            @foreach ($rates as $rate)
                                @if ($rate->book_id == $book->id)
                                    <p class="text-muted">{{$rate->rate}}</p>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                    <!-- Category -->
                    @foreach ($Cates as $cate2)
                        @if ($cate2->id == $book->cat_id)
                            <p class="aval"> <span> Cat : </span> {{$cate2->name}} </p>
                        @endif
                    @endforeach
                    <!-- Text -->
                    <p class="card-text">{{$book->description}}</p>
                    <!-- Avilability -->
                    <p class="aval"> <span> {{$book->numberOfCopies}} </span> Books Available </p>
                    <!-- Button -->
                    <a class="btnLease disable">Lease</a>
                </div>
            </div>
            <!-- Card Narrower -->
        </div>
        @endforeach
    </div>

    <!-- start pagination -->
    <hr>
    {{ $books->links() }}
    <!-- End Pagination -->
</div>
@endsection