<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\GalleryGroup as GalleryGroupModel;
use Illuminate\Http\Request;

class GalleryGroup extends Controller
{
    protected $baseRepo;

    public function __construct(GalleryGroupModel $GalleryGroupModel)
    {   
        $this->baseRepo = new BaseRepository($GalleryGroupModel);
    }
}
