<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\ColorRequest;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('colors.index', compact('colors'));
    }

    public function create()
    {
        return view('colors.create');
    }

    public function store(ColorRequest $request)
    {

        // dd($request->name);

        $data = [
            'color' => $request->color,
        ];

        Color::create($data);

        return redirect()
            ->route('colors.index')
            ->withMessage('Created Successfully!');
    }

    public function edit(Color $color)
    {
        return view('colors.edit', compact('color'));
    }

    public function update(ColorRequest $request,Color $Color)
    {
        $data = [
            'color' => $request->color,
            // 'is_active' => $request->is_active ? true : false,
        ];

        // if($request->hasFile('image')){
        //     $data['image'] = $this->uploadImage($request->file('image'));
        // }

        $Color->update($data);

        return redirect()
            ->route('colors.index')
            ->withMessage('Updated Successfully!');
    }

    public function show(Color $color)
    {
        return view('colors.show', compact('color'));
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()
            ->route('colors.index')
            ->withMessage('Deleted Successfully!');
    }

    public function trash()
    {
        $colors = Color::onlyTrashed()->get();
        return view('colors.trash', compact('colors'));
    }

    public function restore($id)
    {
        $Color = Color::onlyTrashed()->find($id);
        $Color->restore();

        return redirect()
            ->route('colors.trash')
            ->withMessage('Restored Successfully!');
    }

    public function delete($id)
    {
        $Color = Color::onlyTrashed()->find($id);
        $Color->forceDelete();

        return redirect()
            ->route('colors.trash')
            ->withMessage('Deleted Successfully!');
    }

    // public function downloadPdf()
    // {
    //     $colors = Color::all();
    //     $pdf = Pdf::loadView('colors.pdf', compact('colors'));
    //     return $pdf->download('Color-list.pdf');
    // }

    // public function uploadImage($file){
    //     $fileName = date('y-m-d').'-'.time().'.'.$file ->getClientOriginalExtension();
    //     // $file->move(storage_path('app/public/colors'), $fileName);

    //     Image::make($file)
    //             ->resize(200, 200)
    //             ->save(storage_path() . '/app/public/colors/' . $fileName);

    //     return $fileName;
    // }
}
