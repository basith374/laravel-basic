@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1>Settings</h1>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
	                    <ul class="nav nav-tabs" id="settings-tab">
	                        <li class="active">
	                            <a href="#contact" data-toggle="tab">Contact Info</a>
	                        </li>
	                        <li>
	                            <a href="#password" data-toggle="tab">Change Password</a>
	                        </li>
	                        <li>
	                            <a href="#social" data-toggle="tab">Social Links</a>
	                        </li>
	                    </ul>
	                    <div id="msg" style="display:none;">
                    	@if(Session::has("success"))
                		<div class="alert alert-success">
                			<p><i class="glyphicon glyphicon-check"></i> {{ Session::get('success') }}</p>
                		</div>
                		@endif
                    	@if($errors->any())
                		<div class="alert alert-danger">
                			@foreach($errors->all() as $error)
                			<p><i class="glyphicon glyphicon-exclamation-sign"></i> {{ $error }}</p>
                			@endforeach
                		</div>
                		@endif
                		</div>
                		<div class="tab-content">

                			<div class="tab-pane fade in active" id="contact">
		                        <div class="col-lg-6">
		                            <form class="form-horizontal" action="{{ url('/admin/settings') }}" method="POST">
		                            	<input type="hidden" name="_method" value="PATCH">
		                            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                                <div class="form-group">
		                                    <label class="control-label col-md-4" for="phone1">Telephone <span class="text-danger" title="Required">*</span></label>
		                                    <div class="col-md-8">
		                                        <input type="text" name="telephone" class="form-control" value="{{ $settings['telephone'] or '' }}" required id="phone1">
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label class="control-label col-md-4" for="phone2">Mobile </label>
		                                    <div class="col-md-8">
		                                        <input type="text" name="mobile" class="form-control" value="{{ $settings['mobile'] or '' }}" id="phone2">
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label class="control-label col-md-4" for="email">Email <span class="text-danger" title="Required">*</span></label>
		                                    <div class="col-md-8">
		                                        <input type="email" name="email" class="form-control" value="{{ $settings['email'] or '' }}" required id="email">
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <div class="col-md-8 col-md-offset-4">
		                                        <button type="submit" class="btn btn-success">Save</button>
		                                    </div>
		                                </div>
		                            </form>
		                        </div>
		                    </div>

	                        <div class="tab-pane fade" id="password">

		                        <div class="col-lg-6">
		                            <form class="form-horizontal" action="{{ url('/admin/password') }}" method="POST">
		                            	<input type="hidden" name="_method" value="PATCH">
		                            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                                <div class="form-group">
		                                    <label class="control-label col-md-4" for="password">Password</label>
		                                    <div class="col-md-8">
		                                        <input type="password" name="password" class="form-control" id="password">
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label class="control-label col-md-4" for="password_confirmation">Re-enter Password</label>
		                                    <div class="col-md-8">
		                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <div class="col-md-8 col-md-offset-4">
		                                        <button type="submit" class="btn btn-success">Save</button>
		                                    </div>
		                                </div>
		                            </form>
		                        </div>
	                        </div>

	                        <div class="tab-pane fade" id="social">
		                        <div class="col-lg-6">
		                            <form class="form-horizontal" action="{{ url('/admin/social') }}" method="POST">
		                            	<input type="hidden" name="_method" value="PATCH">
		                            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                            	@foreach(json_decode($settings['social']) as $social)
		                                <div class="form-group">
		                                    <label class="control-label col-md-4" for="{{ $social->id }}">{{ $social->label }}</label>
		                                    <div class="col-md-8">
		                                        <input type="text" name="{{ $social->id }}" class="form-control" value="{{ $settings[$social->id] or '' }}" id="{{ $social->id }}">
		                                    </div>
		                                </div>
		                                @endforeach
		                                <div class="form-group">
		                                    <div class="col-md-8 col-md-offset-4">
		                                        <button type="submit" class="btn btn-success">Save</button>
		                                    </div>
		                                </div>
		                            </form>
		                        </div>
	                        </div>
	                    </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

@endsection