<form class="form-horizontal create-edit-form" action="{{OSMS::$baseUrl}}beneficiary/save" method="post">
    <input type="hidden" name="id" value="{{$beneficiary->id}}">
    <div class="form-group">
        <label class="col-sm-3 control-label">Name:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required]" name="name" value="{{$beneficiary->name}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Designation:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required]" name="designation" value="{{$beneficiary->designation}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Phone:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required, custom[phone]]" name="phone" value="{{$beneficiary->phone}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-8">
            <input class="form-control validate[custom[email]]" name="email" value="{{$beneficiary->email}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Address:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required]" name="address" value="{{$beneficiary->address}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Salary:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required, custom[number]]" name="salary" value="{{$beneficiary->salary}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">User Type:</label>
        <div class="col-sm-8">
            {{Form::select('type', OSMS::$BENEFICIARY_TYPE, null, array('class' => 'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-8 col-sm-3">
            <button type="submit" class="form-control">Create</button>
        </div>
    </div>
</form>