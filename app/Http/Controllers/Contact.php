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
