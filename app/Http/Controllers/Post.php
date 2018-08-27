<?php
namespace App\Http\Controllers;

use App\Repositories\BaseRepository as BaseRepository;
use App\Models\Post as PostModel;
use Illuminate\Http\Request;

class Post extends Controller
{ 
    protected $baseRepo;

    public function __construct(PostModel $PostModel)
    {   
        $this->baseRepo = new BaseRepository($PostModel);
    }

   public function create(Request $request)
   {
       $data = [
                 'site' => $request->site,
                 'views' => $request->views,
                 'slider' => $request->slider,
                 'post_title' => $request->post_title,
                 'is_scheduled' => $request->is_scheduled,
                 'author' => $request->author,
                 'page_title' => $request->page_title,
                 'page_content' => $request->page_content,
                 'post_excerpt' => $request->post_excerpt,
                 'aproved' => $request->aproved,
                 'post_name' => $request->post_name,
                 'post_category' => $request->post_category,
                 'post_keywords' => $request->post_keywords,
                 'comment_id' => $request->comment_id,
                 'post_thumbnail' => $request->post_thumbnail,
                 'homepage_color' => $request->homepage_color,
                 'scheduled_at' => $request->scheduled_at,
                 'created_at' => $request->created_at,
                 'updated_at' => $request->updated_at,
                 'homepage' => $request->homepage
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
