<?php

namespace App\ImageTemplates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ExtraSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(50, 40, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}