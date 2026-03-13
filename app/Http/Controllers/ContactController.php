<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required'
        ]);

        // Save to database
        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message
        ]);

        // Send email
        Mail::raw(
            "Name: ".$request->name."\nEmail: ".$request->email."\nSubject: ".$request->subject."\nMessage: ".$request->message,
            function ($mail) {
                $mail->to("omshanti.amd@gmail.com")
                     ->subject("New Contact Message");
            }
        );

        return back()->with('success','Message Sent Successfully');

    }
}