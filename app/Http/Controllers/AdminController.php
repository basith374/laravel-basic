<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setting;
use App\Gallery;
use Validator;
use App\User;

class AdminController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function getSettings() {
		$settings = Setting::lists('value', 'name')->all();
		return view('admin.settings', compact('settings'));
	}

	public function patchSettings(Request $request) {
		$this->updateSettings($request);
		return redirect('/admin/settings#website')->withSuccess('Contact information updated');
	}

	public function patchPassword(Request $request) {
		$validator = Validator::make($request->only('password', 'password_confirmation'), ['password' => 'required|min:4|confirmed|alpha_num']);
		if($validator->fails()) {
			return redirect('/admin/settings#password')->withErrors($validator);
		}
		$admin = User::whereUsername('admin')->first();
		$admin->update(['password' => bcrypt($request->password)]);
		return redirect('/admin/settings#profile')->withSuccess('Password updated');
	}

	public function patchSocial(Request $request) {
		$this->updateSettings($request);
		return redirect('/admin/settings#social')->withSuccess('Social links updated');
	}

	public function patchSeo(Request $request) {
		$this->updateSettings($request);
		return redirect('/admin/settings#seo')->withSuccess('Seo updated');
	}
	private function updateSettings($request) {
		$settings = Setting::lists('name')->all();
		foreach($request->all() as $key => $value) {
			if(in_array($key, $settings)) {
				Setting::whereName($key)->update(['value' => $value]);
			}
		}
	}

}
