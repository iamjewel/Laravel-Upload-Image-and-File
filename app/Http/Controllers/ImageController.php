<?php

namespace App\Http\Controllers;


use App\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Manage Image Show
    public function index()
    {
        $images = UploadImage::latest()->paginate(4);

        return view('image.index', compact('images'));
    }

    //Save Image Show
    public function create()
    {
        return view('image.create');
    }

    //Save Image Function
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        $image = $request->file('image');

        //Check and Make Img Dir.
        if (!Storage::disk('public')->exists('images')) {
            Storage::disk('public')->makeDirectory('images');
        }

        //Check and Make Img Small Dir.
        if (!Storage::disk('public')->exists('imagesSmall')) {
            Storage::disk('public')->makeDirectory('imagesSmall');
        }

        //Unique Name
        $imageName = time() . '_' . $image->getClientOriginalName();

        //Img Path
        $imagePath = 'storage/images/';
        $imageSmallPath = 'storage/imagesSmall/';

        //Img URL
        $imageUrl = $imagePath . $imageName;
        $imageSmallUrl = $imageSmallPath . $imageName;

        Image::make($image)->resize(800, 862)->save($imageUrl);
        Image::make($image)->resize(400, 400)->save($imageSmallUrl);


        $image = new UploadImage();

        $image->image = $imageUrl;
        $image->imageSmall = $imageSmallUrl;
        $image->save();

        return redirect()->route('image.index')
            ->with(['message' => 'Image Uploaded Successfully']);

    }


    public function show($id)
    {

    }


    //Edit Image View
    public function edit($id)
    {
        $image = UploadImage::find($id);

        return view('image.edit', compact('image'));
    }


    //Update Image Function
    public function update(Request $request, $id)
    {
        $image = $request->file('image');


        if (isset($image)) {


            //Unique Name
            $imageName = time() . '_' . $image->getClientOriginalName();

            //Img Path
            $imagePath = 'storage/images/';
            $imageSmallPath = 'storage/imagesSmall/';

            //Img URL
            $imageUrl = $imagePath . $imageName;
            $imageSmallUrl = $imageSmallPath . $imageName;

            Image::make($image)->resize(800, 862)->save($imageUrl);
            Image::make($image)->resize(400, 400)->save($imageSmallUrl);

            $image = UploadImage::find($id);

            unlink($image->image);
            unlink($image->imageSmall);

            $image->image = $imageUrl;
            $image->imageSmall = $imageSmallUrl;
            $image->save();

            return redirect('/image')->with('message', 'Image Uploaded Successfully');

        } else {
            return redirect('/image')->with('message', 'U Didnt Chang Any Image');
        }


    }

    //Delete Image Function
    public function destroy($id)
    {
        $image = UploadImage::findOrFail($id);

        unlink($image->image);
        unlink($image->imageSmall);

        $image->delete();

        return redirect()->route('image.index')
            ->with(['message' => 'Image Deleted Successfully']);


    }
}
