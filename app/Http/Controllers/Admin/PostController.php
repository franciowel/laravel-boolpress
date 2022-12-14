<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();

        $request_info = $request->all();
        $show_deleted_message = isset($request_info['deleted']) ? $request_info['deleted'] : null;
        
        $data = [
            'posts' => $posts,
            'show_deleted_message' => $show_deleted_message
        ];
        
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $data = [
            'categories' => $categories
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $form_data = $request->all();
        
        $new_post = new Post();
        $new_post->fill($form_data);

        $new_post->slug = $this->getFreeSlugFromTitle($new_post->title);

        $new_post->save();

        return redirect()->route('admin.posts.show', ['post'=>$new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::findOrFail($id);

        $now = Carbon::now();
        $created_days_ago = $post->created_at->diffInDays($now);

        $data = [
            'post' => $post,
            'created_days_ago' => $created_days_ago
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $categories = Category::all();

        $data = [
            'post' => $post,
            'categories' => $categories
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->getValidationRules());

        $form_data = $request->all();

        $post_to_update = Post::findOrFail($id);

        if ($form_data['title'] !== $post_to_update->title) {
            $form_data['slug'] = $this->getFreeSlugFromTitle($form_data['title']);
        }else{
            $form_data['slug'] = $post_to_update->slug;
        }

        $post_to_update->update($form_data); 

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pos_to_delete = Post::findOrFail($id);
        $pos_to_delete->delete();

        return redirect()->route('admin.posts.index', ['deleted' => 'yes']);
    }

    protected function getFreeSlugFromTitle($title) {
        // SLUG
        $slug_to_save = Str::slug($title, '-');

        $slug_base = $slug_to_save;

        $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

        // CICLO DI VERIFICA E STAMPA SLUG
        $counter= 1;
        
        while($existing_slug_post) {
            $slug_to_save = $slug_base . '-' . $counter;

            $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

            $counter++;
        }

        return $slug_to_save;
    }

    protected function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
        ];
    }
}
