@extends('admin.layout')

@section('title', 'Gallery')

@section('head')
<style>
.icon-text {
    position: relative;
    display: inline-block;
}
.icon {
    position: absolute;
    top: 7px;
    left: 10px;
    color: #999;
}
.icon-text .form-control {
    padding-left: 30px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Gallery</h1>
                <div class="pull-right">
                    <form class="form-inline" method="GET" action="{{ url(Request::path()) }}">
                        <div class="icon-text">
                            <div class="icon">
                                <i class="glyphicon glyphicon-search"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Search" name="q" value="{{ Request::get('q') }}" autofocus>
                        </div>
                        <a href="{{ url('admin/gallery-create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add new</a>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
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
        </div>
    </div>

    <div class="row">
		@forelse($gallery as $g)
		<div class="col-md-4 col-lg-3">
			<div class="thumbnail">
				<img src="{{ asset($g->image) }}">
				<div class="caption">
					<h3>{{ $g->name }}</h3>
					<form method="post" action="{{ url('admin/gallery/' . $g->id) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE">
						<a href="{{ url('admin/gallery-create/' . $g->id) }}" class="btn btn-default btn-sm">Edit</a>
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
				</div>
			</div>
		</div>
        @empty
        <div class="col-md-12 text-center">
            <p>
                <img src="{{ asset('img/gallery.png') }}">
            </p>
            <h3>{{ Request::has('q') ? 'No results' : 'No images' }}</h3>
            <p>
                {{ Request::has('q') ? 'Coudn\'t find any images matching "' . Request::get('q') . '"' : 'You have no images in your gallery.' }}
            </p>
        </div>
		@endforelse
    </div>


    <div class="row">
        <div class="col-md-12">
            {{ $gallery->links() }}
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

@section('scripts')
<script>
	var heights = [];
	$('.thumbnail form').submit(function() {
		return confirm('Are you sure you want to delete this?');
	});
	$('.thumbnail').each(function() {
		heights.push(this.getBoundingClientRect().height);
		var maxHeight = Math.max.apply(null, heights);
		$('.thumbnail').css('min-height', maxHeight);
	});
</script>
@endsection
