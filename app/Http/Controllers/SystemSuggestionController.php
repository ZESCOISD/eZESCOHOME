<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuggestionBox;
use Illuminate\Support\Facades\Mail;

class SystemSuggestionController extends Controller
{
    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required|string',
            'system_name' => 'required|string',
            'suggestion' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'department' => 'required|string',
        ]);


        // Insert data into the database
        SuggestionBox::create($validatedData);

        $this->recipientEmails[] = 'nshubart@zesco.co.zm';
        // $this->recipientEmails[] = 'isd@zesco.co.zm';

        Mail::send([], [], function ($message) use ($validatedData) {
            $message->setTo($this->recipientEmails)
                ->setSubject($validatedData['subject']   .' | Proposed System : '.$validatedData['system_name'] )
                ->setBody($validatedData['suggestion'])
                ->setFrom($validatedData['email']);
        });


        return redirect()->back()->with('success', 'Your suggestion has been submitted. Thank you!');
    }
}
