<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\MailTracking;
use Illuminate\Support\Facades\Mail;


class ExampleTest extends TestCase
{

    use MailTracking;


    public function testBasicTest()
    {

        Mail::raw('Hello world', function ($message) {

            $message->to('foo@bar.com');
            $message->from('bar@foo.com');

        });


        $this->seeEmailWasSent()
             ->seeEmailEquals('Hello world')
             ->seeEmailContains('Hello')
             ->seeEmailsSent(2)
             ->seeEmailTo('foo@bar.com')
             ->seeEmailFrom('bar@foo.com');
    }

}