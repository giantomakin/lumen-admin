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

    public function find($id)
    {
      try {
          $result = $this->baseRepo->find($id);
          return $this->jsonOutputSuccess($result);
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }

    public function findBy($att, $column)
    {
      try {
        $result = $this->baseRepo->findBy($att, $column);
        return $this->jsonOutputSuccess($result);
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }

    public function all()
    {
      try {
          $result = $this->baseRepo->all();
          return $this->jsonOutputSuccess($result);
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }

    public function delete($id)
    {
      try {
          $this->baseRepo->destroy($id);
          return $this->jsonOutputSuccess('deleted');
      }
      catch (\Exception $e) {
          return $this->jsonOutputError($e->getMessage());
      }
    }
}
