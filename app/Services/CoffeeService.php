<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CoffeeService
{
    /**
     * @param $request
     * @return mixed
     */
    public function saveImageAndReturnFilePath($request)
    {
        return $request->file('image')->store('images', 'public');
    }

    /**
     * @param $coffee
     * @return bool
     */
    public function deleteOldImage($coffee)
    {
        return Storage::disk('public')->delete($coffee->image);
    }
}
