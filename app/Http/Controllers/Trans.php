<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Trans extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //insert transaction data
        $menu = ['seblak','mie ayam','nasi goreng','kebab','baso','nasi padang','jus','kopi','cilok','sop buah','ayam geprek','ayam penyet'];
        DB::table('trans')->insert(['menu'=>array_rand($menu,1),'alamat'=>$request->a,'coordinat'=>$request->c]);
        $count = DB::table('trans')->count();

        return $count;
    }

    public function filter(Request $request){
        if($request->f =='menu'){

            $filter = 'menu';
        } else {
            $filter = 'alamat';
        }
        $data = DB::table('trans')->groupBy($filter)->select(DB::raw('count('.$filter.') as count, '.$filter.' as result'))->orderBy('count','desc')->get();

        return response()->json($data);
    }

    public function search(Request $request){
        if($request->f =='menu'){

            $filter = 'menu';
        } else {
            $filter = 'alamat';
        }
        $data = DB::table('trans')->groupBy($filter)
                ->select(DB::raw('count('.$filter.') as count, '.$filter.' as result'))
                ->where($filter,'like', '%'.$request->s.'%')
                ->orderBy('count','desc')->get();

        return response()->json($data);
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
