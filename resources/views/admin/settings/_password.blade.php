
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