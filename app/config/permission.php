<?php
    return array(
        'controllers' => array(
            'AdmissionController' => 'Student',
            'BeneficiaryController' => 'Beneficiary',
            'UserController' => 'User'
        ),
        'AdmissionController' => array(
            'getLoadTable' => "List Table",
            'getCreate' => 'Create Form',
            'getEdit' => 'Edit Form',
            'postSave' => 'Save'
        ),
        'BeneficiaryController' => array(
            'getLoadTable' => 'List Table',
            'getCreate' => 'Create Edit Form',
            'postSave' => 'Save Beneficiary',
            'getPaySalaryForm' => 'Pay Salary Form 1',
            'getPaySalaryNextStep' => 'Pay Salary Form 2',
            'postPaySalary' => "Pay Salary"

        ),
        'UserController' => array(
            'getLoadTable' => 'User Table',
            'getCreate' => 'Create Edit Form',
            'postSave' => 'Save',
            'getPermissionEdit' => "Permission Edit Form",
            'postSavePermission' => "Save Permission"
        )

    );