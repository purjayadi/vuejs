<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function __construct()
    {
      # code...
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('menu.index');
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
        $this->validate($request, [
              'name'  => 'required',
        ]);
        $menu = Menu::create([
              'parent'  =>$request->parent,
              'name'    =>$request->name,
              'order'   =>$request->order,
              'link'    =>$request->link
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
        $menu = Menu::paginate(10);

        return $menu;
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
        return Menu::find($id);
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
            'name'    => 'required'
        ]);
        $menu = Menu::find($id)->update([
            'parent'  =>$request->parent,
            'name'    =>$request->name,
            'order'   =>$request->order,
            'link'    =>$request->link
        ]);
        if ($menu == true) {
            return response(200);
        }
        else{
            return response(500);
        }
    }

    public function search(Request $request)
    {
      # code...
      $menu =  Menu::where('name','LIKE',"%$request->q%")->get();
      return $menu;
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
        $menu = Menu::destroy($id);
        return $menu;
    }

    public function getmenu(): JsonResponse
     {
       $menu = Menu::all();
       $data = [];
       $data[0] = [
           'id'   => 0,
           'name' =>'Select',
       ];

       foreach ($menu as $key => $value) {
           $data[$key+1] =[
               'id'   => $value->id,
               'name' => $value->name,
           ];
           # code...
       }

       return response()->json($data);
     }
}
