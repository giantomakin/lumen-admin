<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\GalleryAlbum as GalleryAlbumModel;
use Illuminate\Http\Request;

class GalleryAlbum extends Controller
{
    protected $baseRepo;

    public function __construct(GalleryAlbumModel $GalleryAlbumModel)
    {   
        $this->baseRepo = new BaseRepository($GalleryAlbumModel);
    }
}
