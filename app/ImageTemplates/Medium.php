<?php

namespace App\ImageTemplates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(300, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}