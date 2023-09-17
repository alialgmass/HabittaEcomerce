<?php
function checkForDirectory($path)
{

    File::exists($path) or File::makeDirectory($path);
}
function upload_image($path , $image)
{
    $imageName  = time() . \Str::random(45) . '.' . $image->extension();
    $image->move(public_path('uploads/'.$path) , $imageName);
    return $imageName;
}

function upload_image_without_resize($path , $image )
{
    checkForDirectory('uploads/'.$path);
    // $image must be a $request->image
    // $image must be reduced to 300 * 300 px and decreasing the size of the image to 60% of the original size without changing the image dimensions (width and height)
    Intervention\Image\Facades\Image::make($image)->resize(400, null, function ($constraint) {
        $constraint->aspectRatio();
    })->save(public_path('uploads/'.$path .'/'. $image->hashName()));
    return $image->hashName();
}

function delete_image($folder , $image)
{
    if (File::exists($folder.'/'.$image))
        File::delete($folder.'/'.$image);
}

function delete_folder($folder)
{
    if (File::exists($folder))
        File::deleteDirectory($folder);
}

function upload_file($path, $request_file){
    $fileName = time().'.'.$request_file->getClientOriginalExtension();
    $request_file->move(public_path('uploads/'.$path), $fileName);
    return $fileName;
}

function getProductImageValue($key)
{
    $value = '';
    if ($key != '') {
        $value .= '<div class="row"><div class="col-12">';
        $value .= '<span class="avatar mb-2">';
        $value .= '<img class="round" src="' . $key . '" alt="avatar" height="90" width="90">';
        $value .= '</span>';
        $value .= '</div> </div>';
    }
    return $value;
}

function AddittionalProductImage($key)
{
    $value = '';
    if ($key != '') {
        $value .= '<div class="row"><div class="col-12">';
        $value .= '<span class="avatar">';
        $value .= '<img class="round" src="' . $key . '" alt="avatar" height="90" width="90">';
        $value .= '</span>';
        $value .= '</div>';
        $value .= '<div class="col-12">';
        $value .= '<a href="' . route('products.Images', ['key' => basename($key)]) . '"';
        $value .= ' class="btn btn-danger btn-sm mb-2 mx-1">' . trans("common.delete") . '</a>';
        $value .= '</div></div>';
    }
    return $value;
}

function is_current_route($route){
    if(request()->route()->getName() == $route)
        return true;
    return false;
}

function get_setting_by_key($key){
    return \App\Models\Setting::where('key',$key)->first();
}

function image_path($path,$image_name){
    return asset("public/uploads/$path/".$image_name);
}
