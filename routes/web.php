<?php
// Please leave the arrangement of this file as is

Auth::routes();
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::group(['domain' => 'officemate.test'], function () {
    Route::any('/123', function () {
        return 'My own domain';
    });
});
Route::group(['domain' => '{subdomain}.officemate.test'], function () {
    Route::any('/123', function ($subdomain) {
        return 'Subdomain ' . $subdomain;
    });
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/login2', function () {
    return view('auth.login_old');
});

Route::group(['middleware' => 'guest'], function () {
    // Route::group(['prefix'=>'{company}'], function()
    // Route::group(['domain'=>'{company}.officemate.test'], function()
    // {
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@post_login')->name('post_login');
    // });

    Route::post('/company_registration', 'LoginController@register_company')->name('register_company');

    Route::get('/activate_pass/{id}/{code}', 'LoginController@activate_pass')->name('activate_pass');
    Route::patch('/activate_pass2/{id}/{code}', 'LoginController@activate_pass2')->name('activate_pass2');
});
Route::get('/activate/{id}/{code}', 'LoginController@activate')->name('activate');

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/read_notification/{id}', 'HomeController@read_notification')->name('read_notification');

    // Route::middleware(['can:superadmin'])->group(function(){
    Route::resource('menus', 'MenuController');
    Route::get('menus/edit/{id}', 'MenuController@edit')->name('edit_menu');
    Route::delete('menus/delete/{id}', 'MenuController@destroy')->name('delete_menu');
    // });

    // Menu Assignment For Company Admins
    Route::get('company-menus', 'MenuController@company_menus')->name('company_menus');
    Route::get('assign-menu/{id}', 'MenuController@edit_company_menu')->name('edit_company_menu');
    Route::patch('assign-menu/{id}', 'MenuController@update_company_menu')->name('update_company_menu');

    Route::get('staff', 'StaffController@index')->name('staff');
    // Route::get('staff', 'StaffController@invite')->name('invite_staff');
    Route::post('invite_staff', 'StaffController@post_invite')->name('invite_staff');

    Route::get('projects', 'ProjectController@index')->name('projects');
    Route::post('store_project', 'ProjectController@store')->name('store_project');
    Route::patch('update_project/{id}', 'ProjectController@update')->name('update_project');
    Route::get('project/{id}', 'ProjectController@view_project')->name('view_project');

    Route::post('save_task', 'ProjectController@save_task')->name('save_task');
    Route::patch('update_task/{id}', 'ProjectController@update_task')->name('update_task');
    Route::post('save_projectchat', 'ProjectController@save_projectchat')->name('save_projectchat');

    Route::get('task/{id}', 'TaskController@view')->name('view_task');
    Route::post('task/{id}/add_step', 'TaskController@add_step')->name('add_step');
    Route::get('toggle_step/{id}', 'TaskController@toggle_step')->name('toggle_step');
    Route::patch('edit_step/{id}', 'TaskController@edit_step')->name('edit_step');
    Route::delete('delete_step/{id}', 'TaskController@delete_step')->name('delete_step');

    // Fixed Assets
    Route::get('fixed-assets', 'AssetController@index')->name('assets');
    Route::post('save-asset', 'AssetController@save_asset')->name('save_asset');
    Route::patch('update-asset/{id}', 'AssetController@update_asset')->name('update_asset');
    Route::delete('delete-asset/{id}', 'AssetController@delete_asset')->name('delete_asset');

    // Amortisation
    Route::get('amortisation', 'AmortisationController@index')->name('amortisation-index');
    Route::get('amortisation-items', 'AmortisationController@items')->name('amortisation-items');
    Route::post('save-amort', 'AmortisationController@save_amort')->name('save_amort');
    Route::get('edit-amort/{id}', 'AmortisationController@edit_amort')->name('edit_amort');
    Route::patch('update-amort/{id}', 'AmortisationController@update_amort')->name('update_amort');
    Route::delete('delete-amort/{id}', 'AmortisationController@delete_amort')->name('delete_amort');

    Route::resource('clients', 'ClientController');

    Route::get('messages/inbox', 'MessageController@inbox')->name('inbox');
    Route::get('messages/sent', 'MessageController@sent_messages')->name('sent_messages');
    Route::get('messages/compose', 'MessageController@compose')->name('compose_message');
    Route::post('messages/send', 'MessageController@send_message')->name('send_message');
    Route::post('messages/reply/{parent_id}', 'MessageController@reply_message')->name('reply_message');
    Route::get('message/{id}/{reply?}', 'MessageController@view_message')->name('view_message');

    Route::get('bulletins', 'BulletinController@index')->name('bulletin_board');
    Route::post('save_bulletin', 'BulletinController@save_bulletin')->name('save_bulletin');
    Route::get('bulletin/{id}', 'BulletinController@view_bulletin')->name('view_bulletin');

    // post forum messages
    Route::post('/send/forum-post', 'ForumPostController@createPost');
    Route::post('/send/forum-comment', 'ForumPostController@postComment');
    Route::get('/load/forum-post', 'ForumPostController@loadPosts');
    Route::get('/forum/reply/post/{id}', 'ForumPostController@comments');
    Route::get('/load/post/title/{id}', 'ForumPostController@loadCard');
    Route::get('/load/comments/{id}', 'ForumPostController@loadComments');

    Route::resource('roles', 'RoleController');
    Route::get('/assignroles', 'UserRoleAssignmentController@create')->name('roleassignment');
    Route::post('/assignroles', 'UserRoleAssignmentController@store');

    Route::get('/assignmenus', 'MenuRoleAssignmentController@create')->name('menuassignment');
    Route::post('/assignmenus', 'MenuRoleAssignmentController@store');

    Route::resource('genders', 'GenderController');

    Route::get('staff/{id}/Staff_Finance_Details', 'StaffController@editFinanceDetails')->name('staff.Staff_Finance_Details');
    Route::get('staff/{id}/edit', 'StaffController@edit')->name('staff.edit');
    Route::get('staff/{id}/officedetails', 'StaffController@editofficedetails')->name('staff.officedetails');
    Route::patch('staff/{id}/officedetails', 'StaffController@updateOfficeDetails');
    Route::patch('staff/{id}/Staff_Finance_Details', 'StaffController@updateFinanceDetails');
    Route::get('staff/{id}/edit_biodata', 'StaffController@edit_biodata')->name('staff.edit_biodata');
    Route::get('staff/showfulldetails', 'StaffController@showfulldetails')->name('staff.showfulldetails');
    Route::patch('staff/{id}/bio_data_details', 'StaffController@updatebiodata');
    Route::get('account', 'StaffController@manage_account')->name('manage_account');
    Route::get('edit-profile', 'UserController@edit_profile')->name('edit_profile');

    Route::get('pending-biodata-list', 'StaffController@pending_biodata_list')->name('pending_biodata_list');
    Route::get('pending-biodata/{id}', 'StaffController@pending_biodata')->name('pending_biodata');
    Route::patch('approve-biodata/{id}', 'StaffController@approve_biodata')->name('approve_biodata');
    Route::patch('reject-biodata/{id}', 'StaffController@reject_biodata')->name('reject_biodata');

    Route::resource('staff', 'StaffController');

    Route::resource('companies', 'CompanyController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('leaverequest', 'LeaveRequestController');

    // Route::get('/images/avatars/{company}/{file}')->name('avatar');

    // Route::get('customers/editList', 'CustomerController@customerEditList')->name('CustomerUpdate');
    // Route::resource('customers', 'CustomerController');

    Route::get('documents', 'DocumentController@index')->name('documents');
    Route::get('my_documents', 'DocumentController@my_documents')->name('my_documents');

    // sends document for approval
    Route::get('my_documents/send/{id}', 'DocumentController@send')->name('send_document');
    Route::get('my_documents/approvallist', 'DocumentController@approval_list')->name('docs_approvallist');

    Route::post('document_store', 'DocumentController@store')->name('document_store');
    Route::get('download-document/{file}', function ($file) {
        return response()->download(storage_path("app/documents/" . $file));
    })->name('docs');

    Route::resource('doctypes', 'DocTypeController');

    Route::get('events', 'EventScheduleController@index')->name('events');
    Route::get('get_events', 'EventScheduleController@get_events')->name('get_events'); // AJAX
    Route::post('save_event', 'EventScheduleController@save_event')->name('save_event');
    Route::get('event/{id}', 'EventScheduleController@view_event')->name('view_event');
    Route::patch('update_event/{id}', 'EventScheduleController@update_event')->name('update_event');
    Route::delete('delete_event/{id}', 'EventScheduleController@delete_event')->name('delete_event');

    Route::get('todos', 'TodoController@index')->name('todos');
    Route::get('todos-calendar', 'TodoController@todos_calendar')->name('todos_calendar');
    Route::get('get_todos', 'TodoController@get_todos')->name('get_todos'); // AJAX
    Route::post('save_todo', 'TodoController@save_todo')->name('save_todo');
    Route::patch('update_todo/{id}', 'TodoController@update_todo')->name('update_todo');
    Route::get('toggle_todo/{id}', 'TodoController@toggle_todo')->name('toggle_todo'); // AJAX
    Route::delete('delete_todo/{id}', 'TodoController@delete_todo')->name('delete_todo');

    Route::get('notes', 'StickyNoteController@index')->name('notes');
    Route::post('store_note', 'StickyNoteController@store')->name('store_note');
    Route::delete('delete_note/{id}', 'StickyNoteController@delete')->name('delete_note');

    Route::get('call-memo/create/{customer}', 'CallMemoController@create')->name('create_call_memo');
    Route::post('call-memo/store/{customer}', 'CallMemoController@store')->name('store_call_memo');
    Route::post('call-memo/store_action_point/{discussion}', 'CallMemoController@store_action_point')->name('store_action_point');
    Route::post('call-memo/store_discussion_point/{memo}', 'CallMemoController@store_discussion_point')->name('store_discussion_point');
    Route::get('call-memo/{customer}', 'CallMemoController@view')->name('view_call_memo');

    // Loan Credit Rating
    Route::get('/loan_rating/index', 'LoanRatingController@index')->name('loan_ratings');
    Route::get('/new_loan_rating', 'LoanRatingController@create')->name('new_loan_rating');
    Route::post('/save_loan_rating', 'LoanRatingController@store')->name('save_loan_rating');
    Route::get('/loan_rating/{id}', 'LoanRatingController@view')->name('view_loan_rating');
    Route::patch('/approve_loan_rating/{id}', 'LoanRatingController@approve')->name('approve_loan_rating');
    Route::patch('/reject_loan_rating/{id}', 'LoanRatingController@reject')->name('reject_loan_rating');

    Route::get('gls/create2', 'GLController@create2')->name('gls.create2');
    Route::get('gls/{id}/edit2', 'GLController@edit2')->name('gls.edit2');
    Route::post('gls/create2', 'GLController@storeLoan');
    Route::patch('gls/{id}/edit2', 'GLController@update2');
    Route::resource('gls', 'GLController');

    Route::get('cash_entries/customer_transfer', 'CashEntryController@customer_transfer')->name('customer_transfer');
    Route::post('cash_entries/customer_transfer', 'CashEntryController@customer_transfer_store');
    Route::get('cash_entries/Imprest', 'CashEntryController@Imprest')->name('Imprest');
    Route::post('cash_entries/storeImprest', 'CashEntryController@storeImprest');
    Route::get('cash_entries/customer_transfer/{id}', 'CashEntryController@customer_transfer_edit')->name('customer_transfer.edit');
    Route::patch('cash_entries/customer_transfer/{id}', 'CashEntryController@customer_transfer_update');
    Route::patch('cash_entries/edit_b/{id}', 'CashEntryController@update2');

    // From vce
    Route::get('cash_entries/payments', 'CashEntryController@Payments')->name('Payments');
    Route::get('cash_entries/receipts', 'CashEntryController@Receipts')->name('Receipts');
    Route::post('cash_entries_receipts', 'CashEntryController@storeReceipts');
    Route::post('cash_entries_payments', 'CashEntryController@storePayments');
    Route::get('cash_entries/purchase_on_credits', 'CashEntryController@purchase_on_credits')->name('PurchaseOnCredits');
    Route::get('cash_entries/bill_posting', 'CashEntryController@bill_posting')->name('BillPosting');
    Route::post('bill_posting', 'CashEntryController@post_bill');
    Route::post('purchase_on_credits', 'CashEntryController@storepurchase_on_credits');
    Route::get('cash_entries/bill_payment_list', 'CashEntryController@bill_payment_list')->name('BillPaymentList');
    Route::post('pay_List', 'CashEntryController@store_bill_payment_list');
    Route::post('process_payment', 'CashEntryController@customer_transfer_store');
    Route::get('cash_entries/approve_posting', 'CashEntryController@approve_posting')->name('ApprovePosting');

    Route::resource('cash_entries', 'CashEntryController');

    // Transactions
    Route::get('transactions/showdetails', 'TransactionController@showDetails')->name('showDetails');
    Route::get('transactions/transactionlist', 'TransactionController@TransactionList')->name('Transaction_List');
    Route::post('transactions/transactionlistrange', 'TransactionController@TransactionListRange')->name('Transaction_List_Range');
    Route::get('transactions/multipost', 'TransactionController@multipost')->name('transactions.multipost');
    Route::post('transactions/multipost', 'TransactionController@multipost_store')->name('transactions.multipost.store');

    Route::resource('transactions', 'TransactionController');

    // REPORTS
    Route::get('reports/balance-sheet', 'ReportController@balance_sheet')->name('balance_sheet2');
    Route::get('reports/balance-sheet2', 'ReportController@balance_sheet2')->name('balance_sheet');
    Route::get('reports/trial-balance', 'ReportController@trial_balance')->name('trial_balance2');
    Route::get('reports/trial-balance2', 'ReportController@trial_balance2')->name('trial_balance');
    Route::get('reports/trial-balance3', 'ReportController@trial_balance3')->name('trial_balance3');
    Route::get('reports/profit-loss', 'ReportController@profit_loss')->name('profit_loss2');
    Route::get('reports/profit-loss2', 'ReportController@profit_loss2')->name('profit_loss');
    Route::get('reports/profit-loss3', 'ReportController@profit_loss3')->name('profit_loss3');
    Route::get('reports/loans-report', 'ReportController@loans_report')->name('loans_report');

    Route::get('report/balance-sheet-vce', 'ReportController@balance_sheet_vce')->name('balance_sheet_vce');
    Route::get('report/profit-loss-vce', 'ReportController@profit_loss_vce')->name('profit_loss_vce');
    Route::post('accounting_period', 'ReportController@accounting_period')->name('accounting_period');
    Route::get('bsdetails/{ref}/{to}', 'ReportController@bsdetails')->name('bsdetails');
    Route::get('pldetails/{ref}/{to}', 'ReportController@pldetails')->name('pldetails');

    Route::get('reports/expired-loans', 'ReportController@matured_loans')->name('matured_loans');
    Route::get('reports/running-loans', 'ReportController@outstanding_loans')->name('outstanding_loans');
    Route::get('reports/loan-pretermination', 'ReportController@loan_pretermination')->name('loan_pretermination');
    Route::post('reports/preterminate/{id}', 'ReportController@preterminate')->name('preterminate');

    Route::get('reports/savings', 'ReportController@savings')->name('savings_accounts');
    Route::get('reports/loan-status', 'ReportController@loan_status')->name('loan_status');

    // Discontinued
    Route::get('kb/categories', 'IssueController@categories')->name('kb-categories');
    Route::post('save_kb_cat', 'IssueController@save_category')->name('save_kb_cat');

    Route::get('issues/project/{id}', 'IssueController@project_issues')->name('project_issues');
    Route::post('save_issue/{project}', 'IssueController@save_issue')->name('save_issue');
    Route::patch('update_issue/{id}', 'IssueController@update_issue')->name('update_issue');
    Route::get('issue/{id}', 'IssueController@view_issue')->name('view_issue');

    Route::get('contacts', 'CustomerController@index')->name('business_contacts');
    Route::post('save_contact', 'CustomerController@save_contact')->name('save_contact');
    Route::get('edit_contact/{id}', 'CustomerController@edit_contact')->name('edit_contact');
    Route::patch('update_contact/{id}', 'CustomerController@update_contact')->name('update_contact');

    // -- payroll

    Route::get('payroll/details', 'PayrollController@details')->name('payroll.details');

    // apply updates to employees
    Route::post('/payroll/apply-updates', 'PayrollController@apply_updates');

    // set payroll periods
    Route::post('payroll/period', 'PayrollRateController@store');
    // Payroll groups
    Route::get('payroll/groups', 'PayrollController@groups')->name('payroll.groups.index');
    Route::get('payroll/groups/edit/{id}', 'PayrollController@edit_group');
    Route::patch('payroll/groups/{id}', 'PayrollController@update_group');
    Route::get('payroll/groups/new', 'PayrollController@new_group')->name('payroll.groups.new');

    // Payroll Adjustment
    Route::post('payroll/group/store', 'PayrollAdjustmentController@store');

    // Payroll percentages
    Route::get('payroll/setup-percentages', 'PayrollController@view_percentages')->name('payroll.setup_percentage');
    Route::get('payroll/percentage/{id}', 'PayrollController@edit_percentage');
    Route::patch('payroll/percentage/{id}', 'PayrollController@update_percentage');
    Route::post('payroll/setup-percentages', 'PayrollController@setup_percentages');

    // payroll reports
    Route::get('payroll/reports/cummulative', 'PayrollController@get_cummulative')->name('payroll.reports.cumulative');
    Route::get('payroll/reports/individual', 'PayrollController@get_individual')->name('payroll.reports.individual');
    Route::get('payroll/reports/netpay-to-bank', 'PayrollController@get_netpay_to_bank')->name('payroll.reports.netpay-to-bank');

    // payroll deductions
    Route::get('payroll/deductions', 'PayrollController@view_deductions')->name('payroll.deduction');
    Route::get('payroll/deductions/manual', 'PayrollController@get_manual_deductions')->name('payroll.deduction.manual');
    Route::post('payroll/deductions/manual', 'PayrollController@post_manual_deductions')->name('payroll.deductions.store');
    Route::post('/payroll/process-payroll', 'PayrollController@process_payroll');

    // -- end payroll

    // -- Workflow Module
    Route::resource('workflow', 'WorkflowController');
    Route::get('approvallist', 'ApprovalController@checklist')->name('approvallist');
    Route::post('approvallist/approve', 'ApprovalController@approve');
    Route::post('approvallist/reject', 'ApprovalController@reject');

    // Risk Register
    Route::resource('risk-registers', 'RiskRegisterController');
});

Route::get('/cls', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return redirect()->route('home');
});

Route::get('/cda', function () {
    exec('composer dump-autoload');
    return redirect()->route('home');
});

Route::get('/account', function () {
    $project = Cavidel\Project::find('2');
    return $project->user_ids;
});
