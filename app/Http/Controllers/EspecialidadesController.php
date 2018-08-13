<?php

namespace Desafio\Http\Controllers;

use Illuminate\Http\Request;
use Desafio\Especialidade;
use Validator;

class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $especialidade = Especialidade::all();
      return response()->json($especialidade);
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
        // Create Especialidade
        $especialidade = new Especialidade();
        $especialidade->fill($request->all());
        $especialidade->save();

        return response()->json($especialidade, 201);
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
      $especialidade = Especialidade::find($id);
      if (!$especialidade){
        return response()->json(['message'=>'Not found'], 404);
      }
      return response()->json($especialidade);
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
        // Find on Especialidade
        $especialidade = Especialidade::find($id);
        $especialidade->fill($request->all());
        $especialidade->save();

        return response()->json($especialidade);
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
      // Find on Especialidade
      $especialidade = Especialidade::find($id);
      if (!$especialidade){
        return response()->json(['message'=>'Not found'], 404);
      }
      $especialidade->delete();

      return response()->json(['message'=>'Especialidade apagada'], 200);
    }
}
