<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Admin extends Model
{
    protected $table = '';
    protected $folderUpload = '';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = ['id', 'name'];

    public function uploadThumb($thumb)
    {
        $nameImage = Str::random(10).'.'.$thumb->getClientOriginalExtension();
        $thumb->storeAs($this->folderUpload, $nameImage, 'zvn_storage');
        return $nameImage;
    }

    public function deleteThumb($thumbName)
    {
        Storage::disk('zvn_storage')->delete($this->folderUpload . '/' . $thumbName);
    }
}
