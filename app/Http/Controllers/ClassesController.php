<?php

namespace Desafio\Http\Controllers;

use Illuminate\Http\Request;
use Desafio\Classe;
use Validator;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::all();
        return response()->json($classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),[
          'nome' => 'required'
      ]);

      if($validator->fails()){
        return response()->json(['message' => $validator->messages(), 400]);
      } else {
        // Create Classe
        $classe = new Classe();
        $classe->fill($request->all());
        $classe->save();

        return response()->json($classe, 201);
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
        $classe = Classe::find($id);
        if (!$classe){
          return response()->json(['message'=>'Not found'], 404);
        }
        return response()->json($classe);
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
      $validator = Validator::make($request->all(),[
          'nome' => 'required'
      ]);

      if($validator->fails()){
        return response()->json(['message' => $validator->messages(), 400]);
      } else {
        // Find on Classe
        $classe = Classe::find($id);
        $classe->fill($request->all());
        $classe->save();

        return response()->json($classe);
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
      // Find on Classe
      $classe = Classe::find($id);
      if (!$classe){
        return response()->json(['message'=>'Not found'], 404);
      }
      $classe->delete();

      return response()->json(['message'=>'Classe apagada'], 200);

    }
}
