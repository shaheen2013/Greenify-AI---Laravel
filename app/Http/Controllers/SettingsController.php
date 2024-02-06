<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $path;
    public function __construct()
    {
        $this->path='backend.pages.settings';
    }

    
    public function index() {
        return view($this->path.'.index');
    }
}
