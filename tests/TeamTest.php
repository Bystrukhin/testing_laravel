<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Team;
use App\User;

class TeamTest extends TestCase
{
    use RefreshDatabase;


    public function testHasName()
    {

        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);

    }

    public function testCanAddMembers()
    {

        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());

    }

    public function testMaximumSize()
    {

        $team = factory(Team::class)->create(['size' => 2]);

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->expectException('Exception');

        $user3 = factory(User::class)->create();

        $team->add($user3);

    }

    public function testMaximumSizeIfManyUsersAdded()
    {

        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 3)->create();

        $this->expectException('Exception');

        $team->add($users);

    }

    public function testAddMultipleMembers()
    {

        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());

    }

    public function testRemoveMember()
    {

        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $team->remove($users[0]);

        $this->assertEquals(1, $team->count());

    }

    public function testRemoveSeveralMembers()
    {

        $team = factory(Team::class)->create(['size' => 3]);

        $users = factory(User::class, 3)->create();

        $team->add($users);

        $team->removeMany($users->slice(0, 2));

        $this->assertEquals(1, $team->count());

    }

    public function testRemoveAllMembers()
    {

        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $team->restart();

        $this->assertEquals(0, $team->count());

    }

}