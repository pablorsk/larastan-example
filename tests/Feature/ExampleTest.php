<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testBasicQuery()
    {
        Book::where('id', '>', 1)->firstOrFail()->id;
        Book::where('id', '>', 1)->first();
        Book::where('id', '>', 1)->first();
        Book::query()->where('id', '>', 1)->first();

        self::assertTrue(true);
    }

    public function testBasicQueryWithProblems()
    {
        Book::where('id', '>', 1)->firstOrFail()->no_exist_attribute;
        Book::where('id', '>', 1)->firstOrFail()->no_exist_attribute->b;

        self::assertTrue(true);
    }
}
