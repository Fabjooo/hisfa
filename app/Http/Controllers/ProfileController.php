<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function PersonalData(Request $request){
		//dd($request->all());  //to check all the datas dumped from the form
   		//if your want to get single element,someName in this case

		$loggedInUser = \Auth::user()->name;
   		$name = $request->name;
		$email = $request->email;

		$query = DB::update('update users set name = ?, email = ? where name = ?', [$name, $email, $loggedInUser]);

		if($query){
			$request->session()->flash('alert-success', 'Uw persoonlijke gegevens werden succesvol aangepast.');
			return redirect('/profiel/instellingen');
			//$feedbackPersonal = "Uw persoonlijke gegevens werden succesvol aangepast.";

		}else{
			$request->session()->flash('alert-danger', 'Uw persoonlijke gegevens werden niet aangepast.');
			return redirect('/profiel/instellingen');
		}
	}

	public function UserAvatar(Request $request){
		if(Input::hasFile('file')){

			$file = Input::file('file');

			if(substr($file->getMimeType(), 0, 5) == 'image'){
				$extension = Input::file('file')->getClientOriginalExtension();
				$fileName = "UA-" . \Auth::user()->id . time() . '.' . $extension;

				$destinationPath = "img/" . $fileName;
				$loggedInUser = \Auth::user()->id;


				$query = DB::update('update users set profilePic = ? where id = ?', [$destinationPath, $loggedInUser]);

				if($query){
					$file->move('img', $fileName);
					$request->session()->flash('avatar-success', 'Uw profielfoto werd succesvol aangepast.');
					return redirect('/profiel/instellingen');
				}else{
					$request->session()->flash('avatar-danger', 'Uw profielfoto kon niet worden aangepast.');
					return redirect('/profiel/instellingen');
				}


			}else{
				$request->session()->flash('avatar-danger', 'Het bestand is geen afbeelding.');
				return redirect('/profiel/instellingen');
			}


		}
	}


	public function UserPassword(Request $request){
		//dd($request->all());
		$currentPass = $request->currentPass;
		$newPass = $request->newPass;
		$newPassRepeat = $request->newPassRepeat;

		$user = \Auth::user()->password;

		if(Hash::check($currentPass, $user)){
			/*$request->session()->flash('password-success', 'Uw huidig wachtwoord klopt.');
			return redirect('/profiel/instellingen');*/

			if($newPass == $newPassRepeat)
			{
				$newPassword = Hash::make($newPass);
				$loggedInUser = \Auth::user()->name;
				$query = DB::update('update users set password = ? where name = ?', [$newPassword, $loggedInUser]);

				if($query){
					$request->session()->flash('password-success', 'Uw wachtwoord werd succesvol verandert.');
					return redirect('/profiel/instellingen');
				}else{
					$request->session()->flash('password-danger', 'Uw wachtwoord kon niet verandert worden.');
					return redirect('/profiel/instellingen');
				}
    		}else{
				$request->session()->flash('password-danger', 'De wachtwoorden komen niet overeen.');
				return redirect('/profiel/instellingen');
			}

  return $passwordOK;

		}else{
			$request->session()->flash('password-danger', 'Uw huidig wachtwoord klopt niet.');
			return redirect('/profiel/instellingen');
		}
	}

	public function ClickUpdateNotification_prime(){
		//klik op slider: verstuur 0 of 1 naar databank (submit)

		$notification_prime = \Auth::user()->notification_prime;

		if($notification_prime == 1){
			$user = User::findOrFail(\Auth::user()->id);
			$user->notification_prime = 0;
			$user->save();

		}else{
			$user = \App\User::findOrFail(\Auth::user()->id);
			$user->notification_prime = 1;
			$user->save();
		}

		return redirect()->back();
	}

	public function ClickUpdateNotification_waste(){
		//klik op slider: verstuur 0 of 1 naar databank (submit)

		$notification_waste = \Auth::user()->notification_waste;

		if($notification_waste == 1){
			$user = User::findOrFail(\Auth::user()->id);
			$user->notification_waste = 0;
			$user->save();

		}else{
			$user = \App\User::findOrFail(\Auth::user()->id);
			$user->notification_waste = 1;
			$user->save();
		}

		return redirect()->back();
	}

	public function checkName($p_sName){
		$name = DB::table('users')->where('name', $p_sName)->get();

		if(count($name)){
			// if there is a name like the one the user inserted -> signal a false to stop the process
			return false;
		}else{
			return true;
		}
	}

	public function checkMail($p_sMail){
		$mail = DB::table('users')->where('email', $p_sMail)->get();

		if(count($mail)){
			return false;
		}else{
			return true;
		}
	}

	public function addUser(Request $request){
		$name = $request->name;
		$email = $request->email;
		$pass = $request->password;
		$passRepeat = $request->passwordRepeat;
		$options = $request->options;

		if($pass == $passRepeat){
			if(strlen($pass) >= 7){
				if($this->checkName($name)){
					if($this->checkMail($email)){

						$newPassword = Hash::make($pass);
						$query = DB::table('users')->insert(
							['name' => $name, 'email' => $email, 'password' => $newPassword]
						);

						if($query){
							$lastIDQuery = DB::table('users')->orderBy('id', 'desc')->first();
							//$lastID = mysqli_fetch_assoc($lastIDQuery);
							$newID = $lastIDQuery->id;

							if(!empty($options)){
								foreach($options as $option){
									$query = DB::table('user_permissions')->insert(
										['options' => $option, 'user_id' => $newID]
									);
								}
							}
							$request->session()->flash('user-success', 'De gebruiker werd succesvol aangemaakt.');
							return redirect('/profiel');
						}
					}else{
						$request->session()->flash('user-danger', 'Een gebruiker met dezelfde e-mail adres bestaat al.');
					}
				}else{
					$request->session()->flash('user-danger', 'Een gebruiker met dezelfde naam bestaat al.');
				}
			}else{
				$request->session()->flash('user-danger', 'Het wachtwoord moet minstens 7 karakters lang zijn.');
			}
		}else{
			$request->session()->flash('user-danger', 'De wachtwoorden komen niet overeen.');
		}
		return redirect()->back();
	}

	public function ManageUsers(){
		$users = DB::table('users')->where('account_type', '=', 'normal')->get();
		return view('profiel/gebruikers_beheren', ['users' => $users])->with('title', 'User management');
	}

	public function UpdateUser(Request $request){
		$options = $request->options;
		$id = $request->userId;
		if(!empty($options)){
			$query = DB::table('user_permissions')->where('user_id', '=', $id)->delete();

			foreach($options as $option){
				$query = DB::table('user_permissions')->insert(
					['options' => $option, 'user_id' => $id]
				);
			}

			return redirect()->back();
		}
	}

	public function DeleteUser($id){
		$query = DB::table('users')->where('id', '=', $id)->delete();
		return redirect()->back();
	}
}
