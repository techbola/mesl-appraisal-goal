<?php
// Please leave the arrangement of this file as is

Auth::routes();
Route::get('/customer-list', function (Request $request) {

    if (isset($_GET['searchTerm'])) {
        $string    = '%' . $_GET['searchTerm'] . '%';
        $customers = collect(DB::select(DB::raw("SELECT *
                FROM (
                SELECT  CustomerRef,
                        Customer,
                        ROW_NUMBER() OVER(PARTITION BY Customer ORDER BY CustomerRef DESC) rn
                FROM tblCustomer
                            ) a
                WHERE rn = 1 AND Customer like '$string'")));
    } else {
        $customers = collect(DB::select(DB::raw("SELECT *
                FROM (
                SELECT  CustomerRef,
                        Customer,
                        ROW_NUMBER() OVER(PARTITION BY Customer ORDER BY CustomerRef DESC) rn
                FROM tblCustomer
                            ) a
                WHERE rn = 1")));
    }

    $customers = $customers->transform(function ($item, $key) {
        $item->id   = $item->CustomerRef;
        $item->text = $item->Customer;
        return $item;
    });
    return response()->json($customers);
});
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

Route::get('/logout', 'LoginController@logout')->name('logout-url');
Route::get('/timeout', 'LoginController@timeout')->name('timeout-url');

Route::get('/login2', function () {
    return view('auth.login_old');
});

// GA
Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', 'Auth\LoginController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'Auth\LoginController@postValidateToken']);
// END GA

// Guests Only
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

// Logged Users Only
Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/settings', 'HomeController@settings');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/edit-company/{id?}', 'CompanyController@edit')->name('edit_company');
    Route::patch('/update-company/{id}', 'CompanyController@update')->name('update_company');
    Route::get('/activity_log', 'CompanyController@activity_log')->name('activity_log');

    Route::get('/read_notification/{id}', 'HomeController@read_notification')->name('read_notification');

    Route::get('/help', 'HomeController@help')->name('help');

    Route::middleware(['can:superadmin'])->group(function () {
        Route::resource('menus', 'MenuController');
        Route::get('menus/edit/{id}', 'MenuController@edit')->name('edit_menu');
        Route::delete('menus/delete/{id}', 'MenuController@destroy')->name('delete_menu');
    });

    // Menu Assignment For Company Admins
    Route::get('company-menus', 'MenuController@company_menus')->name('company_menus');
    Route::get('assign-menu/{id}', 'MenuController@edit_company_menu')->name('edit_company_menu');
    Route::patch('assign-menu/{id}', 'MenuController@update_company_menu')->name('update_company_menu');

    Route::get('staff', 'StaffController@index')->name('staff');
    // Route::get('staff', 'StaffController@invite')->name('invite_staff');
    Route::post('invite_staff', 'StaffController@post_invite')->name('invite_staff');
    Route::post('reinvite_staff/{id}', 'StaffController@reinvite_staff')->name('reinvite_staff');
    Route::patch('update_staff_admin/{id}', 'StaffController@update_staff_admin')->name('update_staff_admin');

    Route::get('projects', 'ProjectController@index')->name('projects');
    Route::post('store_project', 'ProjectController@store')->name('store_project');
    Route::patch('update_project/{id}', 'ProjectController@update')->name('update_project');
    Route::get('project/{id}', 'ProjectController@view_project')->name('view_project');
    Route::post('project/upload_file/{id}', 'ProjectController@upload_project_file')->name('upload_project_file');
    Route::delete('project/delete_file/{id}', 'ProjectController@delete_project_file')->name('delete_project_file');

    Route::post('save_task', 'ProjectController@save_task')->name('save_task');
    Route::patch('update_task/{id}', 'ProjectController@update_task')->name('update_task');
    Route::post('save_projectchat', 'ProjectController@save_projectchat')->name('save_projectchat');

    Route::get('task/{id}', 'TaskController@view')->name('view_task');
    Route::post('task/{id}/add_step', 'TaskController@add_step')->name('add_step');
    Route::get('toggle_step/{id}', 'TaskController@toggle_step')->name('toggle_step');
    Route::patch('edit_step/{id}', 'TaskController@edit_step')->name('edit_step');
    Route::delete('delete_step/{id}', 'TaskController@delete_step')->name('delete_step');

    Route::get('review_step_budget', 'TaskController@review_step_budget')->name('review_step_budget');
    Route::patch('approve_step_budget/{id}', 'TaskController@approve_step_budget')->name('approve_step_budget');
    Route::patch('reject_step_budget/{id}', 'TaskController@reject_step_budget')->name('reject_step_budget');
    Route::get('pay_step_budget', 'TaskController@pay_step_budget')->name('pay_step_budget');
    Route::post('store_step_payment/{id}', 'TaskController@store_step_payment')->name('store_step_payment');
    Route::get('complete_step_payments', 'TaskController@complete_step_payments')->name('complete_step_payments');

    Route::post('save_taskupdate/{id}', 'TaskController@save_taskupdate')->name('save_taskupdate');

    // Fixed Assets
    Route::get('fixed-assets', 'AssetController@index')->name('assets');
    Route::post('save-asset', 'AssetController@save_asset')->name('save_asset');
    Route::patch('update-asset/{id}', 'AssetController@update_asset')->name('update_asset');
    Route::delete('delete-asset/{id}', 'AssetController@delete_asset')->name('delete_asset');
    Route::post('get_assets_print', 'AssetController@get_assets_print')->name('get_assets_print'); // AJAX

    //Search
    Route::get('search', 'SearchController@index')->name('search');

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
    Route::get('search_messages', 'MessageController@search_messages')->name('search_messages');
    Route::get('download-file/{dir}/{filename}', function ($dir, $filename) {
        return response()->download(storage_path("app/public/" . $dir . "/" . $filename));
    })->name('download_file');

    // Route::get('/chat/list', 'ChatController@chat_list')->name('chat_list');
    // Route::get('/chat/{session?}', 'ChatController@chat')->name('chat');
    Route::get('/chat', 'ChatController@chat')->name('chat');
    Route::post('/save_chat', 'ChatController@save_chat')->name('save_chat');
    Route::get('/load_chats/{user}', 'ChatController@load_chats')->name('load_chats');
    Route::post('/search_users', 'ChatController@search_users')->name('search_users');
    // Route::post('/end_chat/{session}', 'ChatController@end_chat')->name('end_chat');

    Route::get('bulletins', 'BulletinController@index')->name('bulletin_board');
    Route::get('bulletins/department', 'BulletinController@department_bulletins')->name('department_bulletins');
    Route::post('save_bulletin', 'BulletinController@save_bulletin')->name('save_bulletin');
    Route::get('bulletin/{id}', 'BulletinController@view_bulletin')->name('view_bulletin');

    // post forum messages
    // Route::post('/send/forum-post', 'ForumPostController@createPost');
    // Route::post('/send/forum-comment', 'ForumPostController@postComment');
    // Route::get('/load/forum-post', 'ForumPostController@loadPosts');
    // Route::get('/forum/reply/post/{id}', 'ForumPostController@comments');
    // Route::get('/load/post/title/{id}', 'ForumPostController@loadCard');
    // Route::get('/load/comments/{id}', 'ForumPostController@loadComments');

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
    Route::patch('disengage/{id}', 'UserController@disengage')->name('disengage');
    Route::patch('reengage/{id}', 'UserController@reengage')->name('reengage');

    Route::get('pending-biodata-list', 'StaffController@pending_biodata_list')->name('pending_biodata_list');
    Route::get('pending-biodata/{id}', 'StaffController@pending_biodata')->name('pending_biodata');
    Route::patch('approve-biodata/{id}', 'StaffController@approve_biodata')->name('approve_biodata');
    Route::patch('reject-biodata/{id}', 'StaffController@reject_biodata')->name('reject_biodata');
    Route::get('subordinates', 'StaffController@subordinates')->name('subordinates');

    Route::resource('staff', 'StaffController');

    Route::resource('companies', 'CompanyController');
    Route::resource('departments', 'DepartmentController');

    // Leave Request
    Route::get('leave_request/create', 'LeaveRequestController@leave_request')->name('LeaveRequest');
    Route::post('store_leave_request', 'LeaveRequestController@store_leave_request');
    Route::get('leave_request/index', 'LeaveRequestController@dashboard')->name('LeaveDashBoard');
    Route::get('leave_request/leave_approval', 'LeaveRequestController@leave_approval')->name('LeaveApproval');
    Route::post('approve_leave_request', 'LeaveRequestController@approve_leave_request');
    Route::get('leave_notification/{elem_value}', 'LeaveRequestController@leave_notification');
    Route::get('request_date/{start_date}/{numberdays}', 'LeaveRequestController@retrieve_details');

    // Route::get('/images/avatars/{company}/{file}')->name('avatar');

    // Route::get('customers/editList', 'CustomerController@customerEditList')->name('CustomerUpdate');
    // Route::resource('customers', 'CustomerController');

    // Merging
    Route::get('merging/data_merging', 'MergingController@get_data_merging')->name('DataMerging');
    Route::post('store_merged_data', 'MergingController@store');
    Route::get('mergin/file_uploading', 'MergingController@fileupload')->name('FileUploading');
    Route::post('store_files', 'MergingController@store_files');

    Route::get('documents', 'DocumentController@index')->name('documents');
    Route::get('my_documents', 'DocumentController@my_documents')->name('my_documents');

    // sends document for approval
    Route::get('my_documents/send/{id}', 'DocumentController@send')->name('send_document');
    Route::get('my_documents/approvallist', 'DocumentController@approval_list')->name('docs_approvallist');

    Route::post('document_store', 'DocumentController@store')->name('document_store');
    Route::patch('update_document/{id}', 'DocumentController@update_document')->name('update_document');
    Route::get('download-document/{file}', function ($file) {
        return response()->download(storage_path("app / documents / " . $file));
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
    Route::get('get_todos/{staff?}', 'TodoController@get_todos')->name('get_todos'); // AJAX
    Route::post('save_todo', 'TodoController@save_todo')->name('save_todo');
    Route::patch('update_todo/{id}', 'TodoController@update_todo')->name('update_todo');
    Route::get('toggle_todo/{id}', 'TodoController@toggle_todo')->name('toggle_todo'); // AJAX
    Route::delete('delete_todo/{id}', 'TodoController@delete_todo')->name('delete_todo');
    Route::get('assigned-todos', 'TodoController@assigned_todos')->name('assigned_todos');
    Route::get('get_assigned_todos/{id}', 'TodoController@get_assigned_todos')->name('get_assigned_todos'); // AJAX
    Route::get('get_assigned_todos_done/{id}', 'TodoController@get_assigned_todos_done')->name('get_assigned_todos_done'); // AJAX
    Route::get('unassigned_todos', 'TodoController@unassigned')->name('unassigned_todos');

    Route::get('notes', 'StickyNoteController@index')->name('notes');
    Route::post('store_note', 'StickyNoteController@store')->name('store_note');
    Route::patch('update_note/{id}', 'StickyNoteController@update')->name('update_note');
    Route::post('store_checklist', 'StickyNoteController@store_checklist')->name('store_checklist');
    Route::delete('delete_note/{id}', 'StickyNoteController@delete')->name('delete_note');
    Route::get('get_note/{id}', 'StickyNoteController@get_note')->name('get_note'); // AJAX
    Route::patch('toggle_checklist', 'StickyNoteController@toggle_checklist')->name('toggle_checklist'); // AJAX

    Route::get('call-memo/create/{customer}', 'CallMemoController@create')->name('create_call_memo');
    Route::post('call-memo/store/{customer}', 'CallMemoController@store')->name('store_call_memo');

    Route::get('call-memo/edit/{id}', 'CallMemoController@edit')->name('edit_call_memo');
    Route::patch('call-memo/update/{id}', 'CallMemoController@update')->name('update_call_memo');
    Route::post('call-memo/store_action_point/{discussion}', 'CallMemoController@store_action_point')->name('store_action_point');
    Route::get('call-memo/edit_action_point/{id}', 'CallMemoController@edit_action_point')->name('edit_action_point');
    Route::patch('call-memo/update_action_point/{id}', 'CallMemoController@update_action_point')->name('update_action_point'); // FOR ASSIGNED REVIEWERS
    Route::patch('call-memo/update_action/{id}', 'CallMemoController@update_action')->name('update_action'); // FOR ADMIN MODAL
    Route::post('call-memo/store_discussion_point/{memo}', 'CallMemoController@store_discussion_point')->name('store_discussion_point');
    Route::patch('call-memo/update_discussion/{id}', 'CallMemoController@update_discussion_point')->name('update_discussion_point');
    Route::post('call-memo/email_attendees/{memo}', 'CallMemoController@email_attendees')->name('email_attendees');
    Route::get('call-memo/{customer}', 'CallMemoController@view')->name('view_call_memo');
    Route::get('call-memo-actions', 'CallMemoController@call_memo_actions')->name('call-memo-actions');
    Route::get('fetch_discussion/{id}', 'CallMemoController@fetch_discussion'); // AJAX
    Route::get('fetch_action/{id}', 'CallMemoController@fetch_action'); // AJAX
    Route::get('download_meeting_report/{name}', function ($name) {
        return Storage::download('/meeting_files/' . $name);
    })->name('download_meeting_report');

    Route::get('conversations_contacts', 'ConversationController@contacts')->name('conversations_contacts');
    Route::post('store_call_contact', 'ConversationController@store_call_contact')->name('store_call_contact');
    Route::get('view_conversations/{id}', 'ConversationController@view_conversations')->name('view_conversations');
    Route::post('store_conversation/{id}', 'ConversationController@store_conversation')->name('store_conversation');
    Route::patch('update_conversation/{id}', 'ConversationController@update_conversation')->name('update_conversation');
    Route::post('update_call_contact/{id}', 'ConversationController@update_call_contact')->name('update_call_contact');
    Route::get('get_conversation/{id}', 'ConversationController@get_conversation')->name('get_conversation'); // AJAX

    // Estate Info
    Route::get('/estate_info', 'EstateController@estate_info')->name('estate_info');
    Route::get('/get_blocks/{estate}', 'EstateController@get_blocks')->where('estate', '(.*)')->name('get_blocks');
    Route::get('/get_blocks_unassigned/{estate}', 'EstateController@get_blocks_unassigned')->name('get_blocks_unassigned');
    Route::get('/get_units/{estate}/{block}', 'EstateController@get_units')->where('block', '(.*)')->name('get_units');
    Route::get('/get_units_unassigned/{estate}/{block}', 'EstateController@get_units_unassigned')->name('get_units_unassigned');
    Route::patch('/update_estate_info', 'EstateController@update_estate_info')->name('update_estate_info');
    Route::get('/estate_status_report', 'EstateController@estate_status_report')->name('estate_status_report');

    // Estate Allocation
    Route::get('/estate_allocation', 'EstateController@estate_allocation')->name('estate_allocation');
    Route::patch('/update_estate_allocation', 'EstateController@update_estate_allocation')->name('update_estate_allocation');

    // With AllotteeName
    Route::get('/allocation_update', 'EstateController@allocation_update')->name('allocation_update');

    Route::get('/get_customer', 'CustomerController@get_customer')->name('get_customer');

    // Score Card
    Route::get('scorecard', 'ScoreCardController@index')->name('scorecard');
    Route::patch('update_scorecard/{id}', 'ScoreCardController@update')->name('update_scorecard');
    Route::get('scorecard/create/{id}', 'ScoreCardController@create')->name('create_scorecard');
    Route::post('save_scorecard/{id}', 'ScoreCardController@store')->name('save_scorecard');
    Route::delete('delete_scorecard/{id}', 'ScoreCardController@delete')->name('delete_scorecard');

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
    Route::post('submit_bill_for_posting', 'CashEntryController@submit_bill_for_posting');
    Route::get('cash_entries/show_approve_posting', 'CashEntryController@show_approve_posting')->name('ApprovePostings');
    Route::post('submit_bill_for_approval', 'CashEntryController@submit_bill_for_approval');
    Route::post('reject_posting_approvals', 'CashEntryController@reject_posting_approvals');
    Route::post('delete_posting', 'CashEntryController@delete_posting');

    // Learning Management System

    Route::get('LMS/course_dashboard', 'CourseController@course_dashboard')->name('CourseDashboard');
    Route::post('submit_new_category', 'CourseController@submit_new_category');
    Route::post('submit_new_course', 'CourseController@submit_new_course');
    Route::get('get_staff_details/{id}', 'CourseController@get_staff_details');
    Route::post('submit_new_instructor', 'CourseController@submit_new_instructor');
    Route::get('get_course_duration/{id}', 'CourseController@get_course_duration');
    Route::post('submit_new_batch', 'CourseController@submit_new_batch');
    Route::get('get_course_category_list', 'CourseController@get_course_category_list');
    Route::get('get_course_list', 'CourseController@get_course_list');
    Route::get('get_instructor_list', 'CourseController@get_instructor_list');
    Route::get('get_batch_list', 'CourseController@get_batch_list');
    Route::get('get_course_material_list/{id}', 'CourseController@get_course_material_list');
    Route::post('submit_course_material', 'CourseController@submit_course_material');
    Route::get('LMS/staff_course_dashboard', 'CourseController@staff_course_dashboard')->name('StaffCourseDashboard');
    Route::get('activate_course/{id}', 'CourseController@activate_course');
    Route::get('LMS/show_course/{id}', 'CourseController@show_course')->name('ShowCourse');
    Route::get('course_material_with_id/{id}', 'CourseController@course_material_with_id');
    Route::get('get_c_category', 'CourseController@get_c_category');

    // From vce
    Route::get('cash_entries/payments', 'CashEntryController@Payments')->name('Payments');
    Route::get('cash_entries/receipts', 'CashEntryController@Receipts')->name('Receipts');
    Route::post('cash_entries_receipts', 'CashEntryController@storeReceipts');
    Route::post('cash_entries_payments', 'CashEntryController@storePayments');
    Route::get('cash_entries/purchase_on_credits', 'CashEntryController@purchase_on_credits')->name('PurchaseOnCredits');
    Route::patch('cash_entries/purchase_on_credits/{id}', 'CashEntryController@purchase_on_credits_update');
    Route::get('cash_entries/purchase_on_credits/{id}', 'CashEntryController@purchase_on_credits_edit')->name('purchase_on_credits.edit');
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
    Route::get('reports/balance-sheet', 'ReportController@balance_sheet')->name('balance_sheet');
    Route::get('reports/balance-sheet2', 'ReportController@balance_sheet2')->name('balance_sheet2');
    Route::get('reports/trial-balance', 'ReportController@trial_balance')->name('trial_balance2');
    Route::get('reports/trial-balance2', 'ReportController@trial_balance2')->name('trial_balance');
    Route::get('reports/trial-balance3', 'ReportController@trial_balance3')->name('trial_balance3');
    Route::get('reports/profit-loss', 'ReportController@profit_loss')->name('profit_loss');
    Route::get('reports/profit-loss2', 'ReportController@profit_loss2')->name('profit_loss2');
    Route::get('reports/profit-loss3', 'ReportController@profit_loss3')->name('profit_loss3');
    Route::get('reports/loans-report', 'ReportController@loans_report')->name('loans_report');

    Route::get('reports/cash-flow', 'ReportController@cash_flow')->name('cash_flow');

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

    Route::get('contacts', 'ContactController@index')->name('business_contacts');
    Route::post('save_contact', 'ContactController@save_contact')->name('save_contact');
    Route::get('edit_contact/{id}', 'ContactController@edit_contact')->name('edit_contact');
    Route::patch('update_contact/{id}', 'ContactController@update_contact')->name('update_contact');

    // Billing
    Route::get('billings/search_client', 'BillingController@search_client')->name('SearchClient');
    Route::post('client_search', 'BillingController@client_search');
    Route::post('billings.new_bill', 'BillingController@new_bill')->name('NewBill');
    Route::get('billings/notification_Billing/{id}/{billcode}', 'BillingController@notification_bill')->name('NotificationBilling');
    Route::get('get_newProduct/{cat_id}', 'BillingController@get_product'); //Ajax
    Route::get('get_new_product_price/{prod_id}', 'BillingController@get_price'); //Ajax
    Route::post('add_new_product_to_bill_list', 'BillingController@save_bill_item');
    Route::get('billings/bill/{client_id}/{code}', 'BillingController@bill')->name('Bill');
    Route::get('billings/view_bill/{id}', 'BillingController@view_bill')->name('View_Client_Bill_List');
    Route::post('delete_New_Bill_payment', 'BillingController@productdeletion');
    Route::post('bill_posting', 'BillingController@bill_payment');

    //ClientDocument
    Route::get('client_document/client_document_list/{id}', 'ClientDocumentController@client_list')->name('Client_Document_List');
    Route::get('client_document/add_client_document/{id}', 'ClientDocumentController@add_client_document')->name('Add_Client_Document');
    Route::post('post_client_document', 'ClientDocumentController@store_client_document');
    Route::post('delete_client_document', 'ClientDocumentController@delete_client_document');
    Route::get('client_document/approve_document', 'ClientDocumentController@approve_document')->name('Approve_Document');
    Route::post('Approve_document', 'ClientDocumentController@approve_post_document');

    // Policies

    Route::get('policies/index', 'PolicyController@index')->name('Policy');
    Route::get('policies/create', 'PolicyController@create')->name('CreateNewPolicy');
    Route::post('Post_Policies', 'PolicyController@store_policy');
    Route::get('delete_policy/{id}', 'PolicyController@delete_policy');
    Route::get('update_policy/{id}/{policy}', 'PolicyController@update_policy');
    Route::get('policies/policy_approver', 'PolicyController@policy_approver')->name('PolicyApprover');
    Route::post('store_policy_approvers', 'PolicyController@store_policy_approvers');
    Route::get('change_policy_approvers/{id}', 'PolicyController@change_policy_approvers');
    Route::get('policy_segments/{policy_id}', 'PolicyController@policy_segments');

    // Policies Segment

    Route::get('policysegments/create', 'PolicySegmentController@create')->name('CreateNewPolicySegment');
    Route::post('Post_Policy_segment', 'PolicySegmentController@store_policy');
    Route::get('delete_policy_segment/{id}', 'PolicySegmentController@delete_policy_segment');
    Route::get('update_policy_segment/{id}/{segment}', 'PolicySegmentController@update_policy_segment');

    // Policy Statment

    Route::get('policyStatement/create', 'PolicyStatementController@create')->name('CreateNewPolicyStatement');
    Route::post('get_newSegment/{policy}', 'PolicyStatementController@get_newSegment');
    Route::post('Post_Policy_statement', 'PolicyStatementController@Post_Policy_statement');
    Route::get('statement_result/{policy}/{segment}', 'PolicyStatementController@statement_result');
    Route::get('delete_policy_statement/{id}', 'PolicyStatementController@delete_policy_statement');
    Route::get('get_statement_record/{id}', 'PolicyStatementController@get_statement_record');
    Route::post('Update_Policy_statement/{id}', 'PolicyStatementController@Update_Policy_statement');

    // Process Management

    Route::get('processes/index', 'ProcessController@index')->name('ProcessManagement');
    Route::get('processes/create', 'ProcessController@create')->name('CreateNewProcess');
    Route::post('Post_Process', 'ProcessController@store_process');
    Route::get('delete_process/{id}', 'ProcessController@delete_process');
    Route::get('update_process/{id}/{pro}', 'ProcessController@update_process');
    Route::get('processes/create_process_steps', 'ProcessController@create_process_steps')->name('CreateProcessSteps');
    Route::get('get_process_steps/{id}', 'ProcessController@get_process_steps');
    Route::post('post_process_step', 'ProcessController@post_process_step');
    Route::post('update_process_step', 'ProcessController@update_process_step');
    Route::get('get_step_values/{id}', 'ProcessController@get_step_values');
    Route::post('update_step_values', 'ProcessController@update_step_values');
    Route::get('delete_process_step/{id}/{proc}', 'ProcessController@delete_process_step');
    Route::get('processes/process_approver', 'ProcessController@process_approver')->name('ProcessApprover');
    Route::post('store_process_approvers', 'ProcessController@store_process_approvers');
    Route::get('change_process_approvers/{id}', 'ProcessController@change_process_approvers');
    Route::post('submit_process_attribute', 'ProcessController@submit_process_attribute');
    Route::post('submit_process_risk', 'ProcessController@submit_process_risk');
    Route::get('get_attribute_values/{id}', 'ProcessController@get_attribute_values');
    Route::get('processes/process_dept', 'ProcessController@process_dept_index')->name('ProcessDepartments');
    Route::post('Post_Process_department', 'ProcessController@store_process_department');
    Route::get('delete_process_dept/{id}', 'ProcessController@delete_process_dept');
    Route::get('update_process_dept/{id}/{pro}', 'ProcessController@update_process_dept');
    Route::get('get_process_steps_dept/{id}', 'ProcessController@get_process_steps_dept');
    Route::get('get_process_steps_dept_index/{id}', 'ProcessController@get_process_steps_dept_index');

    //ProductService
    Route::post('store_product_srvice', 'ProductServiceController@store');

    //Training

    Route::get('training/training_agency', 'TrainingController@training_agency_page')->name('TrainingAgencyPage');
    Route::post('post_training_agency', 'TrainingController@post_training_agency');
    Route::get('get_clicked_agency/{id}', 'TrainingController@get_clicked_agency');
    Route::get('training/training_course', 'TrainingController@training_course_page')->name('TrainingCourse');
    Route::post('post_training_course', 'TrainingController@post_training_course');
    Route::get('get_clicked_course/{id}', 'TrainingController@get_clicked_course');
    Route::get('training/schedule_training', 'TrainingController@schedule_training')->name('ScheduleTraining');

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
    Route::get('payroll/reports/reconciliation', 'PayrollReconController@index')->name('payroll.reports.recon');

    // payroll deductions
    Route::get('payroll/deductions', 'PayrollController@view_deductions')->name('payroll.deduction');
    Route::get('payroll/deductions/manual', 'PayrollController@get_manual_deductions')->name('payroll.deduction.manual');
    Route::post('payroll/deductions/manual', 'PayrollController@post_manual_deductions')->name('payroll.deductions.store');
    Route::post('/payroll/process-payroll', 'PayrollController@process_payroll');

    Route::get('payroll/deductions/{id}', 'PayrollController@get_user_deductions')->name('payroll.deduction.manual');

    // payslip
    Route::get('payslip', 'PayrollController@payslip_individual')->name('individual-payslip');
    // All employees payslip
    Route::get('payslips', 'PayrollController@payslip_general')->name('general-payslip');
    Route::post('payslips', 'PayrollController@payslip_general_post')->name('general-payslip-post');

    // -- end payroll

    // -- Workflow Module1
    Route::resource('workflow', 'WorkflowController');
    Route::get('approvallist', 'ApprovalController@checklist')->name('approvallist');
    Route::post('approvallist/approve', 'ApprovalController@approve');
    Route::post('approvallist/reject', 'ApprovalController@reject');

    // Risk Register
    Route::resource('risk-registers', 'RiskRegisterController');
    //  End Risk register

    // Begin Memorandum

    // sends memo for approval
    Route::get('memos/download/{id}', 'MemoController@download_memo_attachments')->name('download-attachment');
    Route::get('memos/send/{id}', 'MemoController@send')->name('send_memo');
    Route::get('memos/approvallist', 'MemoController@approval_list')->name('memos_approvallist');
    Route::post('memos/approve', 'MemoController@approve');
    Route::post('memos/process', 'MemoController@process')->name('process_memo');
    Route::post('memos/reject', 'MemoController@reject');

    // main memo routes
    Route::resource('memos', 'MemoController');
    // End Memorandum

    // Estate Management
    Route::name('facility-management.')->prefix('facility-management')->group(function () {
        Route::get('complaints/view-comment/{id}', 'ComplaintController@view_comments')->name('view-comments');
        Route::post('complaints/comment', 'ComplaintController@comment')->name('post-comment');
        Route::post('complaints/send', 'ComplaintController@send')->name('send-complaints');
        // Route::get('complaints', 'ComplaintController');
        Route::resource('complaints', 'ComplaintController');
    });

    // Litigation
    Route::name('litigation.')->prefix('litigation')->group(function () {
        Route::get('/', 'LitigationController@index')->name('index');
        Route::post('/create', 'LitigationController@store')->name('store');
        Route::get('/{id}', 'LitigationController@show')->name('show');
        Route::patch('/{id}', 'LitigationController@update')->name('update');
        Route::post('/upload_file/{id}', 'LitigationController@upload_litigation_file')->name('upload_litigation_file');
        Route::get('download-file/{dir}/{filename}', function ($dir, $filename) {
            return response()->download(storage_path("app/public/" . $dir . "/" . $filename));
        })->name('download_file');
    });

    //  Court and Location
    Route::get('courts', 'CourtController@index')->name('courts.index');
    Route::get('courts/create', 'CourtController@create')->name('courts.create');
    Route::post('courts', 'CourtController@store')->name('courts.store');

    //  Business Relationship Types
    Route::get('business-rel-types', 'BusinessRelationshipTypeController@index')->name('business-rel-types.index');
    Route::get('business-rel-types/create', 'BusinessRelationshipTypeController@create')->name('business-rel-types.create');
    Route::post('business-rel-types', 'BusinessRelationshipTypeController@store')->name('business-rel-types.store');
});

Route::get('/cls', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return redirect('/');
});

Route::get('/cda', function () {
    exec('composer dump-autoload');
    return redirect('/');
});

Route::get('/testing', function () {

    // return Cavidel\Staff::whereRaw("DepartmentID@ > array['1']::varchar[]")->get();
    // return Cavidel\Staff::whereRaw("1 = ANY(DepartmentID)")->get();
    // return Cavidel\Staff::whereRaw("find_in_set('1', DepartmentID)")->get();
    // return Cavidel\Staff::whereRaw("CONCAT(',', DepartmentID, ',')LIKECONCAT('%,', 1, ',%')")->get();
    // return Cavidel\Department::find('4')->staff();
    // return Cavidel\Staff::all()->filter('1', function(){
    // })->get();
});

//Reconciliation Routes

Route::get('/entry/ars', 'internalPageController@index')->name('ars_recon');
Route::get('/entry/ars_recon_upload', 'internalPageController@upload_data')->name('ars_recon_upload_data');
Route::get('/bank', 'internalPageController@showBank');
Route::get('/ledger', 'internalPageController@showLedger');

// upload data
Route::post('/bank', 'jsonResponseController@addBankItem');
Route::post('/ledger', 'jsonResponseController@addLedgerItem');

Route::get('/load/all', 'jsonResponseController@loadAllItems');
Route::get('/load/bank', 'jsonResponseController@loadBankItem');
Route::get('/load/ledger', 'jsonResponseController@loadLedgerItem');

// flag items
Route::post('/flag/item', 'jsonResponseController@flagItem');

/*
|--------------------------------
| check and uncheck ledger item
|--------------------------------
|
 */
Route::post('/flag/ledger/checked', 'jsonResponseController@checkedLedgerItem');
Route::post('/flag/ledger/unchecked', 'jsonResponseController@uncheckedLedgerItem');

/*
|--------------------------------
| check and uncheck bank item
|--------------------------------
|
 */
Route::post('/flag/bank/checked', 'jsonResponseController@checkedBankItem');
Route::post('/flag/bank/unchecked', 'jsonResponseController@uncheckedBankItem');

/*
|--------------------------------
| Load recon total
|--------------------------------
|
 */
Route::get('/load/recon/total', 'jsonResponseController@loadStoredRecon');

/*
|--------------------------------
| Load bank list menu
|--------------------------------
|
 */
Route::get('/load/bank/name', 'jsonResponseController@loadBankSelectMenu');
Route::get('/load/location/name', 'jsonResponseController@loadBranchSelectMenu');
Route::get('/load/ledger/name', 'jsonResponseController@loadLedgerSelectMenu');
// Route::get('/load/drop/dropdown',       function (){
//     return "seen!";
// });
// Route::get('/load/location/name',       'jsonResponseController@loadBranchSelectMenu');

/*
|--------------------------------
| Save data to recon table
|--------------------------------
|
 */
Route::post('/save/data/recon/table', 'jsonResponseController@saveDataForSorting');
