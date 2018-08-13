<?php

namespace Desafio\Http\Controllers;

use Illuminate\Http\Request;
use Desafio\Heroi;
use Desafio\Especialidade;
use Validator;

class HeroisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $herois = Heroi::all();
      $herois->load('classe', 'especialidades');
      return response()->json($herois);
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
      $validator = Validator::make($request->all(),[
          'nome' => 'required',
          'vida' => 'required',
          'dano' => 'required',
          'defesa' => 'required',
          'velocidade_ataque' => 'required',
          'velocidade_movimento' => 'required',
          'classe_id' => 'required'
       ]);

      if($validator->fails()){
        return response()->json(['message' => $validator->messages(), 400]);
      } else {
        // Create Heroi
        $heroi = new Heroi();
        $heroi->fill($request->all());
        $especialidades = Especialidade::find($request->input('especialidades'));
        $heroi->especialidades()->attach($especialidades);
        $heroi->save();

        return response()->json($request->all(), 201);
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
      $heroi = Heroi::find($id);
      if (!$heroi){
        return response()->json(['message'=>'Not found'], 404);
      }
      $heroi->load('classe', 'especialidades');
      return response()->json($heroi);
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
          'nome' => 'required',
          'vida' => 'required',
          'dano' => 'required',
          'defesa' => 'required',
          'velocidade_ataque' => 'required',
          'velocidade_movimento' => 'required',
          'classe_id' => 'required'
       ]);

      if($validator->fails()){
        return response()->json(['message' => $validator->messages(), 400]);
      } else {
        // Create Heroi
        $heroi = Heroi::find($id);
        $heroi->load('classe', 'especialidades');
        $heroi->fill($request->all());
        $especialidades = Especialidade::find($request->input('especialidades'));
        $heroi->especialidades()->sync($especialidades);
        $heroi->save();
        return response()->json($heroi, 201);
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
      // Find on Heroi
      $heroi = Heroi::find($id);
      if (!$heroi){
        return response()->json(['message'=>'Not found'], 404);
      }
      $heroi->especialidades()->sync([]);
      $heroi->save();
      $heroi->delete();
      return response()->json(['message'=>'Heroi apagada'], 200);
    }
}
