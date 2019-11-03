<?php

namespace App;

use File;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as InterventionImage;

class Image extends Model
{

    protected $guarded = [];
    protected $fillable = ['main', 'original_path', 'thumbnail_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
//    ------------------------------------------------------------------------------------------------------------------

    public static function uploadImages($images)
    {
//        Stex sovorakan uploadImage funkciayi patcharov nenc em arel vor store metod@ rodukti tex@ produkt ida stanum. Uxxi mi dzev vor ham es ham sovorakan upload@ nuyn dzev ashxaten

        $date = (String)date('Y/m') . '/';

        foreach ($images as $image) {
//            dd($images);
//            preg_match("/data:image\/(.*?);/", $image, $extension);
//            dd($image);
//            $filename = time() . '-' . str_random(10) . '.' . $extension[1];

            $filename = str_random(10);
            $extension = $image->getClientOriginalExtension();

            // Names to be stored in table
            $originalName  = $filename.'_original_'.time().'.'.$extension;
            $thumbnailName = $filename.'_thumbnail_'.time().'.'.$extension;

            $originalNameToStore  = $date . $originalName;
            $thumbnailNameToStore = $date . $thumbnailName;

            // Directories where the images will be stored
            $original_path  = photos_path() . $originalName;
            $thumbnail_path = photos_path() . $thumbnailName;

            //Resize and move Image
            InterventionImage::make($image)
                ->save($original_path);
            InterventionImage::make($image)
                ->resize(300,300, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbnail_path);

            self::store($originalNameToStore, $thumbnailNameToStore, auth()->id());
        }

    }


    public static function uploadImage($image, $product_id)
    {

        $date = (String)date('Y/m') . '/';

        if($image->isValid()) {
            $filename = str_random(10);
            $extension = $image->getClientOriginalExtension();

            // Names to be stored in table
            $originalName  = $filename.'_original_'.time().'.'.$extension;
            $thumbnailName = $filename.'_thumbnail_'.time().'.'.$extension;

            $originalNameToStore  = $date . $originalName;
            $thumbnailNameToStore = $date . $thumbnailName;

            // Directories where the images will be stored
            $original_path  = photos_path() . $originalName;
            $thumbnail_path = photos_path() . $thumbnailName;

            //Resize and move Image
            InterventionImage::make($image)
                ->save($original_path);
            InterventionImage::make($image)
                ->resize(300,300, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbnail_path);

            return self::store($originalNameToStore, $thumbnailNameToStore, $product_id);
        }

    }

    public static function store($originalName, $thumbnailName, $user_id)
    {
//        $product = Product::findOrFail($user_id, ['id']);

        $image = new static;
        $image->thumbnail_path  = $thumbnailName;
        $image->original_path = $originalName;
        $image->user_id = $user_id;
        $image->save();

//        return $image->id;
    }

}
