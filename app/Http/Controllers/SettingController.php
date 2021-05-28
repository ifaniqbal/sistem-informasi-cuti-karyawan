<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingStoreRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('change setting');

        return Inertia::render('SettingIndex', [
            'maxAnnualFurlough' => Setting::where('name', 'max_annual_furlough')->firstOrNew()->value,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingStoreRequest $request)
    {
        $this->authorize('change setting');
        foreach ($request->validated() as $name => $value) {
            Setting::where('name', $name)->update(['value' => $value]);
        }

        return back();
    }
}
