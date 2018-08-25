<?php
namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Contact as ContactModel;
use Illuminate\Support\Facades\Hash;
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
        $contact = $this->baseRepo->find($id);
        return response()->json($contact, 200);
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
        $contact = $this->baseRepo->where($att, $column);
        return response()->json($contact, 200);
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
        $contacts = $this->baseRepo->all();
        return response()->json($contacts, 200);
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
            'message' => "deleted contact with id: {$id}"
        ], 200);
      }
      catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage()
          ], 400);
      }
    }
}
