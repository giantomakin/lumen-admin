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
      return $this->jsonOutputSuccess('created');
    }
    catch (\Exception $e) {
       return $this->jsonOutputError($e->getMessage());
    }
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
