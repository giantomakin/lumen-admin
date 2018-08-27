<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Material as MaterialModel;
use Illuminate\Http\Request;


class Material extends Controller
{
    protected $baseRepo;

    public function __construct(MaterialModel $MaterialModel)
    {   
        $this->baseRepo = new BaseRepository($MaterialModel);
    }
}
