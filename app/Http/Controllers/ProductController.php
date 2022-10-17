<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        $colors = Color::pluck('color', 'id')->toArray();
        $sizes = Size::pluck('size', 'id')->toArray();
        $brands = Brand::pluck('brand', 'id')->toArray();

        return view('products.create', compact('categories','colors','sizes','brands'));
    }

    public function store(ProductRequest $request)
    {
        // dd($request->title);
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'is_active' => $request->is_active ? true : false,
            'image' =>  $this->uploadImage($request->file('image'))
        ];
        // dd($data);

        $product = Product::create($data);
        $product->colors()->attach($request->colors);
        $product->sizes()->attach($request->size);

        return redirect()
            ->route('products.index')
            ->withMessage('Created Successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id')->toArray();
        $colors = Color::pluck('color', 'id')->toArray();
        $selectedColors = $product->colors()->pluck('id')->toArray(); 
        $sizes = Size::pluck('size', 'id')->toArray();
        $selectedSize = $product->sizes()->pluck('id')->toArray(); 
        $brands = Brand::pluck('brand', 'id')->toArray();
        return view('products.edit', compact('product', 'categories','colors','sizes','selectedColors','brands','selectedSize'));
    }

    public function update(ProductRequest $request,Product $product)
    {
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'is_active' => $request->is_active ? true : false,
         
        ];

        if($request->hasFile('image')){
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $product->update($data);
        $product->colors()->sync($request->colors);
        $product->sizes()->sync($request->size);

        return redirect()
            ->route('products.index')
            ->withMessage('Updated Successfully!');
    }

    public function show(Product $product)
    {
       
        return view('products.show', compact('product',));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->withMessage('Deleted Successfully!');
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return view('products.trash', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();

        return redirect()
            ->route('products.trash')
            ->withMessage('Restored Successfully!');
    } 

    public function delete($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->forceDelete();

        return redirect()
            ->route('products.trash')
            ->withMessage('Deleted Successfully!');
    } 

    public function downloadPdf()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('products.pdf', compact('products'));
        return $pdf->download('Product-list.pdf');
    }

    public function uploadImage($file){
        $fileName = date('y-m-d').'-'.time().'.'.$file ->getClientOriginalExtension();
        // $file->move(storage_path('app/public/products'), $fileName);

        Image::make($file)
                ->resize(200, 200)
                ->save(storage_path() . '/app/public/products/' . $fileName);

        return $fileName;
    }
}
