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
            'IncomeEntryController' => 'Income Entry',
            'NotificationController' => "Promotion Notification",
            'LoanController' => "Loan",
            'OthersController' => "Others",
            "PackageController" => "Package Product",
            "ProductController" => "Product",
            "RegistrationController" => "Student Registration",
            "SalaryController" => "Salary",
            "SellsController" => "Sells",
            "TransportController" => "Transport",
            "TuitionFeeController" => "Tuition Fee",
            "UserController" => "User"
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
        ),
        'NotificationController' => array(
            'getLoadTable' => 'View Promotion Notification '
        ),
        "LoanController" => array(
            'getLoadTable' => "View All Loan",
            'getCreate' => "Give Loan",
            'postSave' => "Loan Entry",
            'getCreatePayment' => "Receive Payment Form",
            'postSavePayment' => "Save Payment",
            'getPaymentHistory' => "View Payment history"
        ),
        "PackageController" => array(
            'getLoadTable' => "View All Packages",
            'getCreate' => "Edit/Create Package",
            'postSave' => "Save Package"
        ),
        "ProductController" => array(
            'loadTable' => "View All Products",
            'view' => "View Product",
            'create' => "Create New Product Form",
            'save' => "Save Product",
            'loadInventoryForm' => "Inventory Update Form",
            'updateInventory' => "Save Inventory Update",
            'productForSelection' => "Product For Selection",
            'history' => "Inventory Update History For a Product"
        ),
        "RegistrationController" => array(
            'getTableView' => "View All Registration",
            'getCreate' => "Registration Form",
            'getEdit' => "Edit Registration Information",
            'postSave' => "Save Registration"
        ),
        "SalaryController" => array(
            'getTableView' => "View All Salary History",
            'getReportForm' => "Report Form",
            'postReport' => "Generate Report",
            'getView' => "View Details"
        ),
        "SellsController" => array(
            'loadTable' => "View All Sells",
            'create' => "Sells Form",
            'selection' => "Selection",
            'save' => "Save a Sells",
            'pdf' => "Generate PDF",
            'view' => "View Sells Details",
            'reportForm' => "Report Form",
            'report' => "Generate Report"

        ),
        "TransportController" => array(
            'getLoadTable' => "View All Transportation Income",
            'getTransportFeeForm' => "Transport Fee Entry Form",
            'getTransportFeeNext' => "getTransportFeeNext",
            'postTakeTransport' => "Save Transport Fee Entry"
        ),
        "TuitionFeeController" => array(
            'getLoadTable' => "View All Tuition Fee Entry",
            'getTuitionFeeForm' => "Tuition Fee Entry Form",
            'getTuitionFeeNext' => "getTuitionFeeNext",
            'postTakeTuition' => "Save Tuition Fee Entry"
        )
    );