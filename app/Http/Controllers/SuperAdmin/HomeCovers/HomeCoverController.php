<?php

namespace App\Http\Controllers\SuperAdmin\HomeCovers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\HomeCover;
use App\Http\Requests\SuperAdmin\HomeCovers\HomeCoverRequest;


class HomeCoverController extends Controller
{
    use UploadFileTrait;
    protected $uploadPath = 'images/homecover';

    function __construct()
    {
        $this->middleware(['can:homeCover-edit'], ['only' => ['edit', 'update']]);
    }

    public function edit($id)
    {
        $homecover = HomeCover::findOrFail($id);
        return view('dashboard.homecover.edit', compact('homecover'));
    }

    public function update(HomeCoverRequest $request, $id)
    {
        $data = $request->validated();

        $homecover = HomeCover::findOrFail($id);

        $data['image'] = $request->file('image') ?
                         $this->uploadFile($request->file('image'), $this->uploadPath) :
                         $homecover->image;

        $homecover->update($data);

        return redirect()->route('home_cover', $id)->with('success', 'Home Cover Updated Successfully');
    }

}
