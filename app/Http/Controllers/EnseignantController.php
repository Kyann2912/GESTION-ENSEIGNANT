<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filiere;  //Modèle filiere
use App\Models\User; 
use App\Models\Salle;  //Modèle filiere
use Illuminate\Support\Facades\Hash;

use App\Models\Paiement;  //Modèle paiement

use App\Models\Professeur;  

use App\Models\Administrateur;  


class EnseignantController extends Controller
{

    public function A(){
        return view('enseignant.emploi-temps');
    }
    public function B(){
        return view('enseignant.listeemploitemps');

    }



    public function D(){
        return view('enseignant.inscription');
    }
    public function E(){
        return view('enseignant.liste-utilisateur');
    }

    public function F(){
        return view('enseignant.occupation');
    }

    public function G(){
        $occupations = Salle :: all();
        return view('enseignant.liste-occupation',compact('occupations'));
    }

    public function H(){
        return view('enseignant.paiement');
    }
    
    public function I(){
        return view('enseignant.liste-paiement');
    }

    public function J(){
        return view('enseignant.filiere');
    }

    public function K(){
        $filieres = Filiere :: all();
        return view('enseignant.liste-filiere',compact('filieres'));
    }

    public function supprimer_filiere($id){
        $filieres = Filiere :: find($id);
        $filieres->delete();
        return redirect('/liste-filieres')->with('supprimer','Filière supprimer avec succès');

    }

    public function supprimer_occupation($id){
        $occupation = Salle :: find($id);
        $occupation->delete();
        return redirect('/liste-occupations')->with('supprimer','Occupation supprimer avec succès');

    }

    public function L(){
        return view('enseignant.connexion');
    }

    public function M(){
        return view('enseignant.professeur');
    }

    public function N(){
        return view('enseignant.professeur-emploi');
    }

    public function O(){
        return view('enseignant.professeur-paiement');
    }

    public function P(){
        return view('enseignant.message');
    }

    public function ajouter_occupation_traitement(Request $request){
        $request->validate([
            'nom_salle' =>'required',
            'occupation' =>'required',
            'heure' =>'required|string',
            'date' =>'required'

        ]);

        $occupation = new  Salle();

        $occupation->nom_salle = $request->nom_salle;
        $occupation->occupation = $request->occupation;
        $occupation->heure = $request->heure;
        $occupation->date = $request->date;

        $occupation->save();

        $currentFiliereCount = session('salle', 0);
        session(['salle' => $currentFiliereCount + 1]);

        return redirect('/liste-occupations')->with('message','Occupation ajouter avec succès');

    }

    public function ajout_paiement(){
        $request->valiadte([
            'email'=>'required',
            'filiere-niveau'=>'required',
            'cours'=>'required',
            'nbre-heures'=>'required',
            'montant'=>'required',
        ]);

        $paiement = new Paiement();
        $paiement->email = $request->$paiement;
        $paiement->filiere_niveau = $request->$paiement;
        $paiement->email = $request->$paiement;
        $paiement->email = $request->$paiement;
        $paiement->email = $request->$paiement;

    }

    public function ajouter_filiere_traitement(Request $request){

        $request->validate([
            'departement' =>'required',
            'nom_filiere' =>'required',
            'responsable' =>'required'
        ]);

        $filiere = new Filiere();
        $filiere->departement = $request->departement;
        $filiere->nom_filiere = $request->nom_filiere;
        $filiere->responsable = $request->responsable;
        $filiere-> save();

        $currentFiliereCount = session('filiere', 0);
        session(['filiere' => $currentFiliereCount + 1]);

        return redirect('/liste-filieres')->with('message','Filière ajouter avec succès');

    }

    public function C(){
        $filiere = session('filiere', 0);
        $utilisateur = session('utilisateur', 0);
        $paiement = session('paiement', 0);
        $emploi = session('emploi', 0);
        $salle = session('salle', 0);
        $data = [
            'labels'=> ['filiere','utilisateur','paiement','emploi','salle'],
            'values'=> [$filiere,$utilisateur,$paiement,$emploi,$salle]
        ];
        return view('enseignant.tableau', compact('data','filiere','utilisateur','paiement','emploi','salle'));
    }


    public function update_filiere($id){
        $filiere = Filiere :: find($id);
        return view ('enseignant.update-filiere',compact('filiere'));
    }


    public function traitement_filiere(Request $request)
    {
        $request->validate([
            'departement' => 'required',
            'nom_filiere' => 'required',
            'responsable' => 'required',
        ]);
    
        $filiere = Filiere::find($request->id);
    
        if (!$filiere) {
            return redirect('/liste-filieres')->with('error', 'Filière non trouvée');
        }

        $filiere->departement = $request->departement;
        $filiere->nom_filiere = $request->nom_filiere;
        $filiere->responsable = $request->responsable;
        $filiere->update();
    
        return redirect('/liste-filieres')->with('modifier', 'Filière modifiée avec succès');
    }

    public function update_occupation($id){
        $occupation = Salle :: find($id);
        return view ('enseignant.O',compact('occupation'));
    }


    public function modifier_occupation(Request $request){

        $request->validate([
            'nom_salle' =>'required',
            'occupation' =>'required',
            'heure' =>'required',
            'date' =>'required'

        ]);

        $occupation = Salle::find($request->id);

        if (!$occupation) {
            return redirect('/liste-occupations')->with('error', 'Occupation non trouvée');
        }
        $occupation->nom_salle = $request->nom_salle;
        $occupation->occupation = $request->occupation;
        $occupation->heure = $request->heure;
        $occupation->date = $request->date;
        $occupation-> update();
        return redirect('/liste-occupations')->with('modifier', 'Occupation modifiée avec succès');
    }


    public function ajout_inscription(Request $request){

        $request->validate([
            'name'=>'required',
            'prenoms'=>'required',
            'email'=>'required',
            'matiere'=>'required',
            'role'=>'required',
            'password'=>'required|min:8',
        ]);

        $user = new User();

        $user ->name = $request->name;
        $user ->prenoms = $request->prenoms;
        $user ->email = $request->email;
        $user ->role = $request->role;
        $user ->password = Hash::make($request->password);

        //Enregistrement dans la table User
        $user->save();

        if($user->role === 'admin'){
            $admin = new Administrateur();
            $admin->id_user = $user->id;
            $admin->save();
        }elseif($user->role ==='professeur'){
            $professeur = new Professeur();

            $professeur ->cours= $request->cours;

            $professeur->id_user = $user->id;

            $professeur->save();

        }




    }


    





    //
}
