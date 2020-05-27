<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Config;
use OpenGraph;
use LaravelLocalization;

class ProductsController extends Controller
{
	public function show($id)
	{
	    $data = [];
		$data['product'] = Product::findOrFail($id);
        $data['category'] = $data['product']->category;
		$data['productpics'] = Picture::where('product_id', $id)->get();
		$data['latest'] = Product::whereNotIn('id', array($data['product']->id))
		                 ->orderBy('created_at', 'DESC')
		                 ->take(3)
		                 ->get();
		$og = OpenGraph::title($data['product']->getTranslation()->name)
		    ->siteName(config('app.name', 'LusiJewelry'))
		    ->locale(LaravelLocalization::getCurrentLocale())
		    ->localeAlternate(LaravelLocalization::getSupportedLanguagesKeys())
		    ->type('product.item')
		    ->image(route('show.image', $data['product']->picture))
		    ->description($data['product']->getTranslation()->description)
		    ->attributes('product',
			    [
				    'price:amount' => $data['product']->price,
				    'price:currency' => '$',
				    'condition' => 'New',
				    'category' => $data['category']->getTranslation()->name,
				    'retailer_item_id' => 'LusiJewelry',
			    ], null, false)
		    ->url();
		return view('pages.products.single', compact('data', 'og'));
	}

	public function showImage($picture)
	{
		$file_path = public_path()
		             . DIRECTORY_SEPARATOR . Config::Get('lfm.images_folder_name')
		             . DIRECTORY_SEPARATOR . Config::Get('lfm.shared_folder_name')
		             . DIRECTORY_SEPARATOR . $picture;
		if (! File::exists($file_path)) {
			abort(404);
		}
		$file = File::get($file_path);
		$type = self::getFileType($file_path);
		$response = Response::make($file);
		$response->header('Content-Type', $type);
		return $response;
	}

	public function showThumb($picture)
	{
		$file_path = public_path()
		             . DIRECTORY_SEPARATOR . Config::Get('lfm.images_folder_name')
		             . DIRECTORY_SEPARATOR . Config::Get('lfm.shared_folder_name')
		             . DIRECTORY_SEPARATOR . Config::Get('lfm.thumb_folder_name')
		             . DIRECTORY_SEPARATOR . $picture;
		if (! File::exists($file_path)) {
			abort(404);
		}
		$file = File::get($file_path);
		$type = self::getFileType($file_path);
		$response = Response::make($file);
		$response->header('Content-Type', $type);
		return $response;
	}


	public static function getFileType($file)
	{
		if ($file instanceof UploadedFile) {
			$mime_type = $file->getMimeType();
		} else {
			$mime_type = File::mimeType($file);
		}
		return $mime_type;
	}
}
