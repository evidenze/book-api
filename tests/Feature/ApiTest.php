<?php

namespace Tests\Feature;

use App\Models\BooksModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_books()
    {
        $response = $this->get('/api/v1/books');

        $response->assertStatus(200);
    }

    public function test_create_books()
    {
        $response = $this->post('/api/v1/books', [
            'name'            => 'The Loard',
            'isbn'            => '123456',
            'authors'         => 'Essien Ekanem',
            'country'         => 'Nigeria',
            'number_of_pages' => '123',
            'publisher'       => 'Essien Ekanem',
            'release_date'    => '2022-02-02'
        ]);

        $response->assertStatus(201);
    }

    public function test_get_single_book()
    {
        $book = BooksModel::factory()->create();
        $response = $this->get('/api/v1/books/'.$book->id);

        $response->assertStatus(200);
    }

    public function test_update_books()
    {
        $book = BooksModel::factory()->create();

        $response = $this->patch('/api/v1/books/'.$book->id, [
            'name'            => 'The Loard',
            'isbn'            => '123456',
            'authors'         => 'Essien Ekanem',
            'country'         => 'Nigeria',
            'number_of_pages' => '123',
            'publisher'       => 'Essien Ekanem',
            'release_date'    => '2022-02-02'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_book()
    {
        $book = BooksModel::factory()->create();

        $response = $this->delete('/api/v1/books/'.$book->id);

        $response->assertStatus(200);
    }

    public function test_get_external_books()
    {
        $response = $this->get('/api/external-books');

        $response->assertStatus(200);
    }
}
