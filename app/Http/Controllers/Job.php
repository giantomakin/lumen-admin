<?php
namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Job as JobModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Job extends Controller
{ 
    protected $baseRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
              'message' => 'created'
          ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function find($id)
    {
      try {
        $job = $this->baseRepo->find($id);
        return response()->json($job, 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }

    public function findBy($att, $column)
    {
      try {
        $job = $this->baseRepo->where($att, $column);
        return response()->json($job, 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }

    public function all()
    {
      try {
        $jobs = $this->baseRepo->all();
        return response()->json($jobs, 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }

    public function delete($id)
    {
      try {
        //$this->baseRepo->delete($id);
        return response()->json([
            'message' => "deleted job with id: {$id}"
        ], 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }
}
