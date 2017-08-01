@extends('admin.layout')

@section('title', 'Gallery')

@section('content')
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1>Add new</h1>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
	                    <div id="msg" style="display:none;">
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
                	<div class="col-md-4">
                		<form action="{{ url('admin/gallery/' . (isset($gallery) ? $gallery->id : '')) }}" method="POST" enctype="multipart/form-data">
                			{{ csrf_field() }}
                			<div class="form-group">
                				<label>Name</label>
                				<input type="text" class="form-control" name="name" value="{{ $gallery->name or '' }}">
                			</div>	
                			<div class="form-group">
                				<label>Image</label>
                				<input type="file" class="form-control" name="image">
                			</div>
                			<div class="form-group">
                				<div class="thumbnail">
                					<img src="{{ isset($gallery) ? asset($gallery->image) : 'http://placehold.it/600x450?text=Preview' }}">
                				</div>
                			</div>
                			<div class="form-group">
                				<button type="submit" class="btn btn-success">Save</button>
                			</div>
                		</form>
                	</div>
                </div>

            </div>
            <!-- /.container-fluid -->

@endsection

@section('scripts')
<script>
$('form').submit(function() {
    $('button[type=submit]').attr('disabled', true).prepend('<i class="fa fa-circle-o-notch fa-spin"></i>');
});
$('input[type=file]').change(function() {
	if(this.files && this.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('.thumbnail img').attr('src', e.target.result);
		}
		reader.readAsDataURL(this.files[0]);
	} else {
		$('.thumbnail img').attr('src', 'http://placehold.it/600x450');
	}
});
</script>
@endsection