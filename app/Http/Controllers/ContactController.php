<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
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

        try {
            Mail::raw(
                "Name: ".$request->name."\nEmail: ".$request->email."\nSubject: ".$request->subject."\nMessage: ".$request->message,
                function ($mail) {
                    $mail->to("omshanti.amd@gmail.com")
                         ->subject("New Contact Message");
                }
            );
        } catch (\Throwable $e) {
            Log::warning('Contact email failed to send.', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            return back()->with('success','Message saved successfully. Email could not be delivered from this server, so check MAIL_* settings on Render/Railway.');
        }

        return back()->with('success','Message Sent Successfully');

    }
}
