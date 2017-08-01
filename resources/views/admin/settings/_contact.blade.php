
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