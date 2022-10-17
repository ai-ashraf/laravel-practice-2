<?php

namespace App\Http\Controllers;

use App\Models\size;
use App\Http\Requests\sizeRequest;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('sizes.create');
    }

    public function store(sizeRequest $request)
    {

        // dd($request->all());

        $data = [
            'size' => $request->size,
            
        ];

        size::create($data);

        return redirect()
            ->route('sizes.index')
            ->withMessage('Created Successfully!');
    }

    public function edit(Size $size)
    {
        return view('sizes.edit', compact('size'));
    }

    public function update(SizeRequest $request,Size $size)
    {
        $data = [
            'size' => $request->size,
        ];

        $size->update($data);

        return redirect()
            ->route('sizes.index')
            ->withMessage('Updated Successfully!');
    }

    public function show(Size $size)
    {
        return view('sizes.show', compact('size'));
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()
            ->route('sizes.index')
            ->withMessage('Deleted Successfully!');
    }

    public function trash()
    {
        $sizes = Size::onlyTrashed()->get();
        return view('sizes.trash', compact('sizes'));
    }

    public function restore($id)
    {
        $size = Size::onlyTrashed()->find($id);
        $size->restore();

        return redirect()
            ->route('sizes.trash')
            ->withMessage('Restored Successfully!');
    }

    public function delete($id)
    {
        $size = Size::onlyTrashed()->find($id);
        $size->forceDelete();

        return redirect()
            ->route('sizes.trash')
            ->withMessage('Deleted Successfully!');
    }

    // public function downloadPdf()
    // {
    //     $sizes = size::all();
    //     $pdf = Pdf::loadView('sizes.pdf', compact('sizes'));
    //     return $pdf->download('size-list.pdf');
    // }

    // public function uploadImage($file){
    //     $fileName = date('y-m-d').'-'.time().'.'.$file ->getClientOriginalExtension();
    //     // $file->move(storage_path('app/public/sizes'), $fileName);

    //     Image::make($file)
    //             ->resize(200, 200)
    //             ->save(storage_path() . '/app/public/sizes/' . $fileName);

    //     return $fileName;
    // }
}
