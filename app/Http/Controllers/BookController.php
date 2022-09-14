<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\BooksModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Return a listing of the books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = BooksModel::all();

        return response()->json([
            'status_code' => 200,
            'status'      => 'success',
            'data'        => $books 
        ], 200);
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $authors = Str::of($request->authors)->explode(',');

        $book                  = new BooksModel;
        $book->name            = $request->name;
        $book->isbn            = $request->isbn;
        $book->authors         = $authors;
        $book->country         = $request->country;
        $book->number_of_pages = $request->number_of_pages;
        $book->publisher       = $request->publisher;
        $book->release_date    = $request->release_date;
        $book->save();

        return response()->json([
            'status_code' => 201,
            'status'      => 'success',
            'data'        => [
                'book' => $book
            ]
        ], 201);
    }

    /**
     * Return the specified book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = BooksModel::find($id);

        if (!isset($book)) {
            return response()->json([
                'status_code' => 404,
                'message'     => 'Book not found'
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'status'      => 'success',
            'data'        => $book
        ], 200);
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = BooksModel::find($id);

        if (!isset($book)) {
            return response()->json([
                'status_code' => 404,
                'message'     => 'Book not found'
            ], 404);
        }

        $authors = Str::of($request->authors)->explode(',');

        $book->name            = $request->filled('name') ? $request->name: $book->name;
        $book->isbn            = $request->filled('isbn') ? $request->isbn: $book->isbn;
        $book->authors         = $request->filled('authors') ? $authors: $book->authors;
        $book->country         = $request->filled('country') ? $request->country: $book->country;
        $book->number_of_pages = $request->filled('number_of_pages') ? $request->number_of_pages: $book->number_of_pages;
        $book->publisher       = $request->filled('publisher') ? $request->publisher: $book->publisher;
        $book->release_date    = $request->filled('release_date') ? $request->release_date: $book->release_date;
        $book->save();

        return response()->json([
            'status_code' => 200,
            'status'      => 'success',
            'message'     => 'The book '.$book->name.' was updated successfully',
            'data'        => $book
        ], 200);
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = BooksModel::find($id);

        if(!isset($book)) {
            return response()->json([
                'status_code' => 404,
                'message'     => 'Book not found'
            ], 404);
        }

        $book_title = $book->name;

        $book->delete();

        return response()->json([
            'status_code' => 204,
            'status'      => 'success',
            'message'     => 'The book '.$book_title.' was deleted successfully',
            'data'        => []
        ], 200);
    }

    // Get external books
    public function fetchExternalBook(Request $request) {
        $name = $request->query('name');

        $response = Http::withOptions(['verify' => false])->get('https://www.anapioficeandfire.com/api/books', [
            'name' => $name
        ]);

        $books = $response->json();

        foreach($books as $key => $book) {
            unset($books[$key]);
            $books[$key]['name']            = $book['name'];
            $books[$key]['isbn']            = $book['isbn'];
            $books[$key]['authors']         = $book['authors'];
            $books[$key]['number_of_pages'] = $book['numberOfPages'];
            $books[$key]['publisher']       = $book['publisher'];
            $books[$key]['country']         = $book['country'];
            $books[$key]['release_date']    = date_format(date_create($book['released']), 'Y-m-d');
        }

        if($response->successful()) {
            if($response->object()) {
                return response()->json([
                    'status_code' => 200,
                    'status'      => 'success',
                    'data'        => $books
                ], 200);
            }

            return response()->json([
                'status_code' => 404,
                'status'      => 'not found',
                'data'        => $books
            ], 200);
        }

        if($response->failed()) {
            return response()->json('An error occured', 400);
        }
    }
}
