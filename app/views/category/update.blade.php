<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}category/save" method="post">
    <input name="id" type="hidden" value="{{$category->id}}">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" placeholder="Category Name"  value="<?php echo $category->name;?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
            <button type="submit" class="btn btn-default">Create</button>
        </div>
    </div>
</form>