<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setting;
use Validator;
use App\User;
use Image;

class AdminController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function getGallery(Request $request) {
		$query = Gallery::query();
		$query->orderBy('id', 'desc');
		if($request->has('q')) {
			$query->where('name', 'like', '%' . $request->q . '%');
		}
		$gallery = $query->paginate(12);
		return view('admin.gallery', compact('gallery'));
	}

	public function getGalleryCreate($id = null) {
		$data = [];
		if($id) {
			$data['gallery'] = Gallery::find($id);
		}
		return view('admin.gallery_form', $data);
	}

	public function postGallery() {
		$settings = Setting::pluck('value', 'name')->all();
		if(!empty($settings['tinify_key'])) {
			\Tinify\setKey($settings['tinify_key']);
		}
		if($request->hasFile('photo')){
			$file = $request->file('photo');
			$destination_path = '/uploads/';
			$filename = uniqid() . '.' . $file->getClientOriginalExtension();
			if(!empty($settings['tinify_key'])) {
				$source = \Tinify\fromFile($file);
				$source->toFile(public_path() . $destination_path . $filename);
			} else {
				Image::make($file)->fit(600, 450)->save(public_path() . $destination_path . $filename);
				// $file->move(public_path() . $destination_path, $filename);
			}
			$image = $destination_path . $filename;
            \DB::table('gallery')->insert(['image' => $image]);	
        }
		return back();			
	}

	public function deleteGallery($id) {
		Gallery::destroy($id);
		return redirect('/admin/gallery')->with('success', 'Deleted');
	}

	public function getSettings() {
		$tabs = [
			[
				'name' => 'Contact Info',
				'id' => 'contact',
				'partial' => 'admin.settings._contact',
			],
			[
				'name' => 'Address',
				'id' => 'map',
				'partial' => 'admin.settings._map',
			],
			[
				'name' => 'Change Password',
				'id' => 'password',
				'partial' => 'admin.settings._password',
			],
			[
				'name' => 'Social Links',
				'id' => 'social',
				'partial' => 'admin.settings._social',
			],
		];
		$settings = Setting::lists('value', 'name')->all();
		return view('admin.settings', compact('settings', 'tabs'));
	}

	public function patchSettings(Request $request) {
		$this->updateSettings($request);
		return redirect('/admin/settings?page=contact')->withSuccess('Contact information updated');
	}

	public function patchPassword(Request $request) {
		$validator = Validator::make($request->only('password', 'password_confirmation'), ['password' => 'required|min:4|confirmed']);
		if($validator->fails()) {
			return redirect('/admin/settings?page=password')->withErrors($validator);
		}
		$admin = User::whereUsername('admin')->first();
		$admin->update(['password' => bcrypt($request->password)]);
		return redirect('/admin/settings?page=password')->withSuccess('Password updated');
	}

	public function patchSocial(Request $request) {
		$this->updateSettings($request);
		return redirect('/admin/settings?page=social')->withSuccess('Social links updated');
	}

	public function patchSeo(Request $request) {
		$this->updateSettings($request);
		return redirect('/admin/settings?page=seo')->withSuccess('Seo updated');
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
