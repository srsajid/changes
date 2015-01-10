<form class="form-horizontal" action="<?php echo OSMS::$baseUrl;?>sells/report" target="_blank" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">Date From:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control date-picker" name="from" placeholder="Date From">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Date To:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control date-picker" name="to" placeholder="Date To">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-9 col-sm-3">
            <button type="submit" class="form-control">Generate</button>
        </div>
    </div>
</form>