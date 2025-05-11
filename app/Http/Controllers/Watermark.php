<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Watermark extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'fileimage'=>'required|file|mimes:png,jpg|max:5000',
            'message'=>'required|string|min:10|max:20'
        ]);
        $file=$request->file('fileimage');
        $text = $request->input('message');
        return response()->stream(function () use ($text,$file) {
            $image = imagecreatefromjpeg($file);
            $textcolor = imagecolorallocate($image,255,255,255);
            $fontsize = 5;
            $margin = 10;
            $textWidth = imagefontwidth($fontsize)*strlen($text);
            $textHeight = imagefontheight($fontsize);
            $x = imagesx($image) - $textWidth - $margin;
            $y = imagesy($image) - $textHeight - $margin;
            imagestring($image,$fontsize,$x,$y,$text,$textcolor);
            header('Content-Type: image/jpeg');
            imagejpeg($image);
            imagedestroy($image);
        },200,['Content-Type'=>'image/jpeg']);
    }
}
