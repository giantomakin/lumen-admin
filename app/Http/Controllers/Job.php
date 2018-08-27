<?php
namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Job as JobModel;
use Illuminate\Http\Request;

class Job extends Controller
{ 
  protected $baseRepo;

  public function __construct(JobModel $JobModel)
  {   
    $this->baseRepo = new BaseRepository($JobModel);
  }

  public function create(Request $request)
  {
    $data = [
      'job_title' => $request->job_title,
      'job_description' => $request->job_description,
      'location' => $request->location
    ];

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
}
