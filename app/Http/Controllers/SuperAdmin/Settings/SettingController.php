<?php

namespace App\Http\Controllers\SuperAdmin\Settings;

use Illuminate\Http\Request;
use App\Models\SuperAdmin\Setting;
use App\Http\Controllers\Controller;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Http\Requests\SuperAdmin\Settings\SettingRequest;

class SettingController extends Controller
{
    use UploadFileTrait;

    protected $filePath = 'images/settings';

    public function __construct()
    {
         $this->middleware(['can:settings-edit'], ['only' => ['edit', 'update']]);
    }


    public function edit(string $id)
    {
        $settings = Setting::findOrFail($id);
        return view('dashboard.settings.edit', compact('settings'));
    }




    public function update(SettingRequest $request, string $id)
    {
        $record = Setting::findOrFail($id);

        $data = $request->validated();

        if (isset($data['image'])) {
            $data['image'] = $this->updateFile($data['image'], $record->image, $this->filePath);
        }
        if (isset($data['footer_image'])) {
            $data['footer_image'] = $this->updateFile($data['footer_image'], $record->footer_image, $this->filePath);
        }

        $record->update([
            'image' => isset($data['image']) ? $data['image'] : $record->image,
            'email' => isset($data['email']) ? $data['email'] : $record->email,
            'facebook_link' => isset($data['facebook_link']) ? $data['facebook_link'] : $record->facebook_link,
            'twitter_link' => isset($data['twitter_link']) ? $data['twitter_link'] : $record->twitter_link,
            'whatsapp_link' => isset($data['whatsapp_link']) ? $data['whatsapp_link'] : $record->whatsapp_link,
            'pinterest_link' => isset($data['pinterest_link']) ? $data['pinterest_link'] : $record->pinterest_link,
            'youtube_link' => isset($data['youtube_link']) ? $data['youtube_link'] : $record->youtube_link,
            'instagram_link' => isset($data['instagram_link']) ? $data['instagram_link'] : $record->instagram_link,
            'reddit_link' => isset($data['reddit_link']) ? $data['reddit_link'] : $record->reddit_link,
            'linkedin_link' => isset($data['linkedin_link']) ? $data['linkedin_link'] : $record->linkedin_link,
            'footer_image' => isset($data['footer_image']) ? $data['footer_image'] : $record->footer_image,
            'desc' => isset($data['desc']) ? $data['desc'] : $record->desc,
            'copyright' => isset($data['copyright']) ? $data['copyright'] : $record->copyright,
            'address' => isset($data['address']) ? $data['address'] : $record->address,
            'phone' => isset($data['phone']) ? $data['phone'] : $record->phone,
        ]);

        return redirect()->back()->with('success', 'Setting updated successfully');
    }

}
