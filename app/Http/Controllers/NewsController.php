<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getNewsList()
    {
        $news_cate = News::all();
        return view('admin.news.list', ['news_cate' => $news_cate]);
    }
    public function getNewsAdd()
    {
        return view('admin.news.add');
    }
    public function postNewsAdd(Request $request)
    {

        $name = '';

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/source/image/');
            $file->move($destinationPath, $name);
        }

        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required',
            ],
            [
                'title.required' => 'Bạn chưa nhập tiêu đề tin',
                'content.required' => 'Bạn chưa nhập nội dung',
            ]
        );

        $news_cate = new News;
        $news_cate->title = $request->title;
        $news_cate->content = $request->content;
        $news_cate->image = $name;
        $news_cate->save();

        return redirect('/admin/news/add')->with('thongbao', 'Add successfully');
    }
    public function getNewsEdit($id)
    {
        $news_cate = News::find($id);
        return view('admin.news.edit', ['news_cate' => $news_cate]);
    }
    public function postNewsEdit(Request $request, $id)
    {
        $name = '';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/source/image/');
            $file->move($destinationPath, $name);
        }

        $this->validate($request,
        [
            'title' => 'required',
            'content' => 'required',
        ],
        [
            'title.required' => 'Bạn chưa nhập tiêu đề tin',
            'content.required' => 'Bạn chưa nhập nội dung',
        ]
        );
        $news_cate = News::find($id);
        $news_cate->title = $request->title;
        $news_cate->content = $request->content;
        $news_cate->image = $name;
        $news_cate->save();

        return redirect('/admin/news/edit/'.$news_cate->id)->with('thongbao', 'Modify successfully');
    }

    public function getNewsDelete($id)
    {
        $news_cate = News::find($id);
        $news_cate->delete();
        return redirect('/admin/news/list')->with('thongbao', 'Delete successfully');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
    }
}
