<?php
    return array(
        'controllers' => array(
            'AdmissionController' => 'Student',
            'BeneficiaryController' => 'Beneficiary',
            'UserController' => 'User',
            'CategoryController' => 'Categories',
            'ExpenseController' => 'Expense Types',
            'ExpenseEntryController' => 'Expense Entry',
            'IncomeController' => 'Income Types',
            'IncomeEntryController' => 'Income Entry'
        ),
        'AdmissionController' => array(
            'loadTable' => "List Table",
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
            'postPaySalary' => "Pay Salary",
            'getCreateIncrement' => 'Salary Adjust Form',
            'postSaveIncrement' => 'Adjust Salary',
            'getSalaryHistory' => 'Show Salary History'

        ),
        'UserController' => array(
            'getTableView' => 'User Table',
            'getCreate' => 'Create Edit Form',
            'postSave' => 'Save',
            'getPermissionEdit' => "Permission Edit Form",
            'postSavePermission' => "Save Permission"
        ),
        'AdmissionController'=> array(
            'loadTable' => 'View All Students',
            'create' => 'Add new students',
            'edit' => 'Edit Student Information',
            'save' => 'Save Information'
        ),
        'CategoryController'=> array(
            'loadTable' => 'View All Categories ',
            'create' => 'Add new category',
            'edit' => 'Edit Category Information',
            'save' => 'Save Category Information'
        ),
        'ExpenseController'=> array(
            'getLoadTable' => 'View All Expense Type',
            'getCreate' => 'Add New Type of Expense',
            'getEdit' => 'Edit Expense Type',
            'postSave' => 'Save Expense Information',
            'getAddExpense' => 'Add Expense'
        ),
        'ExpenseEntryController' => array(
            'getLoadTable' => "View All expenses Entry",
            'getCreate' => 'Create New Expense Type',
            'postSave' => 'Save New Expense',
            'getDateselect' => 'Choose Date for Report',
            'postReport' => 'Create Report',
        ),
        'IncomeController'=> array(
            'loadTable' => "View All incomes",
            'create' => 'Create New Income Type',
            'edit' => 'Edit Income Type',
            'save' => 'Save Income Type Information'
        ),
        'IncomeEntryController'=> array(
            'getLoadTable' => "View All incomes Entry",
            'getCreate' => 'Create New Income Entry',
            'getDateselect' => 'Choose Date for Report',
            'postReport' => 'Create Report'
        )
    );