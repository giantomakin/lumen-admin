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
