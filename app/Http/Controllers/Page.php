<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Page as PageModel;
use Illuminate\Http\Request;


class Page extends Controller
{
    protected $baseRepo;

    public function __construct(PageModel $PageModel)
    {   
        $this->baseRepo = new BaseRepository($PageModel);
    }

    public function create(Request $request)
    {
      $data = $request->all();
      try {
        $this->baseRepo->create($data);
        return response()->json([
          'status' => 'success',
          'message' => 'created'
        ], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

    public function find($id)
    {
      try {
        $result = $this->baseRepo->find($id);
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

    public function findBy($att, $column)
    {
      try {
        $result = $this->baseRepo->findBy($att, $column);
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

    public function all()
    {
      try {
        $result = $this->baseRepo->all();
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

    public function delete($id)
    {
      try {
        $this->baseRepo->destroy($id);
        return response()->json([
          'status' => 'success',
          'message' => "deleted"
        ], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

    public function staticPage($slug)
    { 
      try {
        $result = $this->baseRepo->findBy('page_slug', $slug);
        return response()->json(['status' => 'success','data' => $result], 200);
      }
      catch (\Exception $e) {
        return response()->json([
          'error' => ['code' => 400, 'message' => $e->getMessage()]
        ], 400);
      }
    }

}
