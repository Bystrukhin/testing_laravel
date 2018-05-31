<?php


function createPost($attributes = []) {

    factory(App\Post::class)->create($attributes);

}