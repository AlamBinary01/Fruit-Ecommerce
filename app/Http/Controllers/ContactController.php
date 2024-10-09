<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first(); 
        return view('admin.modules.contactus.index', compact('contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        Log::info('Request Data:', $request->all());
        Contact::updateOrCreate(
            ['id' => 1],
            ['content' => $request->input('content')]
        );

        return redirect()->back()->with('success', 'Contact content saved successfully!');
    }
}

