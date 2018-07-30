<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as Image;
use App\Models\Welcome;
use Datatables;
use DB;
use Input;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.welcome.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.welcome.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::begintransaction();
        try {
            $welcome = new Welcome();
            $welcome->title = $request->title;
            // $welcome->content = htmlspecialchars($request->konten);
            $welcome->content = $request->konten;
            $welcome->tags = $request->tags;
            $welcome->category = $request->category;
            // dd($welcome);
            $welcome->save();
        DB::commit();
        return Redirect::route('admin.welcome.index')->with('success', 'Success add new post');
        }
        catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.welcome.index')->with('error', 'Error add new post');
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
        $data['welcome'] = Welcome::find($id);
        return view('admin.welcome.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['welcome'] = Welcome::find($id);
        return view('admin.welcome.edit', $data);
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
         $welcome = Welcome::find($id);
         $this->validate($request, [
            'title' => 'required',
            ]);
         $welcome->title = $request->title;
         $welcome->content = $request->konten;
         $welcome->tags = $request->tags;
         // dd($welcome);
        $welcome->save();
        DB::commit();
      return Redirect::route('admin.welcome.index')->with('success', 'Post successfully updated!');
      } catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.welcome.index')->with('error', 'Post can not save to database!');
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
            Welcome::destroy($id);
            DB::commit();
        return Redirect::route('admin.welcome.index')->with('success', 'Post terhapus');
        }
        catch (Exception $e){
        DB::rollback();
        return Redirect::route('admin.welcome.index')->with('error', 'Post gagal terhapus');
        }
    }

    public function getData()
    {
      $welcome = Welcome::all();
      return Datatables::of($welcome)
      // ->addColumn('thumbnail',function($welcome){
      //   $img = '';
      //   if($welcome->image){
      //     $img = '<img src="'.asset("/images/slider/". $welcome->image).'" width="240" height="100">';
      //     }else{
      //         $img = '<img src="http://placehold.it/350x350" width="40" height="40">';
      //     }
      //     return $img;
      // })
      ->addColumn('active', function($welcome){
        $status = '';
        if($welcome->active){
          $status = 'Aktif';
          }else{
              $status = 'Tidak Aktif';
          }
          return $status;
      })
      ->addColumn('action','
          <a href="{!! route(\'admin.welcome.show\', $id) !!}">
              <i class="fa fa-search"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.welcome.edit\', $id) !!}">
              <i class="fa fa-edit"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.welcome.destroy\', $id) !!}" onclick =\'return confirm("Are you sure want to delete?")\'><i class="fa fa-trash"></i></a>
          {!! Form::close() !!}
          ')
      ->make(true);
    }
}
