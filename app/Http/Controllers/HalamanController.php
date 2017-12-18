<?php

namespace App\Http\Controllers;

use App\Halaman;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    //
    public function __construct()
    {
      # code...
      $this->middleware('auth');
    }
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaman.index');
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
        $this->validate($request, [
            'judul'     => 'required',
            'isi'       => 'required'
        ]);
        $company = Halaman::create([
            'judul'     =>$request->judul,
            'slug'      =>str_slug($request->judul),
            'isi'       =>$request->isi,
            'meta'     =>$request->meta
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        //
        $halaman = Halaman::paginate(10);

        return $halaman;
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
        return Halaman::find($id);
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
        $this->validate($request, [
          'judul'     => 'required',
          'isi'       => 'required'
        ]);

        $halaman =   Halaman::find($id)->update([
          'judul'     =>$request->judul,
          'slug'      =>str_slug($request->judul),
          'isi'       =>$request->isi,
          'meta'     =>$request->meta
        ]);
        if ($halaman == true) {
            return response(200);
        }
        else {
            return response(500);
        }

    }
    public function search(Request $request)
    {
        //
        $halaman =  Halaman::where('judul','LIKE',"%$request->q%")->get();
        return $halaman;
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
        $halaman =  Halaman::destroy($id);
        return $halaman;
    }
}
