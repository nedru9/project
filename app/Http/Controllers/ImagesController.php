<?php

namespace App\Http\Controllers;
use File;
use ZipArchive;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;

class ImagesController extends Controller
{
    use Sortable;
    public function index(Request $request)
    {
        if ($request->input('id') !== null) {
            if (is_numeric($request->input('id'))) {
                $idImage = $request->input('id');
            }
            else
            {
                return json_encode(null);
            }
        }
        if (isset($idImage)) {
            $imagesGet = Image::find($idImage);
        }
        else {
            $imagesGet = Image::all();
        }
        return json_encode($imagesGet);
    }
    public function upload(Request $request)
    {
        $images = $request->file('images');
        if ($request->file('images') !== null)
        {
            if (count($images) > 5) {
                return redirect()->back()->with('error', 'Вы можете загрузить одновременно максимум 5 изображений!');
            }
            else {
                foreach ($images as $image) {
                    $imageName = Str::lower(Str::ascii(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME))) . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads'), $imageName);
                    Image::create(['name' => $imageName]);
                }
                return redirect()->back()->with('success', 'Изображения успешно добавлены!');
            }  
        }  
    }
    public function download(Request $request)
    {
        $zip = new ZipArchive;
        $fileName = $request->filename;
        $zipFileName = public_path('photo.zip');
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            $photoPath = public_path('uploads/' . $fileName);
            if (file_exists($photoPath)) {
                $zip->addFile($photoPath, $fileName);
            }
            $zip->close();
        }
        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
    public function show()
    {
        $images = Image::sortable()->get();
        return view('layouts.images', ['images' => $images]);
    }
}