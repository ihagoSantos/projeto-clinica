<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Procedimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AtendimentoController extends Controller
{
    /**
     * Retorna lista de atendimentos cadastrados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'data' => Atendimento::with(['profissional', 'paciente','procedimentos'])->get()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "error when searching attendances",
                'error' => $th
            ], 500);
        }
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
     * Cria um novo atendimento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $validator = $this->getValidator($request->all());
            // caso a validação falhe, retorna erro
            if($validator->fails()){
                return response()->json([
                    "message" => "error when registering attendance",
                    'errors' => $validator->errors()
                ], 400);
            }else{

                $atendimento = Atendimento::create($request->only([
                    'profissional_id','paciente_id','data_hora_atendimento'
                ]));

                $atendimento->procedimentos()->createMany($request['procedimentos']);
                return response()->json([
                    'message' => 'attendance created successfully'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "error when registering attendance",
                'errors' => $th
            ], 500);
        }
        
    }

    /**
     * Função que valida os inputs e retorna objeto da validação
     * @return Illuminate\Support\Facades\Validator $validator
     */
    public function getValidator($request) {
        //validação dos inputs de cadastro
        $validator = Validator::make($request, [
            'profissional_id' => ['required','integer'],
            'paciente_id' => ['required','integer'],
            'data_hora_atendimento' => ['required','date_format:Y-m-d H:i:s', 'after:today'],
            'procedimentos' => ['required','array'],
            'procedimentos.*.nome' => ['required','string'],
            'procedimentos.*.valor' => ['required','numeric'],
        ]);

        return $validator;
    }

    /**
     * Retorna um atendimento específico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            
            return response()->json([
                "data" => Atendimento::with(['profissional','paciente','procedimentos'])->find($id)
            ], 200);
        
            
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "error when searching attendance",
                "error" => $th
            ], 500);
        }
    }

    /**
     * Atualiza o atendimento informado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            
            $validator = $this->getValidator($request->all());
            // caso a validação falhe, retorna erro
            if($validator->fails()){
                return response()->json([
                    "message" => "error when registering attendance",
                    'errors' => $validator->errors()
                ], 400);
            }else{

                // atualiza dados do atendimento
                $atendimento = Atendimento::with(['profissional','paciente','procedimentos'])->find($id);
                $atendimento->profissional_id = $request['profissional_id'];
                $atendimento->paciente_id = $request['paciente_id'];
                $atendimento->data_hora_atendimento = $request['data_hora_atendimento'];
                
                // remove procedimentos cadastrados anteriormente
                Procedimento::where('atendimento_id', $atendimento->id)->delete();
                // cadastra novos procedimentos 
                $atendimento->procedimentos()->createMany($request['procedimentos']);
                // salva atendimento
                $atendimento->save();
                
                return response()->json([
                    'message' => 'attendance updated successfully'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "error when registering attendance",
                'errors' => $th
            ], 500);
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
        //
    }
}
