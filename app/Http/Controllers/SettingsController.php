<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings()
    {
        return response()->json([
            'setting' => [
                'app_name' => 'Cassino do João',
                'app_logo' => 'https://via.placeholder.com/150',
                'app_currency' => 'BRL',
            ]
        ]);
    }
}
