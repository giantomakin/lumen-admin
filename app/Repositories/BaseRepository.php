<?php 

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{   
    protected $model;

    public function __construct(Model $model)
    {
      $this->model = $model;
    }

    public function create(array $data)
    {
      return $this->model->create($data);
    }

    public function find($id)
    {
      return $this->model->find($id);
    }

    public function findBy($att, $column)
    {
      return $this->model->where($att, $column);
    }

    public function all()
    {
      return $this->model->all();
    }

    public function delete($id)
    {
      return $this->model->destroy($id);
    }
}