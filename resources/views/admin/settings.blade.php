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
            	@foreach($tabs as $tab)
                <li{{ Request::get('page', 'contact') == $tab['id'] ? ' class=active' : '' }}>
                    <a href="#{{ $tab['id'] }}" data-toggle="tab">{{ $tab['name'] }}</a>
                </li>
                @endforeach
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
    			@foreach($tabs as $tab)
    			<div class="tab-pane fade{{ Request::get('page', 'contact') == $tab['id'] ? ' in active' : '' }}" id="{{ $tab['id'] }}">
            	@if(Session::has("success") && Request::get('page', 'contact') == $tab['id'])
        		<div class="alert alert-success">
        			<p><i class="glyphicon glyphicon-check"></i> {{ Session::get('success') }}</p>
        		</div>
        		@endif
            	@if($errors->any() && Request::get('page', 'contact') == $tab['id'])
        		<div class="alert alert-danger">
        			@foreach($errors->all() as $error)
        			<p><i class="glyphicon glyphicon-exclamation-sign"></i> {{ $error }}</p>
        			@endforeach
        		</div>
        		@endif
    			@include($tab['partial'])
    			</div>
    			@endforeach
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection