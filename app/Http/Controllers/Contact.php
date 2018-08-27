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
