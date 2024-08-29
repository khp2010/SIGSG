<?php
namespace Dtic\Personnels\app\Http\Controllers;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Dtic\Personnels\app\Models\Personne;
use Illuminate\Support\Facades\Validator;

class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personnes = Personne::all();
        return response()->json([
            "success"=>true,
            "message"=>"Liste des personnes",
            "data"=>$personnes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {

        $rules = [
            'nom' => 'nullable|string|max:100',
            'prenom' => 'nullable|string|max:100',
            'sexe' => 'nullable|in:M,F',
            'date_naissance' => 'nullable|date'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>collect($validator->errors())->flatten(),
            ],500);
        }
        

        try {
            $personne = new Personne;
            $personne->nom = $request->nom;
            $personne->prenom = $request->prenom;
            $personne->sexe = $request->sexe;
            $personne->date_naissance = $request->date_naissance;
            //$personne->id_mere = $request->id_mere;
            // $personne->id_tuteur = $request->id_tuteur;
            // $personne->id_pere = $request->id_pere;
            $personne->save();
            return response()->json([
                "success"=>true,
                "message"=>"personne créé avec succès",
                "data"=>$personne
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
            'nom' => 'nullable|string|max:100',
            'prenom' => 'nullable|string|max:100',
            'sexe' => 'nullable|in:M,F',
            'date_naissance' => 'nullable|date'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>collect($validator->errors())->flatten(),
            ],500);
        }

        $personne = Personne::find($id);

        if($personne == null){
            return response()->json([
                "success"=>false,
                "message"=>"Personne non trouvée"
            ],404);
        }    

        try {
            $personne->nom = $request->nom;
            $personne->prenom = $request->prenom;
            $personne->sexe = $request->sexe;
            $personne->date_naissance = $request->date_naissance;
            //$personne->id_mere = $request->id_mere;
            // $personne->id_tuteur = $request->id_tuteur;
            // $personne->id_pere = $request->id_pere;
            $personne->save();
            return response()->json([
                "success"=>true,
                "message"=>"personne modifiée avec succès",
                "data"=>$personne
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $personne = Personne::find($id);

        if($personne == null){
            return response()->json([
                "success"=>false,
                "message"=>"Aucun user trouvé"
            ],404);
        }

        $personne->delete();
        return response()->json([
            "success"=>true,
            "message"=>"Personne supprimé avec succès"
        ],200);
    }
}
