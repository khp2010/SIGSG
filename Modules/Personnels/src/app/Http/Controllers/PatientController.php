<?php
namespace Dtic\Personnels\app\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Dtic\Personnels\app\Models\Patient;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{

    public function index()
    {
        $patient = Patient::all();
        return response()->json([
            "success"=>true,
            "message"=>"Liste des patients",
            "data"=>$patient
        ]);
    }


    public function create(Request $request)
    {

        $rules = [
            'telephone' => 'nullable|string|max:15',
            'mail' => 'nullable|string|max:100',
            'nationalite_etrangere' => 'nullable|string|max:100',
            'filtre_confidentialite' => 'nullable|string|max:100',
            'type_confidentialite' => 'nullable|string|max:100',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>collect($validator->errors())->flatten(),
            ],500);
        }
        
        try {
            $patient = new Patient;
            $patient->telephone = $request->telephone;
            $patient->mail = $request->mail;
            $patient->nationalite_etrangere = $request->nationalite_etrangere;
            $patient->filtre_confidentialite = $request->filtre_confidentialite;
            $patient->type_confidentialite = $request->type_confidentialite;
            // $patient->id_profession = $request->id_profession;
            // $patient->id_personne = $request->id_personne;
            $patient->save();
            return response()->json([
                "success"=>true,
                "message"=>"Patient créé avec succès",
                "data"=>$patient
            ],201);
        } catch (Exception $e) {
            Log::channel("laravel")->error($e->getMessage());
            return response()->json([
                "success"=>false,
                "message"=>"Une erreur est survenue"
            ],500);
        }

    }


    public function update(Request $request, $id)
    {

        $rules = [
            'telephone' => 'nullable|string|max:15',
            'mail' => 'nullable|string|max:100',
            'nationalite_etrangere' => 'nullable|string|max:100',
            'filtre_confidentialite' => 'nullable|string|max:100',
            'type_confidentialite' => 'nullable|string|max:100',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>collect($validator->errors())->flatten(),
            ],500);
        }
        
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Patient non trouvé'], 404);
        }

        try {

            $patient->telephone = $request->telephone;
            $patient->mail = $request->mail;
            $patient->nationalite_etrangere = $request->nationalite_etrangere;
            $patient->filtre_confidentialite = $request->filtre_confidentialite;
            $patient->type_confidentialite = $request->type_confidentialite;
            // $patient->id_profession = $request->id_profession;
            // $patient->id_personne = $request->id_personne;
            $patient->save();
            return response()->json([
                "success"=>true,
                "message"=>"Patient modifié avec succès",
                "data"=>$patient
            ],201);
        } catch (Exception $e) {
            Log::channel("laravel")->error($e->getMessage());
            return response()->json([
                "success"=>false,
                "message"=>"Une erreur est survenue"
            ],500);
        }
    
    }


    public function destroy($id)
    {

        $patient = Patient::find($id);

        if($patient == null){
            return response()->json([
                "success"=>false,
                "message"=>"Aucun patient trouvé"
            ],404);
        }

        $patient->delete();
        return response()->json([
            "success"=>true,
            "message"=>"patient supprimé avec succès"
        ],200);
    }
}
