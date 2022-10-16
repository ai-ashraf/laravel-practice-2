<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(brandRequest $request)
    {

        // dd($request->brand);

        $data = [
            'brand' => $request->brand,
        ];

        Brand::create($data);

        return redirect()
            ->route('brands.index')
            ->withMessage('Created Successfully!');
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(BrandRequest $request,Brand $brand)
    {
        $data = [
            'brand' => $request->brand,
            // 'is_active' => $request->is_active ? true : false,
        ];

        // if($request->hasFile('image')){
        //     $data['image'] = $this->uploadImage($request->file('image'));
        // }

        $brand->update($data);

        return redirect()
            ->route('brands.index')
            ->withMessage('Updated Successfully!');
    }

    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()
            ->route('brands.index')
            ->withMessage('Deleted Successfully!');
    }

    public function trash()
    {
        $brands = Brand::onlyTrashed()->get();
        return view('brands.trash', compact('brands'));
    }

    public function restore($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        $brand->restore();

        return redirect()
            ->route('brands.trash')
            ->withMessage('Restored Successfully!');
    }

    public function delete($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        $brand->forceDelete();

        return redirect()
            ->route('brands.trash')
            ->withMessage('Deleted Successfully!');
    }
}
