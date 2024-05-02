@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>

    <form action="{{route('books.index')}}" method="GET" class="mb-4 flex items-center gap-2">

        <input type="text" name="title" class="input h-10" placeholder="Search by title" value="{{ request('title') }}"/>
        <button type="submit" class="btn h-10">Search</button>
        <a href="{{route('books.index')}}" class="btn h-10" style="color:red; font-weight:500">Clear</a>
        <input type="hidden" name="filter" value="{{ request('filter')}}">
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6month' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_6month' => 'Highest Rated  6 Last Month',
            ];
        @endphp

        @foreach ($filters as $key => $label )
        <a href="{{ route('books.index', [...request()->query(),'filter' => $key])}}" 
            class="{{request('filter') === $key || (request('filter') === null && $key ==='') ? 'filter-item-active' : 'filter-item'}}">
            {{ $label }}
        </a>
    
        @endforeach
    </div>

    <ul>
        {{-- books is what is comin g from the previous page --}}
        @foreach ($books as $output)
            <li class="mb-4">
                <div class="book-item">
                <div
                    class="flex flex-wrap items-center justify-between">
                    <div class="w-full flex-grow sm:w-auto">
                    <a href="{{ route('books.show', $output->id)}}" class="book-title">{{$output->title}}</a>
                    <span class="book-author">{{$output->author}}</span>
                    </div>
                    <div>
                    <div class="book-rating">
                        {{ number_format($output->reviews_avg_rating,1)}}
                        <x-star-rating :rating="$output->reviews_avg_rating" />
                    </div>
                    <div class="book-review-count">
                        out of {{ $output->reviews_count}} {{Str::plural('review', $output->reviews_count)}}
                    </div>
                    </div>
                </div>
                </div>
            </li>
            @if(!$books)
            <li class="mb-4">
                <div class="empty-book-item">
                  <p class="empty-text">No books found</p>
                  <a href="{{ route('books.index')}}" class="reset-link">Reset criteria</a>
                </div>
              </li>
            @endif
                
        @endforeach
        {{-- FOR THE PAGINATION LINKS --}}
        @if($books->count())
        <nav class="mt-4">
            {{$books->links()}}
        </nav>
        @endif
    </ul>

@endsection