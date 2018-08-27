<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\PostCategory as PostCategoryModel;
use Illuminate\Http\Request;

class PostCategory extends Controller
{
    protected $baseRepo;

    public function __construct(PostCategoryModel $PostCategoryModel)
    {   
        $this->baseRepo = new BaseRepository($PostCategoryModel);
    }
}
