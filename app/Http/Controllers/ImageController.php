<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    

    // Show all images saved by user
    public function index(Request $request) {
        $images = Image::where("user_id", $request->user()->id)->get();
        foreach ($images as $image) {
            $image["image_url"] = $this->getFetchUrl($image); // Probably better to move to google bucket
        }
        return $images;
    }

    // Show single image
    public function show(Image $image) {
        // only show if user owns image
        if (request()->user()->id == $image->user_id) {
            $image["image_url"] = $this->getFetchUrl($image);
        
            return $image;
        } else {
            return response()->json(["error" => "Not authorized."]);
        }
        
    }

    public function fetchImage(Image $image){
        // only show if user owns image
        if (request()->user()->id == $image->user_id) {
            // Get image from local disk
            $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . $image->image_path;

            return response()->file($local_path);
        } else {
            return response()->json(["error" => "Not authorized."]);
        }
        
    }

    public function store(StoreImageRequest $request){
        // Get form fields
        $formFields = $request->all();
        // Store image file and save path in database
        $formFields["image_path"] = $request->file("image")->store("images");
        $formFields["user_id"] = $request->user()->id;
 
        $image = Image::create($formFields);
        
        return $image;
    }

    private function getFetchUrl($image): string{
        return "http://localhost:8000/api/images/". $image->id . "/fetch";
    }
    
    private function encodeImageToBase64($image_path): string{
        // Get image from local disk
        $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . $image_path;
        return base64_encode(file_get_contents($local_path));
    }
}
