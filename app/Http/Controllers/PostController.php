<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index', [
            'title' => 'Post Keterangan',
            'post' => Post::orderby('id', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create', [
            'title' => 'Tambah Post Keterangan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'code' => 'required',
            'name' => 'required|max:255',
            'det_post' => 'required',
            'srn_post' => 'required'
        ]);

        Post::create([
            'code' => $request->code,
            'name' => $request->name,
            'det_post' => $request->det_post,
            'srn_post' => $request->srn_post
        ]);

        return redirect()->route('post.index')->with('status', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('post.edit', [
            'title' => 'Edit Post Keterangan',
            'post' => Post::find($id)
        ]);
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
        $request->validate([
            'name' => 'required|max:255',
            'det_post' => 'required',
            'srn_post' => 'required'
        ]);


        Post::where('id', $id)->update([
            'name' => $request->name,
            'det_post' => $request->det_post,
            'srn_post' => $request->srn_post
        ]);

        return redirect()->route('post.index')->with('status', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('post.index')->with('status', 'Data Berhasil Dihapus!');
    }
}
