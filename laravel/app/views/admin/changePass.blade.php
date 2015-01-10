<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}account/save-pass" method="post">
    <div class="form-group">
        <label class="col-sm-4 control-label">Old Password:</label>
        <div class="col-sm-8">
            <input type="password" name="old_password" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">New Password:</label>
        <div class="col-sm-8">
            <input type="password" name="password" class="form-control validate[required,minSize[8]]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">New Password:</label>
        <div class="col-sm-8">
            <input type="password" name="confirm_password" class="form-control validate[required,minSize[8]]">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-4">
            <button type="submit" class="btn btn-default">Change</button>
        </div>
    </div>
</form>