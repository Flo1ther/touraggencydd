<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourImageController extends Controller
{
    public function destroy(TourImage $image)
    {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return back()->with('success', 'Зображення видалено');
    }
}
