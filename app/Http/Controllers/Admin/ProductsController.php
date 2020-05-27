<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::withoutGlobalScope('onlyParents')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name_hy' => 'required',
            'category_id' => 'required|numeric',
            'qty' =>  'numeric',
            'price' =>  'required|numeric',
            'picture'    => 'required',
            'description_hy' => 'required',
            'filepath'   => 'array',
            'type'   => 'required',
            'color'   => 'required',
            'karat'   => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.products.create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // find Category
            $category = Category::withoutGlobalScope('onlyParents')->findOrFail($request->category_id);
//             Get Picture Name
            $array = explode('/', $request->picture);
            $picture = end($array);
//             Store
            $product = new Product;
            $product->category_id = $request->category_id;
            $product->translateOrNew('hy')->name = $request->name_hy;
            if($request->name_en != null)
                $product->translateOrNew('en')->name = $request->name_en;
            if($request->name_ru != null)
                $product->translateOrNew('ru')->name = $request->name_ru;
            $product->translateOrNew('hy')->description = $request->description_hy;
            if($request->description_en != null)
                $product->translateOrNew('en')->description = $request->description_en;
            if($request->description_ru != null)
                $product->translateOrNew('ru')->description = $request->description_ru;
            $product->price = $request->price;
            $product->qty = $request->qty;
            !empty($request->sex) ? $product->sex = $request->sex : '';
            $product->type = $request->type;
            $product->karat = $request->karat;
            $product->color = $request->color;
            ($picture != false) ? $product->picture = $picture : $product->picture = "";
            $product->save();
            if($request->has('filepath')) {
                foreach ($request->filepath as $pic) {
                    $product->insertPicture($pic);
                }
            }
            // redirect
            return redirect()->route('admin.products')->with('message', 'Successfully created');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $rules = array(
            'name_hy' => 'required',
            'category_id' => 'required|numeric',
            'qty' =>  'numeric',
            'price' =>  'required|numeric',
            'picture'    => 'required',
            'description_hy' => 'required',
            'filepath'   => 'array',
            'type'   => 'required',
            'color'   => 'required',
            'karat'   => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // find Category
            $category = Category::withoutGlobalScope('onlyParents')->findOrFail($request->category_id);
            // Get Picture Name
            $array = explode('/', $request->picture);
            $picture = end($array);
            // Store
            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->translateOrNew('hy')->name = $request->name_hy;
            if($request->name_en != null)
                $product->translateOrNew('en')->name = $request->name_en;
            if($request->name_ru != null)
                $product->translateOrNew('ru')->name = $request->name_ru;
            $product->translateOrNew('hy')->description = $request->description_hy;
            if($request->description_en != null)
                $product->translateOrNew('en')->description = $request->description_en;
            if($request->description_ru != null)
                $product->translateOrNew('ru')->description = $request->description_ru;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->sex = $request->sex;
            $product->type = $request->type;
            $product->karat = $request->karat;
            $product->color = $request->color;
            ($picture != false) ? $product->picture = $picture : $product->picture = "";
            $product->save();
            $product->pictures()->delete();
            if($request->has('filepath')) {
                foreach ($request->filepath as $pic) {
                    $product->insertPicture($pic);
                }
            }
            // redirect
            return redirect()->route('admin.products')
                ->with('message', 'Successfully edited');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $product = Product::findOrFail($id);
        $product->delete();

        // redirect
        return redirect()->route('admin.products')
            ->with('message', 'Successfully Deleted');
    }


    /**
     * Get the path of specified resource.
     *
     * @param  string  $picture
     * @return Response
     */
    public function getImagePath($picture)
    {
        $file_path = DIRECTORY_SEPARATOR . Config::Get('lfm.images_folder_name')
            . DIRECTORY_SEPARATOR . Config::Get('lfm.shared_folder_name')
            . DIRECTORY_SEPARATOR . $picture;

        return $file_path;
    }
}
