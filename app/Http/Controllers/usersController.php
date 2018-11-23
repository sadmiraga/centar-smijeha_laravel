<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use App\jokes;

class usersController extends Controller
{

    public function destroy($user_id){

        //gost pokusava da izbrise druge korisnike
        if(Auth::guest()){
            return redirect('/login');
        } else{
            if((Auth::user()->role)!=1){
                return redirect('/mojprofil');
            } else {
            //EXECUTE
                //izbrisi usera
                $user = User::findOrFail($user_id);
                
                //pronadji sve fore od korisnika koji treba da bude izbrisan
                $jokesFromExUser = jokes::where('user_id',$user_id)->get();

                //pobrisi sve fore od tog korisnika
                foreach($jokesFromExUser as $jokeFromExUser){
                    $jokeFromExUser->delete();
                }

                //izbrisi korisnika
                $user->delete();
                return redirect('/manageUsers');
            }
        }
    }

    public function update($user_id){
        
        if(Auth::guest()){
            //gost pokusava da dodje do uređivanja drugog usera
            return redirect('/login');
        } else {
            if((Auth::user()->role)!=1){
                // obicni korisnik ili admin obicni pokusavaju da promjene korisnike
                return redirect('/mojprofil');
            } else {
                //PRAVI EXECUTE
                $user = User::findOrFail($user_id);
                return view('adminpanel.editUser')->with('user',$user);
            }
        }
    }

    public function uredi(Request $request,$id){
        $this->validate($request,[
            'role' => 'required'
        ]);
        
        //uredjivanje korisnika
        $user = User::find($id);
        $user->role = $request->input('role');
        $user->save();
        return redirect('/manageUsers');
    }

    public function editPersonalInfo(){
        return 'to je taj view';
    }

}
