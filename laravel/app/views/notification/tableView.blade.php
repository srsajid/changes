<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Beneficiaries({{$total}})</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    {{Form::select('searchText', array('this' => "This Month", 'next' => "Next Month", 'pending' => 'Pending'), $searchText, array('class' => "form-control"))}}
                </div>
            </div>
        </div>
    </nav>

</div>

<div class="body">
    <table class="table">
        <colgroup>
            <col style="width: 5%"/>
            <col style="width: 20%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
        </colgroup>
        <thead>
        <tr>
            <th>Name</th>
            <th>Designation</th>
            <th>Type</th>
            <th>Join Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($beneficiaries as $beneficiary)
            <tr class="active">
                <td><?php echo $beneficiary->name; ?></td>
                <td><?php echo $beneficiary->designation; ?></td>
                <td><?php echo OSMS::$BENEFICIARY_TYPE[$beneficiary->type]; ?></td>
                <td><?php echo $beneficiary->join_date; ?></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="footer">
    <?php
    echo CommonService::paginator($max, $offset, $total);
    echo CommonService::itemPerPage($max);
    ?>
</div>
