<?php

namespace App\Http\Controllers\SuperAdmin\FAQs;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\FAQ;
use App\Http\Requests\SuperAdmin\FAQs\FAQRequest;

class FAQController extends Controller
{
    function __construct()
    {
        $this->middleware(['can:faqs-list'], ['only' => ['index']]);
        $this->middleware(['can:faqs-create'], ['only' => ['create', 'store']]);
        $this->middleware(['can:faqs-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['can:faqs-delete'], ['only' => ['destroy','trashedFaqs','restore','forceDelete']]);
    }

    public function index()
    {
        $faqs = FAQ::all();
        return view('dashboard.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('dashboard.faqs.create');
    }

    public function store(FAQRequest $request)
    {
        FAQ::create($request->validated());

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(FAQ $faq)
    {
        return view('dashboard.faqs.edit', compact('faq'));
    }

    public function update(FAQRequest $request, FAQ $faq)
    {
        $faq->update($request->validated());

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ updated successfully');
    }

    public function destroy($id)
    {
        Faq::find($id)->delete();
        return redirect()->route('faqs.index')
            ->with('success', 'FAQ deleted successfully');
    }

    public function trashedFaqs()
    {
        $faqs = FAQ::onlyTrashed()->get();
        return view('dashboard.faqs.deleted', compact('faqs'));
    }

    public function restore($id)
    {
        FAQ::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ restored successfully');
    }
    public function forceDelete($id)
    {
        FAQ::withTrashed()
            ->where('id', $id)
            ->forceDelete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ deleted permanently');
    }


}
