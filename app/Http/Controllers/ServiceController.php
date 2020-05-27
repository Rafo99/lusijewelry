<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Product;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Config;
use OpenGraph;
use LaravelLocalization;

class ServiceController extends Controller
{
    public function show($id){
        $service = Service::findorfail($id);
        return view('pages.services.single', compact('service'));
    }
}
