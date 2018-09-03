<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //列表
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('/post/index', compact('posts'));
    }
    //详情
    public function show(Post $post) {
        return view('/post/show', compact('post'));
    }
    //创建
    public function create() {
        return view('/post/create');
    }
    //创建逻辑
    public function store() {
        //验证
        $this ->validate(request(),[
           'title' => 'required|string|max:100|min:5',
           'content' => 'required|string|min:10',
        ]);

        //逻辑
        $user_id = Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        Post::create($params);
        //渲染
        return redirect("/posts");
    }
    //编辑页面
    public function edit(Post $post) {
        return view("post/edit", compact('post'));
    }
    //编辑逻辑
    public function update(Post $post) {
        //验证
        $this ->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);
        $this->authorize('update', $post);
        //逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //渲染
        return redirect("/posts/{$post->id}");
    }
    //删除逻辑
    public function delete(Post $post) {
        $post->delete();
        return redirect('/posts');
    }
    //图片上传
    public function imageUpload(Request $request) {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }
}
