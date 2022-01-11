<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Niveis;
use App\models\Desenvolvedores;
use Response;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Niveis::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Niveis::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = new Niveis();
        return $level->find($id);
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
        $level = Niveis::find($id);
        $level->update($request->all());

        return $level;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developers = new Desenvolvedores();
        $count = $developers->numeroPorNivel($id);
        if($count >0){
        $returnData = array(
            'status' => 'error',
            'message' => 'Não é possivel excluir o nível. Existem desenvolvedores associados a ele'
        );
        return Response::json($returnData, 501);
        }

        return Niveis::destroy($id);
    }
}
