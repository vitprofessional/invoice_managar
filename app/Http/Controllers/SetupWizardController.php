<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SetupWizardController extends Controller
{
    public function index() {
        return view('setup.index');
    }

    public function save(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_logo' => 'nullable|image',
            'company_email' => 'required|email',
            'company_phone' => 'required',
            'company_address' => 'required',
            'default_currency' => 'required',
            'invoice_prefix' => 'required'
        ]);

        foreach ($request->except('_token', 'company_logo') as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('company_logo')) {
            $logoPath = $request->company_logo->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'company_logo'], ['value' => $logoPath]);
            Setting::updateOrCreate(['key' => 'company_watermark'], ['value' => $logoPath]);
        }

        return redirect()->route('dashboard')->with('success', 'Setup completed successfully!');
    }
}
