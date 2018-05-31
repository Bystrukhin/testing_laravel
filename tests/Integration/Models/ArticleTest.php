<?php

namespace Tests\Integration\Models;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;


    function testFetchTrendingArticles()
    {

        factory(Article::class, 2)->create();
        factory(Article::class)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        $articles = Article::trending();

        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3, $articles);

    }



}