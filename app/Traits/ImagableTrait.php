<?php

namespace App\Traits;

use File;
use Illuminate\Http\Request;

trait ImagableTrait
{
    /**
     * Get Image url path attribute
     *
     * @return string
     */
    public function getImgUrlAttribute()
    {
        return $this->imageUrl();
    }

    /**
     * Save Model Image
     *
     * @param $model
     * @param Request $request
     *
     * @return bool
     */
    public function saveImage($model, Request $request)
    {
        if ($request->hasFile('image') && File::exists($request->file('image')->getPathname()))
        {
            $imageName = strtolower(class_basename($this)) . '-' . $model->id;
            $imageExtension = strtolower($request->file('image')->getClientOriginalExtension());

            $file = $request->file('image')->move($this->imagePath(), $imageName . "." . $imageExtension);
            $model->image = $file->getFilename();

            $model->save();
        }

        return true;
    }

    /**
     * Delete Model Image
     *
     * @return bool
     */
    public function deleteImage()
    {
        return File::delete($fileName = $this->imagePath().DIRECTORY_SEPARATOR.$this->image);
    }

    /**
     * Get Image directory path
     *
     * @return string
     */
    public function imagePath()
    {
        return storage_path('images').DIRECTORY_SEPARATOR.$this->getTable();
    }

    /**
     * Get Image url path
     *
     * @return string
     */
    public function imageUrl()
    {
        return $this->getTable().'/';
    }

    /**
     * {@inheritDoc}
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function($model)
        {
            $model->deleteImage();
        });
    }
}
