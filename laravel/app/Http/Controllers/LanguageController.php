<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
  
    public function language($locale)
    { 
        $default = config('app.locale', 'en');
        $locales = config('app.available_locales', ['en' => 'English']);
       
        if (!array_key_exists($locale, $locales)) {
            Log::error("Locale '{$locale}' not exists");
            abort(400);
        }
  
        // Session storage
        $current = Session::get('locale', $default);
        Log::debug("Change locale '{$current}' to '{$locale}'");
        Session::put('locale', $locale);
        // Set locale
        App::setLocale($locale);
  
        // Anar a la pàgina anterior
        return redirect()->back();
    }

 
}
