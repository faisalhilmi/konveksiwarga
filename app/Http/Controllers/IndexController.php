<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecentWork;
use App\Models\Client;
use App\Models\Testimoni;
use App\Models\SocialMedia;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $image = RecentWork::all();
    $imagesDir = 'images/home/';
    $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    $randomImage = $images[array_rand($images)];
    $client = Client::all();
    $testi = Testimoni::all();
    $insta = SocialMedia::where('type', 'instagram')->first();
    $fb = SocialMedia::where('type', 'facebook')->first();
    $twitter = SocialMedia::where('type', 'twitter')->first();
    // dd($randomImage);
    // dd($image->image);
    return view('welcome', ['gambar' => $image, 'randomImage' => $randomImage, 'client' => $client, 'testi' => $testi, 'insta' => $insta, 'fb' => $fb, 'twitter' => $twitter]);
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
        //
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
