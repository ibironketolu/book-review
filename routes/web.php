<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
Route::get('/audio-duration', 'App\Http\Controllers\AudioController@getDuration');
Route::get('/', function () {
    // return view('welcome');
    return redirect('books.index');
});

Route::resource('books', BookController::class)
    ->only(['index','show']);


Route::resource('books.reviews', ReviewController::class)

->scoped(['review' => 'book'])
->only(['create', 'store']);

