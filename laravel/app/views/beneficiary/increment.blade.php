<form class="form-horizontal create-edit-form" action="{{OSMS::$baseUrl}}beneficiary/save-increment" method="post">
    <input type="hidden" name="id" value="{{$id}}">
    <div class="form-group">
        <label class="col-sm-3 control-label">Amount:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required]" name="amount">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Type:</label>
        <div class="col-sm-8">
            {{Form::select('type', array('Regular' => "Regular", 'Special' => "Special"), null, array('class' => "form-control"))}}
        </div>
    </div>
     <div class="form-group">
        <label class="col-sm-3 control-label">Date:</label>
        <div class="col-sm-8">
            <input class="form-control date-picker" name="date">
        </div>
     </div> 
     <div class="form-group">
        <label class="col-sm-3 control-label">Comment:</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="comment"></textarea>
        </div>
     </div>
     <div class="form-group">
         <div class="col-sm-offset-8 col-sm-3">
             <button type="submit" class="form-control">Save</button>
         </div>
     </div>
</form>