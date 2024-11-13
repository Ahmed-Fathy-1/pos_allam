<?php

namespace App\Http\Controllers\SuperAdmin\Packages;

use Illuminate\Http\Request;
use App\Models\SuperAdmin\Package;
use App\Http\Controllers\Controller;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Http\Requests\SuperAdmin\Packages\PackageRequest;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    use UploadFileTrait;

    protected $filePath = 'images/packages';

    function __construct()
    {
         $this->middleware(['can:packages-list'], ['only' => ['index']]);
         $this->middleware(['can:package-create'], ['only' => ['create', 'store']]);
         $this->middleware(['can:packages-edit'], ['only' => ['edit', 'update']]);
         $this->middleware(['can:packages-delete'], ['only' => ['destroy','archivedPackages','restore','forceDelete']]);
    }

    public function index(Request $request)
    {
        $packages = Package::with('packageDetails')->latest()->get();
        return view('dashboard.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('dashboard.packages.create');
    }

    public function store(PackageRequest $request)
    {
        DB::transaction(function () use ($request) {
            $package = Package::create([
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active ?? true,
                'free' => $request->free ?? false,
                'free_period' => $request->free_period ?? null,
                'user_id' => auth()->id(),
            ]);

            $package->packageDetails()->create([
                'Price_monthly' => $request->Price_monthly,
                'Price_annually' => $request->Price_annually,
                'storage_monthly' => $request->storage_monthly,
                'storage_annually' => $request->storage_annually,
                'interactive_archives' => $request->interactive_archives ?? false,
                'custom_branding' => $request->custom_branding ?? false,
                'messages' => $request->messages ?? false,
                'notifications' => $request->notifications,
                'priority' => $request->priority ?? true,
                'main_show' => $request->main_show,
                'main_search' => $request->main_search,
                'statics' => $request->statics,
            ]);
        });

        return redirect()->route('packages.index')->with('success', 'Package created successfully');
    }

    public function edit($id)
    {
        $packages  = Package::with('packageDetails')->findOrFail($id);
        return view('dashboard.packages.edit', compact('packages'));
    }

    public function update(PackageRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $package = Package::findOrFail($id);

            $package->update([
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active ?? true,
                'free' => $request->free ?? false,
                'free_period' => $request->free_period ?? null,

                'user_id' => auth()->id(),
            ]);

            $package->packageDetails()->update([
                'Price_monthly' => $request->Price_monthly,
                'Price_annually' => $request->Price_annually,
                'storage_monthly' => $request->storage_monthly,
                'storage_annually' => $request->storage_annually,
                'interactive_archives' => $request->interactive_archives ?? false,
                'custom_branding' => $request->custom_branding ?? false,
                'messages' => $request->messages ?? false,
                'notifications' => $request->notifications,
                'priority' => $request->priority ?? true,
                'main_show' => $request->main_show,
                'main_search' => $request->main_search,
                'statics' => $request->statics,
            ]);
        });

        return redirect()->route('packages.index')->with('success', 'Package updated successfully');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete(); // Soft delete
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully');
    }

    public function archivedPackages()
    {
        $packages = Package::onlyTrashed()->with('packageDetails')->get();
        return view('dashboard.packages.archived-packages', compact('packages'));
    }

    public function restore($id)
    {
        $package = Package::withTrashed()->findOrFail($id);
        $package->restore();
        return redirect()->route('packages.index')->with('success', 'Package restored successfully');
    }

    public function forceDelete($id)
    {
        $package = Package::withTrashed()->findOrFail($id);
        $package->forceDelete();
        return redirect()->route('packages.archived')->with('success', 'Package restored successfully');
    }
}
