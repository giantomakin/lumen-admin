<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\MaterialCategory as MaterialCategoryModel;
use Illuminate\Http\Request;


class MaterialCategory extends Controller
{
    protected $baseRepo;

    public function __construct(MaterialCategoryModel $MaterialCategoryModel)
    {   
        $this->baseRepo = new BaseRepository($MaterialCategoryModel);
    }
}
