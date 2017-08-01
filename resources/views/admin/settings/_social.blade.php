
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