<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as Image;
use App\Models\SocialMedia;
use Datatables;
use DB;
use Input;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.socialmedia.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.socialmedia.create');
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
            $socmed = new SocialMedia();
            $this->validate($request, [
                'type' => 'required']);
            $socmed->type = $request->type;
            $socmed->address = $request->address;
            $socmed->save();
        DB::commit();
        return Redirect::route('admin.socialmedia.index')->with('success', 'ntap');
        }
        catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.socialmedia.index')->with('error', 'uy');
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
        $data['socmed'] = SocialMedia::find($id);
        return view('admin.socialmedia.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['socmed'] = SocialMedia::find($id);
        return view('admin.socialmedia.edit', $data);
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
            $socmed = SocialMedia::find($id);
            $this->validate($request, [
                'type' => 'required']);
            $socmed->type = $request->type;
            $socmed->address = $request->address;
            $socmed->save();
        DB::commit();
        return Redirect::route('admin.socialmedia.index')->with('success', 'ntap');
        }
        catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.socialmedia.index')->with('error', 'uy');
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
            SocialMedia::destroy($id);
            DB::commit();
            return Redirect::route('admin.socialmedia.index')->with('success', 'Social Media successfully deleted!');
        } catch (Exception $e) {
           DB::rollback();
           return Redirect::route('admin.socialmedia.index')->with('error', 'Social Media can not deleted!');
       }
    }

    public function getData()
    {
      $socmed = SocialMedia::all();
      return Datatables::of($socmed)
      ->addColumn('action','
          <a href="{!! route(\'admin.socialmedia.show\', $id) !!}">
              <i class="fa fa-search"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.socialmedia.edit\', $id) !!}">
              <i class="fa fa-edit"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.socialmedia.destroy\', $id) !!}" onclick =\'return confirm("Are you sure want to delete?")\'><i class="fa fa-trash"></i></a>
          {!! Form::close() !!}
          ')
      ->make(true);
    }
}
