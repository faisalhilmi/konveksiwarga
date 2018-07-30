<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image as Image;
use App\Models\Testimoni;
use Datatables;
use DB;
use Input;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.testimoni.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimoni.create');
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
            $testi = new Testimoni();
            $this->validate($request, [
                'author' => 'required',
                'company' => 'required',
                'testi' => 'required'
                ]);
            $testi->author = $request->author;
            $testi->company = $request->company;
            $testi->testi = $request->testi;
            $testi->save();
        DB::commit();
        return Redirect::route('admin.testimoni.index')->with('success', 'mantap');
        }
        catch(Exception $e) {
        DB::rollback();
        return Redirect::route('admin.testimoni.index')->with('error', 'erorcuyy');
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
      $testi = Testimoni::all();
      return Datatables::of($testi)
      ->addColumn('action','
          <a href="{!! route(\'admin.testimoni.show\', $id) !!}">
              <i class="fa fa-search"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.testimoni.edit\', $id) !!}">
              <i class="fa fa-edit"></i>
          </a>&nbsp &nbsp
          <a href="{!! route(\'admin.testimoni.destroy\', $id) !!}" onclick =\'return confirm("Are you sure want to delete?")\'><i class="fa fa-trash"></i></a>
          {!! Form::close() !!}
          ')
      ->make(true);
    }   
}
