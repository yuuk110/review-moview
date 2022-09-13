<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews = Review::orderBy('created_at', 'DESC')->paginate(9);
        
        return view('index', compact('reviews'));
    }
    
    public function create()
    {
        //
        return view('review');

    }
    
    public function store(Request $request)
    {
        //
        
        $post = $request->all();
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        

        if ($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'cotent' => $post['content'], 'image' => $request->file('image')->hashName()];
        } else {
            $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'content' => $post['content']];
        }
        
        Review::insert($data);
        
        return redirect('/');
    }
    
    public function show($id)
    {
        //
        $review = Review::where('id', $id)->first();
         return view('show', compact('review'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = \App\Review::findOrFail($id);
        
        if (\Auth::id() === $review->user_id) {
            $micropost->delete();
        }
        
        return back();
    }
    
    public function shows($id)
    {
        $user = User::findOrFail($id);
        $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(9);
        
        return view('show', [
            'user' => $user,
            'reviews' => $reviews,
        ]);
    }
    
    public function users()
    {
        return view('users');
    }
    
    public function reviewshow()
    {
        
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(9);

            $data = [
                'user' => $user,
                'reviews' => $reviews,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('reviewshow', $data);
    }
    
}
