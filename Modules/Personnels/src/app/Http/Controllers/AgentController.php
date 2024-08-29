<?php
namespace Dtic\Personnels\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Dtic\Personnels\app\Models\Agent;
use Illuminate\Support\Facades\Validator;
use Exception;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agent = Agent::all();
        return response()->json([
            "success"=>true,
            "message"=>"Liste des agents",
            "data"=>$agent
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {

        $rules = [
            'telephone' => 'nullable|string|max:15',
            'mail' => 'nullable|string|max:100',
            'nationailite_etrangere' => 'nullable|string|max:100'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>collect($validator->errors())->flatten(),
            ],500);
        }
        
        try {
            $agent = new Agent;
            $agent->telephone = $request->telephone;
            $agent->mail = $request->mail;
            $agent->nationailite_etrangere = $request->nationailite_etrangere;
            // $agent->id_structure = $request->id_structure;
            // $agent->id_profession = $request->id_profession;
            // $agent->id_nationalite = $request->id_nationalite;
            $agent->save();
            return response()->json([
                "success"=>true,
                "message"=>"Agent créé avec succès",
                "data"=>$agent
            ],201);
        } catch (Exception $e) {
            Log::channel("laravel")->error($e->getMessage());
            return response()->json([
                "success"=>false,
                "message"=>"Une erreur est survenue"
            ],500);
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'telephone' => 'nullable|string|max:15',
            'mail' => 'nullable|string|max:100',
            'nationailite_etrangere' => 'nullable|string|max:100'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>collect($validator->errors())->flatten(),
            ],500);
        }

        $agent = Agent::find($id);

        if($agent == null){
            return response()->json([
                "success"=>false,
                "message"=>"Aucun agent trouvé"
            ],404);
        }

        try {
            
            $agent->telephone = $request->telephone;
            $agent->mail = $request->mail;
            $agent->nationailite_etrangere = $request->nationailite_etrangere;
            // $agent->id_structure = $request->id_structure;
            // $agent->id_profession = $request->id_profession;
            // $agent->id_nationalite = $request->id_nationalite;
            $agent->save();
            return response()->json([
                "success"=>true,
                "message"=>"Agent modifié avec succès",
                "data"=>$agent
            ],202);
        } catch (Exception $e) {
            Log::channel("laravel")->error($e->getMessage());
            return response()->json([
                "success"=>false,
                "message"=>"Une erreur est survenue"
            ],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $agent = Agent::find($id);

        if($agent == null){
            return response()->json([
                "success"=>false,
                "message"=>"Aucun user trouvé"
            ],404);
        }

        $agent->delete();
        return response()->json([
            "success"=>true,
            "message"=>"agent supprimé avec succès"
        ],200);


    }
}
