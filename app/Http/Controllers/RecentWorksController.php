<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as Image;
use App\Models\RecentWork;
use Datatables;
use DB;
use Input;

class RecentWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.recentwork.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recentwork.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $recent = new RecentWork;
            $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            ]);
            $recent->title = $request->title;
        if($request->hasFile('image')){
            $file = Input::file('image');
            $name = $file->getClientOriginalName();
            $nm = str_replace(' ', '_', $name);
            $recent->image = $nm;
            $path = public_path('images/recentwork/'. $nm);
            $img  = Image::make($file->getRealPath());
            // $img->resize(1440, 717);
            $img->save($path);
            }
            $recent->description = $request->description;
            $recent->alt = $request->alt;
            $recent->active = $request->active;
            // dd($recent);
            $recent->save();
        DB::commit();
        return Redirect::route('admin.recentworks.index')->with('success', 'mantap');
        }
        catch (Exception $e) {
            DB::rollback();
        return Redirect::route('admin.recentworks.index')->with('error', 'wial');
        }
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

    public function getData()
    {
      $recent = RecentWork::all();
      return Datatables::of($recent)
      ->addColumn('thumbnail',function($recent){
        $img = '';
        if($recent->image){
          $img = '<img src="'.asset("/images/recentwork/". $recent->image).'" width="140" height="200">';
          }else{
              $img = '<img src="http://placehold.it/350x350" width="40" height="40">';
          }
          return $img;
      })
      ->addColumn('active', function($recent){
        $status = '';
        if($recent->active){
          $status = 'Aktif';
          }else{
              $status = 'Tidak Aktif';
          }
          return $status;
      })
      ->addColumn('action','
          <a href="{!! route(\'admin.slider.show\', $id) !!}">
              <i class="fa fa-search"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.slider.edit\', $id) !!}">
              <i class="fa fa-edit"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.slider.destroy\', $id) !!}" onclick =\'return confirm("Are you sure want to delete?")\'><i class="fa fa-trash"></i></a>
          {!! Form::close() !!}
          ')
      ->make(true);
    }
}
