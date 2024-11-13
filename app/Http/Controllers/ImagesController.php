<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::all();
        return view('pages.upload', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $path = 'img/models';

        if (is_dir($path)) {
            $handle = opendir($path);
            while (($file = readdir($handle)) !== false) {

                if ($file != '.' && $file != '..' && $file != '.DS_Store') {
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $options = ['jpg', 'png', 'JPG', 'PNG'];
                    if (in_array($extension, $options)) {
                        $name = Str(basename($file, "." . $extension));
                        $filename = $file;
                        Image::firstOrCreate(
                            ['name' => $name],
                            ['filename' => $filename]
                        );
                    }
                }
            }
            closedir($handle);
            return redirect()->back()->with('success', 'Images uploaded successfully');
        } else {
            return redirect()->back()->with('error', 'Images directory "' . $path . '" doesnt exist');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function stats()
    {
        $images = Image::orderByDesc('rank')->orderByDesc('score')->get();
        return view('pages.stats', compact('images'));
    }
}
