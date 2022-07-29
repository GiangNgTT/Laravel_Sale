<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    public function getSlideList()
    {
        $slide = Slide::all();
        return view('admin.slide.list', ['slide' => $slide]);
    }
    public function getSlideAdd()
    {
        return view('admin.slide.add');
    }
    public function postSlideAdd(Request $request)
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
                'link' => 'required',
            ],
            [
                'link.required' => 'Bạn chưa nhập tiêu đề tin',
            ]
        );

        $slide = new Slide;
        $slide->link = $request->link;
        $slide->image = $name;
        $slide->save();

        return redirect('/admin/slide/add')->with('thongbao', 'Add successfully');
    }
    public function getSlideEdit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.edit', ['slide' => $slide]);
    }
    public function postSlideEdit(Request $request, $id)
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
            'link' => 'required',
        ],
        [
            'link.required' => 'Bạn chưa nhập đường dẫn',
        ]
        );
        $slide = Slide::find($id);
        $slide->link = $request->link;
        $slide->image = $name;
        $slide->save();

        return redirect('/admin/slide/edit/'.$slide->id)->with('thongbao', 'Modify successfully');
    }

    public function getSlideDelete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('/admin/slide/list')->with('thongbao', 'Delete successfully');
    }
}
