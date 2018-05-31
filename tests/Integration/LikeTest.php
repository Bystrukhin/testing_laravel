<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;
use App\User;

class LikeTest extends TestCase
{

    use RefreshDatabase;

    protected $post;

    public function setUp()
    {
        parent::setUp();

        $this->post = factory(Post::class)->create();

        $this->signIn();
    }

    public function testUserCanLikePost()
    {

        $this->post->like();

        $this->assertDatabaseHas('likes', [
           'user_id' => $this->user->id,
           'likeable_id' => $this->post->id,
           'likeable_type' => get_class($this->post)
        ]);

        $this->assertTrue($this->post->isLiked());

    }

    public function testUserCanUnlikePost()
    {

        $this->post->like();
        $this->post->unlike();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertFalse($this->post->isLiked());

    }

    public function testUserCanToggleLikeStatus()
    {

        $this->post->toggle();

        $this->assertTrue($this->post->isLiked());

        $this->post->toggle();

        $this->assertFalse($this->post->isLiked());

    }

    public function testPostKnowsHowManyPostsItHas() {

        $this->post->toggle();

        $this->assertEquals(1, $this->post->likesCount);

    }

}