<?php

namespace App\Http\Controllers\SuperAdmin\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\ContactUs;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ContactUs\ContactUsRequest;


class ContactUsController extends Controller
{

    function __construct()
    {
        $this->middleware(['can:contactUs-list'], ['only' => ['index', 'show']]);
        $this->middleware(['can:contactUs-delete'], ['only' => ['destroy','trashed','restore','forceDelete']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactUs::paginate(10);
        return view('dashboard.contact_us.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        return view('dashboard.contact_us.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();
        return redirect()->route('contact-us.index')->with('success', 'Contact entry deleted successfully.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function trashed()
    {
        $contacts = ContactUs::onlyTrashed()->paginate(10);
        return view('dashboard.contact_us.deleted', compact('contacts'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $contact = ContactUs::withTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('contact-us.trashed')->with('success', 'Contact entry restored successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        $contact = ContactUs::withTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('contact-us.trashed')->with('success', 'Contact entry permanently deleted.');
    }


}
