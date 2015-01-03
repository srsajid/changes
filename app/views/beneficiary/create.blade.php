<form class="form-horizontal create-edit-form" action="{{OSMS::$baseUrl}}beneficiary/save" method="post">
    <input type="hidden" name="id" value="{{$beneficiary->id}}">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name:</label>
        <div class="col-sm-10">
            <input class="form-control validate[required]" name="name" value="{{$beneficiary->name}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Designation:</label>
        <div class="col-sm-10">
            <input class="form-control validate[required]" name="designation" value="{{$beneficiary->designation}}">
        </div>
    </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">Present Address:</label>
        <div class="col-sm-10">
            <input class="form-control validate[required]" name="address_1" value="{{$beneficiary->address_1}}">
        </div>
     </div>
     <div class="form-group">
         <label class="col-sm-2 control-label">Permanent Address:</label>
         <div class="col-sm-10">
             <input class="form-control validate[required]" name="address_2" value="{{$beneficiary->address_2}}">
         </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sex:</label>
        <div class="col-sm-10">
            {{Form::select('sex', array('male' => "Male", 'female' => "Female"), $beneficiary->sex, array('class' => "form-control"))}}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Phone:</label>
        <div class="col-sm-10">
            <input class="form-control validate[required, custom[phone]]" name="phone" value="{{$beneficiary->phone}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email:</label>
        <div class="col-sm-10">
            <input class="form-control validate[custom[email]]" name="email" value="{{$beneficiary->email}}">
        </div>
    </div>
    @if(!$beneficiary->id)
        <div class="form-group">
            <label class="col-sm-2 control-label">Salary:</label>
            <div class="col-sm-10">
                <input class="form-control validate[required, custom[number]]" name="salary" value="{{$beneficiary->salary}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Join Date:</label>
            <div class="col-sm-10">
                <input class="form-control date-picker" name="join_date" value="{{$beneficiary->join_date}}">
            </div>
        </div>
    @endif
    <div class="form-group">
        <label class="col-sm-2 control-label">Sex:</label>
        <div class="col-sm-10">
            {{Form::select('campus', array('campus_1' => "Campus 1", 'campus_2' => "Campus 2"), $beneficiary->campus, array('class' => "form-control"))}}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Type:</label>
        <div class="col-sm-10">
            {{Form::select('type', OSMS::$BENEFICIARY_TYPE, null, array('class' => 'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Employee Id:</label>
        <div class="col-sm-10">
            <input class="form-control validate[required]" name="employee_id" value="{{$beneficiary->employee_id}}">
        </div>
    </div>
    <div class="form-group">
       <label class="col-sm-2 control-label">Education:</label>
       <div class="col-lg-10">
            <table class="table">
               <colgroup>
                    <col style="width: 20%"/>
                    <col style=""/>
                    <col style="width: 15%"/>
                    <col style="width: 10%"/>
               </colgroup>
               <tr>
                   <th>Degree</th>
                   <th>Institution</th>
                   <th>Grade</th>
                   <th>action</th>
               </tr>
               @foreach($beneficiary->educations as $education)
                    <tr class="education">
                        <td class="degree">{{$education->degree}}</td>
                        <td class="institution">{{$education->institution}}</td>
                        <td class="grade">{{$education->grade}}</td>
                        <td>
                            <span class="glyphicon glyphicon-pencil edit"></span>
                            <span class="glyphicon glyphicon-remove remove"></span>
                        </td>
                    </tr>
               @endforeach
               <tr class="last-row">
                    <td><input class="form-control" type="text" name="degree"></td>
                    <td><input class="form-control" type="text" name="institution"></td>
                    <td><input class="form-control" type="text" name="grade"></td>
                    <td>
                        <button type="button" class="btn btn-default btn-sm tool-icon add" title="Add Education">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                        </button>
                    </td>
               </tr>
            </table>
       </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
            <button type="submit" class="form-control">Create</button>
        </div>
    </div>
</form>