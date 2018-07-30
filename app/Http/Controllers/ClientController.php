<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as Image;
use App\Models\Client;
use Datatables;
use DB;
use Input;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
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
            $client = new Client();
            $this->validate($request, [
                'title' => 'required',
                'image' => 'required',
                ]);
            if($request->hasFile('image')){
            $file = Input::file('image');


            $name = $file->getClientOriginalName();
            $nm = str_replace(' ', '_', $name);
            $client->image = $nm;
            $path = public_path('images/client/'. $nm);

            $img  = Image::make($file->getRealPath());
            // $img->resize(1440, 717);
            $img->save($path);
          }
            $client->title = $request->title;
            $client->alt = $request->alt;
            $client->active = $request->active;
            $client->save();
        DB::commit();
        return Redirect::route('admin.client.index')->with('success', 'mantap');
        }
        catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.client.index')->with('error', 'error');
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
        $data['client'] = Client::find($id);
        return view('admin.client.show', $data);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['client'] = Client::find($id);
        return view('admin.client.edit', $data);
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
         $client = Client::find($id);
         $this->validate($request, [
            'title' => 'required',
            ]);
         $client->title = $request->title;
         $client->alt = $request->alt;
         $client->active = $request->active == 'TRUE' ? 'TRUE' : 'FALSE';

        if(empty($client->image)){
        }else{
           if($request->hasFile('image')){
              $file = Input::file('image');

              $name = $file->getClientOriginalName();
            $nm = str_replace(' ', '_', $name);
            $client->image = $nm;
            $path = public_path('images/client/'. $nm);

            $img  = Image::make($file->getRealPath());
            // $img->resize(1440, 717);
            $img->save($path);
          }
      }
      $client->save();
      DB::commit();
      return Redirect::route('admin.client.index')->with('success', 'Clien successfully updated!');
      } catch (Exception $e) {
        DB::rollback();
        return Redirect::route('admin.client.index')->with('error', 'Client can not update!');
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
            Client::destroy($id);
            DB::commit();
            return Redirect::route('admin.client.index')->with('success', 'Client successfully deleted!');
        } catch (Exception $e) {
           DB::rollback();
           return Redirect::route('admin.client.index')->with('error', 'Client can not deleted!');
       }
    }
    public function getData()
    {
      $client = Client::all();
      return Datatables::of($client)
      ->addColumn('thumbnail',function($client){
        $img = '';
        if($client->image){
          $img = '<img src="'.asset("/images/client/". $client->image).'" width="100" height="100">';
          }else{
              $img = '<img src="http://placehold.it/350x350" width="40" height="40">';
          }
          return $img;
      })
      ->addColumn('active', function($client){
        $status = '';
        if($client->active){
          $status = 'Aktif';
          }else{
              $status = 'Tidak Aktif';
          }
          return $status;
      })
      ->addColumn('action','
          <a href="{!! route(\'admin.client.show\', $id) !!}">
              <i class="fa fa-search"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.client.edit\', $id) !!}">
              <i class="fa fa-edit"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.client.destroy\', $id) !!}" onclick =\'return confirm("Are you sure want to delete?")\'><i class="fa fa-trash"></i></a>
          {!! Form::close() !!}
          ')
      ->make(true);
    }    
}
