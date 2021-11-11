<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBlogRequest;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\StoreBlogscommentRequest;

use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\Blogscomment;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BlogsController extends Controller
{

    public function index($category_id)
    {
       // $blogs = Blog::with(['categories', 'tags', 'media'])
         //   ->join('content_categories', 'content_categories.id', '=', $category_id)->get();
        $blogs = DB::table('blog_content_category')->select('blog_id')
            ->where('content_category_id',$category_id)->pluck('blog_id')->toArray();
        $blogs=Blog::with(['categories', 'tags', 'media'])->whereIn('id',$blogs)->orderBy('id','DESC')->paginate(10);
        $ContentCategory = ContentCategory::get();
            //dd($blogs->toArray());
        // return view('frontend.blogs')->with('ContentCategory', $ContentCategory)
            // ->with('blogs', $blogs);
        return view('frontend.blogs_list')->with('ContentCategory', $ContentCategory)
            ->with('blogs', $blogs);
    }
    public function view($article_id)
    {
        $article = Blog::where('id', $article_id)->with('blogBlogscomments')->first();
        $article_arr = $article->toArray();

        $all_comments = [];
        $approved_comments = [];
        if(!empty($article_arr['blog_blogscomments'])){
            $all_comments = $article_arr['blog_blogscomments'];
        }
        foreach ($all_comments as $k => $v) {
            if($v['approved']==1){
                $approved_comments[]=$v;
            }
        }
        // print_r($approved_comments);die;


        $ContentCategory = ContentCategory::get();

        return view('frontend.article')->with('ContentCategory', $ContentCategory)
            ->with('blog', $article)->with('approved_comments', $approved_comments);
    }
    public function storeComment(StoreBlogscommentRequest $request)
    {
        $blogscomment = Blogscomment::create($request->all());

        if ($request->input('image', false)) {
            $blogscomment->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $blogscomment->id]);
        }

        return redirect()->route('admin.blogscomments.index');
    }

    public function comment_create(StoreBlogscommentRequest $request)
    {
        $all_request_data = $request->all();
        if(empty($all_request_data["name"]) || empty($all_request_data["email"]) || empty($all_request_data["phone"]) || empty($all_request_data["comment"])){
            return redirect('/blogs/view/'.$all_request_data['blog_id'])->withFail('Please fill the required data.');
        }


        $secretKey = "6LenjiEbAAAAAKxtYgQIxZpGtp9iw_ZuO2nWc6rR";
        $captcha = $all_request_data['g-recaptcha-response'];
        $url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $responseKeys = json_decode($output,true);
        if($responseKeys['success']==1){

        }else{
            return redirect('/blogs/view/'.$all_request_data['blog_id'])->withFail('Captcha error. Pls re-submit the page again.');
        }

        
        $blogscomment = Blogscomment::create($all_request_data);
        return redirect('/blogs/view/'.$all_request_data['blog_id'])->withSuccess('Your comment has been sent successfully. It will appear once we revise it.');

        // return Redirect::to("/")->withFail('Error message');
        
    }

}
