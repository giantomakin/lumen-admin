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

        return $this->baseRepo->create($data);
    }
    
    public function find($id)
    {
      return $this->baseRepo->find($id);
    }

    public function findBy($att, $column)
    {
      return $this->baseRepo->where($att, $column);
    }

    public function all()
    {
      return $this->baseRepo->all();
    }

    public function delete($id)
    {
      return $this->baseRepo->delete($id);
    }

}
