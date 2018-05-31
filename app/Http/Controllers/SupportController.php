<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SupportController extends Controller
{

    public function create()
    {

        return view('pages.contacts');

    }

    public function store()
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'question' => 'required',
            'verification' => 'required|in:5, five'
        ]);

        Mail::to(config('laracasts.supportEmail'))->send(
            new SupportTicket(request('email'), request('question'))
        );

        flash()->overlay(
            'Message sent',
            'Jeffry wil get back to you as soon as possible'
        );

        return redirect('/');

    }

}
