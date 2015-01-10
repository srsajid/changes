<form class="form-horizontal create-edit-form" action="{{OSMS::$baseUrl}}user/save" method="post">
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="form-group">
        <label class="col-sm-3 control-label">First Name:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required]" name="first_name" value="{{$user->first_name}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Last Name:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-8">
            <input class="form-control" name="email" value="{{$user->email}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Username:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required,minSize[5]]" name="username" value="{{$user->username}}">
        </div>
    </div>
    <?php if(!$user->id) { ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Password:</label>
            <div class="col-sm-8">
                <input class="form-control validate[required,minSize[8]]" name="password" type="password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Confirm Password:</label>
            <div class="col-sm-8">
                <input class="form-control validate[required,minSize[8]]" name="confirm_password" type="password">
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <label class="col-sm-3 control-label">User Type:</label>
        <div class="col-sm-8">
            {{Form::select('weight', OSMS::$USER_TYPE, null, array('class' => 'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-8 col-sm-3">
            <button type="submit" class="form-control">Create</button>
        </div>
    </div>
</form>