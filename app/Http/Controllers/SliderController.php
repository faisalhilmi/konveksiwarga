<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as Image;
use App\Models\Slider;
use Datatables;
use DB;
use Input;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      DB::beginTransaction();
      try {
         $image = new Slider();
         $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            ]);
         $image->title = $request->title;
         $image->description = $request->description;
         $image->active = $request->active;
         if($request->hasFile('image')){
            $file = Input::file('image');


            $name = $file->getClientOriginalName();
            $nm = str_replace(' ', '_', $name);
            $image->image = $nm;
            $path = public_path('images/slider/'. $nm);

            $img  = Image::make($file->getRealPath());
            $img->resize(1440, 717);
            $img->save($path);
          }
        $image->save();
        DB::commit();
        return Redirect::route('admin.slider.index')->with('success', 'Slide successfully added!');
      } catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.slider.index')->with('error', 'Slide can not save to database!');
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
        $data['slider'] = Slider::find($id);
        return view('admin.slider.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['slider'] = Slider::find($id);
        return view('admin.slider.edit',$data);
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
        DB::beginTransaction();
        try {
         $image = Slider::find($id);
         $this->validate($request, [
            'title' => 'required',
            ]);
         $image->title = $request->title;
         $image->description = $request->description;
         $image->active = $request->active == 'TRUE' ? 'TRUE' : 'FALSE';

        if(empty($image->image)){
        }else{
           if($request->hasFile('image')){
              $file = Input::file('image');

              $name = $file->getClientOriginalName();
            $nm = str_replace(' ', '_', $name);
            $image->image = $nm;
            $path = public_path('images/slider/'. $nm);

            $img  = Image::make($file->getRealPath());
            $img->resize(1440, 717);
            $img->save($path);
          }
      }
      $image->save();
      DB::commit();
      return Redirect::route('admin.slider.index')->with('success', 'Slide successfully added!');
      } catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.slider.index')->with('error', 'Slide can not save to database!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Slider::destroy($id);
            DB::commit();
            return Redirect::route('admin.slider.index')->with('success', 'Slide successfully added!');
        } catch (Exception $e) {
           DB::rollback();
           return Redirect::route('admin.slider.index')->with('error', 'Slide can not save to database!');
       }
    }

    public function getData()
    {
      $slider = Slider::all();
      return Datatables::of($slider)
      ->addColumn('thumbnail',function($slider){
        $img = '';
        if($slider->image){
          $img = '<img src="'.asset("/images/slider/". $slider->image).'" width="240" height="100">';
          }else{
              $img = '<img src="http://placehold.it/350x350" width="40" height="40">';
          }
          return $img;
      })
      ->addColumn('active', function($slider){
        $status = '';
        if($slider->active){
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
