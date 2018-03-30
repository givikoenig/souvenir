<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use Config;
use App\User;

class UsersController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Request $request) {
    	$permit = $this->p_rep->checkEnter();
    	$ords_new = $this->p_rep->checkNewOrders();
    	if ($permit) {

    		if (view()->exists('admin.users')) {
    			$user_ids = $this->GetUsersRolesView($request);
    			$users = User::whereIn('id', $user_ids)->paginate(Config::get('settings.adm_users_pages_count'));

                $all_users = User::all();
                $admins = array();
                $editors = array();
                $commenters = array();
                $guests = array();
                foreach ($all_users as $one_user) {
                    if ($one_user->hasRole('admin')) {
                        array_push($admins, $one_user);
                    }
                    if ($one_user->hasRole('editor')) {
                        array_push($editors, $one_user);
                    }
                    if ($one_user->hasRole('commenter')) {
                        array_push($commenters, $one_user);
                    }
                    if ($one_user->hasRole('guest')) {
                        array_push($guests, $one_user);
                    }
                }
                $admins_count = count($admins);
                $editors_count = count($editors);
                $commenters_count = count($commenters);
                $guests_count = count($guests);
                $all_count = $all_users->count();

				$data = [
					'title' => 'Users',
                    'users' => $users,
                    'admins_count' => $admins_count,
                    'editors_count' => $editors_count,
                    'commenters_count' => $commenters_count,
                    'guests_count' => $guests_count,
					'all_count' => $all_count,
					'ords_new' => $ords_new,
				];
					return view('admin.users',$data);
			}
			abort(404);
    	}
    	return redirect('profile');
    }

    public function GetUsersRolesView($request) {
    	$all =  User::all();
    	$user_ids = array();

    	if (basename($request->path()) == 'guests') {
    		foreach ($all as $usr) {
    			if ($usr->hasRole('guest')) {
    				array_push($user_ids, $usr->id);
    			}
    		}
    	} elseif (basename($request->path()) == 'commenters') {
    		foreach ($all as $usr) {
    			if ($usr->hasRole('commenter')) {
    				array_push($user_ids, $usr->id);
    			}
    		}
    	}  elseif (basename($request->path()) == 'editors') {
    		foreach ($all as $usr) {
    			if ($usr->hasRole('editor')) {
    				array_push($user_ids, $usr->id);
    			}
    		}
    	}  elseif (basename($request->path()) == 'admins') {
    		foreach ($all as $usr) {
    			if ($usr->hasRole('admin')) {
    				array_push($user_ids, $usr->id);
    			}
    		}
    	} else {
    		foreach ($all as $usr) {
   				array_push($user_ids, $usr->id);
    		}
    	}
    	return $user_ids;
    }
}
