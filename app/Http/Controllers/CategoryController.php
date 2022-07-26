<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCateList()
    {
        $cate = ProductType::all();
        return view('admin.category.list', ['cate' => $cate]);
    }
    public function getCateAdd()
    {
        return view('admin.category.add');
    }
    public function postCateAdd(Request $request)
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
                // 'name' => 'required|unique:type_products, name|min:3|max:100'
                'name' => 'required|min:3|max:100'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                // 'name.unique' => 'Tên thể loại đã tồn tại',
                'name.min' => 'Tên thể loại phải có độ dài nhất 3 cho đến 100 kí tự',
                'name.max' => 'Tên thể loại phải có độ dài nhất 3 cho đến 100 kí tự'

            ]
        );

        $cate = new ProductType;
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->image = $name;
        $cate->save();

        return redirect('/admin/category/add')->with('thongbao', 'Add successfully');
    }
    public function getCateEdit($id)
    {
        $cate = ProductType::find($id);
        return view('admin.category.edit', ['cate' => $cate]);
    }
    public function postCateEdit(Request $request, $id)
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
                // 'name' => 'required|unique:type_products, name|min:3|max:100'
                'name' => 'required|min:3|max:100'

            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                // 'name.unique' => 'Tên thể loại đã tồn tại',
                'name.min' => 'Tên thể loại phải có độ dài nhất 3 cho đến 100 kí tự',
                'name.max' => 'Tên thể loại phải có độ dài nhất 3 cho đến 100 kí tự'
            ]
        );
        $cate = ProductType::find($id);
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->image = $name;
        $cate->save();

        return redirect('/admin/category/edit/'.$cate->id)->with('thongbao', 'Modify successfully');
    }

    public function getCateDelete($id)
    {
        $cate = ProductType::find($id);
        $cate->delete();
        return redirect('/admin/category/list')->with('thongbao', 'Delete successfully');
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
