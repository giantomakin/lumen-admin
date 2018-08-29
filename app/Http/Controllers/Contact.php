<?php
namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Contact as ContactModel;
use Illuminate\Http\Request;

class Contact extends Controller
{ 
    protected $baseRepo;

    public function __construct(ContactModel $ContactModel)
    {   
        $this->baseRepo = new BaseRepository($ContactModel);
    }

    public function create(Request $request)
    {
        $data = [
                  'city' => $request->city,
                  'address' => $request->address,
                  'state' => $request->state,
                  'phone' => $request->phone,
                  'fax' => $request->fax,
                  'email' => $request->email,
                  'hours_weekdays' => $request->hours_weekdays,
                  'hours_weekend' => $request->hours_weekend,
                  'location_image' => $request->location_image,
                  'contact_meta_description' => $request->contact_meta_description,
                  'contact_meta_title' => $request->contact_meta_title,
                  'slug' => $request->slug
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
