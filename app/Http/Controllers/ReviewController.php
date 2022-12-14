<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Review;

use Storage;

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
            'recommend' => 'required|integer|min:1|max:5',
            'image' => ['mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'required',
                        'file',
                       ]
        ]);
        
        

        if ($request->hasFile('image')) {
            $request->file('image')->store('/public/uploads');
            $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'recommend' => $post['recommend'], 'content' => $post['content'], 'image' => $request->file('image')->hashName()];
        } else {
            $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'recommend' => $post['recommend'], 'content' => $post['content']];
        }
        
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('/uploads', $image, 'public');
        
        
        $image = basename($path);
        
        Review::insert($data);
        
        return redirect('reviewshow');
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
        $review = Review::find($id);
        return view('edit', compact('review'));
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
        $review = Review::where('id', $id)->first();
        
        $review->update([
            'title' => $request->title,
            'recommend' => $request->recommend,
            'content' => $request->content,
            'image' => $request->file('image')->hashName(),
        ]);
        
        $image = $request->file('image');
        
        
         
        $path = Storage::disk('s3')->putFile('/uploads', $image, 'public');
        $image = basename($path);
        
        return redirect('reviewshow');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        if (\Auth::id() === $review->user_id) {
            $review->delete();
        }
        return redirect('reviewshow');
       
    }
    
    
    
    
    public function reviewshow()
    {
        
        $data = [];
        if (\Auth::check()) { // ?????????????????????
            // ??????????????????????????????
            $user = \Auth::user();
            // ????????????????????????????????????????????????????????????
            $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(9);

            $data = [
                'user' => $user,
                'reviews' => $reviews,
            ];
        }

        // Welcome??????????????????????????????
        return view('reviewshow', $data);
    }
    
    public function usersreview()
    {
        $reviews = Review::orderBy('created_at', 'DESC')->paginate(9);
        
        return view('usersreview', compact('reviews'));
    }
    
    
    
    
    
}
