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

    public function getMaterialsByCategory($id)
    {   
        try {
          $result = $this->baseRepo->find($id)->materials;
          return response()->json(['status' => 'success','data' => $result], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => ['code' => 400, 'message' => $e->getMessage()]
            ], 400);
        }

    }
}
