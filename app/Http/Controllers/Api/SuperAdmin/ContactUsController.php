<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUs\ContactUsRequest;
use App\Models\SuperAdmin\ContactUs;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function store(ContactUsRequest $request)
    {
        $validated = $request->validated();

        ContactUs::create($validated);

        Mail::to(env('MAIL_USERNAME'))->send(new ContactUsMail($validated));

        return response()->json(['message' => 'Your message has been sent successfully.'], 201);
    }
}
