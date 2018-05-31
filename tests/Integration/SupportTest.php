<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class SupportTest extends TestCase
{

    function testSendsSupportEmail()
    {

        Mail::fake();

        $this->post('/', $fields = $this->validFields());

        Mail::assertQueued(SupportTicket::class, function ($mail) use ($fields) {
                return $mail->sender == $fields['email'];
        });
    }

    function testRequiresName()
    {

        $this->contact(['name' => ''])
            ->assertionSessionHasErrors('name');

    }

    function testRequiresValidEmail()
    {

        $this->contact(['email' => 'not-valid-email'])
            ->assertionSessionHasErrors('email');

    }

    function testRequiresQuestion()
    {

        $this->contact(['question' => ''])
            ->assertionSessionHasErrors('question');

    }

    function testRequiresVerification()
    {

        $this->contact(['verification' => ''])
            ->assertionSessionHasErrors('verification');

    }

    function testRequiresCorrectVerificationForQuestion() {

        $this->contact(['verification' => 0])
            ->assertionSessionHasErrors('verification');

        Mail::fake();

        $this->contact(['verification' => 5]);

        $this->contact(['verification' => 'five']);

        Mail::assertQueued(SupportTicket::class, 2);

    }

    protected function contact($attributes = [])
    {

        $this->withExceptionHandling();

        $this->post('/contacts', $fields = $this->validFields());

    }

    protected function validFields($overrides = [])
    {

        return array_merge([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'question' => 'help me',
            'verification' => 5
        ], $overrides);

    }

}