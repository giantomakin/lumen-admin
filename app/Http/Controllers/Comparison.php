<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Comparison as ComparisonModel;
use Illuminate\Http\Request;


class Comparison extends Controller
{
    protected $baseRepo;

    public function __construct(ComparisonModel $ComparisonModel)
    {   
        $this->baseRepo = new BaseRepository($ComparisonModel);
    }
}
