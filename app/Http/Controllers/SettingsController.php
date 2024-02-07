<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\SocialMedia;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $path;
    public function __construct()
    {
        $this->path = 'backend.pages.settings';
    }


    public function index()
    {
        $data['timezones'] = getTimezone();
        $data['dateFormats'] = getDateTimeFormat();
        $settings = Settings::first();
        $socialmedia = SocialMedia::first();
        $data['settings'] = [
            'settings' => $settings,
            'socialmedia' => $socialmedia,
        ];
        return view($this->path.'.index', $data);
    }

    public function update(Request $request, $id, $type) {
        if($type === 'system') {
            $settings = Settings::findOrFail($id);
            $settings->update([
                'site_name' => $request->site_name,
                'site_title' => $request->site_title,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'timezone' => $request->timezone,
                'date_format' => $request->date_format,
                'currency' => $request->currency,
                'address' => $request->address,
                'map_location' => $request->map_location,
                'copyright' => $request->copyright,
                'light_logo' => $request->light_logo,
                'dark_logo' => $request->dark_logo,
                'fav_icon' => $request->fav_icon,
            ]);
            if($settings) return redirect()->route('settings.index')->with('success',Toastr::success("Settings Updated Successfully", 'Settings'));
            else return redirect()->route('settings.index')->with('error',Toastr::error("Settings Update Failed", 'Settings'));
        }
    }


}
