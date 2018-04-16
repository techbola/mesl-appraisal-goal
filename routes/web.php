<?php
// Please leave the arrangement of this file as is

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/login2', function(){
  return view('auth.login_old');
});

Route::group(['middleware' => 'guest'], function()
{
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
    Route::resource('menus', 'MenuController');
    Route::get('menus/edit/{id}', 'MenuController@edit')->name('edit_menu');
    Route::delete('menus/delete/{id}', 'MenuController@destroy')->name('delete_menu');

    Route::get('staff', 'StaffController@index')->name('staff');
    // Route::get('staff', 'StaffController@invite')->name('invite_staff');
    Route::post('invite_staff', 'StaffController@post_invite')->name('invite_staff');

    Route::get('projects', 'ProjectController@index')->name('projects');
    Route::post('store_project', 'ProjectController@store')->name('store_project');
    Route::patch('update_project/{id}', 'ProjectController@update')->name('update_project');
    Route::get('project/{id}', 'ProjectController@view_project')->name('view_project');

    Route::post('save_task', 'ProjectController@save_task')->name('save_task');
    Route::post('save_projectchat', 'ProjectController@save_projectchat')->name('save_projectchat');

    Route::get('task/{id}', 'TaskController@view')->name('view_task');
    Route::post('task/{id}/add_step', 'TaskController@add_step')->name('add_step');
    Route::get('toggle_step/{id}', 'TaskController@toggle_step')->name('toggle_step');
    Route::patch('edit_step/{id}', 'TaskController@edit_step')->name('edit_step');

    Route::resource('clients', 'ClientController');

    Route::get('messages/inbox', 'MessageController@inbox')->name('inbox');
    Route::get('messages/sent', 'MessageController@sent_messages')->name('sent_messages');
    Route::get('messages/compose', 'MessageController@compose')->name('compose_message');
    Route::post('messages/send', 'MessageController@send_message')->name('send_message');
    Route::post('messages/reply/{parent_id}', 'MessageController@reply_message')->name('reply_message');
    Route::get('message/{id}/{reply?}', 'MessageController@view_message')->name('view_message');

    Route::get('bulletins', 'BulletinController@index')->name('bulletin_board');
    Route::post('save_bulletin', 'BulletinController@save_bulletin')->name('save_bulletin');
    Route::post('bulletin/{id}', 'BulletinController@view_bulletin')->name('view_bulletin');



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



    Route::get('customers/editList', 'CustomerController@customerEditList')->name('CustomerUpdate');
    Route::resource('customers', 'CustomerController');

    Route::get('documents', 'DocumentController@index')->name('documents');
    Route::get('my_documents', 'DocumentController@my_documents')->name('my_documents');
    Route::post('document_store', 'DocumentController@store')->name('document_store');
    Route::get('download-document/{file}', function($file){
      return response()->download(storage_path("app/documents/".$file));
    })->name('docs');
    Route::resource('doctypes', 'DocTypeController');

    Route::get('events', 'EventScheduleController@index')->name('events');
    Route::get('get_events', 'EventScheduleController@get_events')->name('get_events'); // AJAX
    Route::post('save_event', 'EventScheduleController@save_event')->name('save_event');
    Route::get('event/{id}', 'EventScheduleController@view_event')->name('view_event');
    Route::patch('update_event/{id}', 'EventScheduleController@update_event')->name('update_event');
    Route::delete('delete_event/{id}', 'EventScheduleController@delete_event')->name('delete_event');



    Route::get('gls/create2', 'GLController@create2')->name('gls.create2');
    Route::get('gls/{id}/edit2', 'GLController@edit2')->name('gls.edit2');
    Route::post('gls/create2', 'GLController@storeLoan');
    Route::patch('gls/{id}/edit2', 'GLController@update2');
    Route::resource('gls', 'GLController');

    Route::get('cash_entries/customer_transfer', 'CashEntryController@customer_transfer')->name('customer_transfer');
    Route::post('cash_entries/customer_transfer', 'CashEntryController@customer_transfer_store');
    Route::get('cash_entries/customer_transfer/{id}', 'CashEntryController@customer_transfer_edit')->name('customer_transfer.edit');
    Route::patch('cash_entries/customer_transfer/{id}', 'CashEntryController@customer_transfer_update');
    Route::patch('cash_entries/edit_b/{id}', 'CashEntryController@update2');
    Route::resource('cash_entries', 'CashEntryController');

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

    Route::get('reports/expired-loans', 'ReportController@matured_loans')->name('matured_loans');
    Route::get('reports/running-loans', 'ReportController@outstanding_loans')->name('outstanding_loans');
    Route::get('reports/loan-pretermination', 'ReportController@loan_pretermination')->name('loan_pretermination');
    Route::post('reports/preterminate/{id}', 'ReportController@preterminate')->name('preterminate');

    Route::get('reports/savings', 'ReportController@savings')->name('savings_accounts');
    Route::get('reports/loan-status', 'ReportController@loan_status')->name('loan_status');

    Route::get('kb/categories', 'KnowledgeController@categories')->name('kb-categories');
    Route::post('save_kb_cat', 'KnowledgeController@save_category')->name('save_kb_cat');
    Route::get('kb/category/{id}', 'KnowledgeController@category_index')->name('category_index');
});

Route::get('/abc', function(){
  // $menu_ids = \App\Menu::whereIn('slug', ['projects'])->get();
  // dd($menu_ids->pluck('id')->toArray());
  $role = \App\Role::where('name', 'software developer')->first();
  // dd($role->menus);
  dd(auth()->user()->roles);
});
