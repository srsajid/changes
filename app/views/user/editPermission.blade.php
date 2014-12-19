<form class="manage-permission form-horizontal" action="{{OSMS::$baseUrl}}user/save-permission" method="post">
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="form-group">
        <div class="col-sm-12">
           {{Form::select('controller', Config::get("permission.controllers"), $controller, array('class' => 'form-control controller-selector'))}}
        </div>
    </div>
    @foreach($actions as $key => $action)
        <div class="form-group">
            <label class="col-sm-6 control-label">{{$action}}:</label>
            <div class="col-sm-5">
                <input type="checkbox" class="form-control" name="{{$key}}" {{array_key_exists($key, $permissionMappings) ? "checked" : ""}}>
            </div>
        </div>
    @endforeach
     <div class="form-group">
        <div class="col-sm-offset-8 col-sm-4">
            <button type="submit" class="form-control">Apply</button>
        </div>
    </div>
</form>
