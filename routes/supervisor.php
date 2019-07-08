<?php

Route::name('appraisal.')->middleware(['auth'])->prefix('supervisor')->group(function () {

    Route::get('/', [
        'uses' => 'SupervisorController@index',
        'as'   => 'supervisor.index',
    ]);

    Route::get('/appraisal/{appraisalID}', [
        'uses' => 'SupervisorController@appraisal',
        'as'   => 'supervisorViewAppraisal',
    ]);

    Route::post('/goals/{appraisalID}/approval', [
        'uses' => 'SupervisorController@goalsApproval',
        'as'   => 'goalsApproval',
    ]);

    Route::get('/submit/appraisal/{appraisalID}/hr', [
        'uses' => 'SupervisorController@submitToHr',
        'as'   => 'submitToHr',
    ]);

    //    Supervisor - Staff Appraisal

    Route::get('/view/staff/appraisal/{appraisalID}', [
        'uses' => 'Appraisal\SupervisorAppraisalController@staffAppraisal',
        'as'   => 'supervisorViewStaffAppraisal',
    ]);

    Route::post('/appraisal/{appraisalID}/approval', [
        'uses' => 'Appraisal\SupervisorAppraisalController@staffAppraisalApproval',
        'as'   => 'staffAppraisalApproval',
    ]);

    //    Supervisor Goals

    Route::get('/set/goals', [
        'uses' => 'SupervisorController@supervisorNewGoal',
        'as'   => 'supervisorNewGoal',
    ]);

    Route::post('supervisor/goal/store', [
        'uses' => 'SupervisorController@staffDetailsStore',
        'as'   => 'supervisor_details.store',
    ]);

    Route::get('/dashboard/{appraisalID}', [
        'uses' => 'SupervisorController@dashboard',
        'as'   => 'supervisorDashboard',
    ]);

    Route::get('/all/goals', [
        'uses' => 'SupervisorController@allAppraisals',
        'as'   => 'supervisorAppraisals',
    ]);

    Route::get('/submit/appraisal/{id}', [
        'uses' => 'SupervisorController@submitAppraisalSupervisor',
        'as'   => 'supervisorSubmitAppraisal',
    ]);

    Route::get('/view/goals/{id}', [
        'uses' => 'SupervisorController@viewGoals',
        'as'   => 'supervisorViewGoals',
    ]);

    Route::get('/edit/appraisal/{id}', [
        'uses' => 'SupervisorController@editAppraisal',
        'as'   => 'supervisorEditAppraisal',
    ]);

    Route::get('/delete/appraisal/{id}', [
        'uses' => 'SupervisorController@deleteAppraisal',
        'as'   => 'supervisorDeleteAppraisal',
    ]);

    Route::get('/rejected/goals/{id}', [
        'uses' => 'SupervisorController@rejectedGoalsa',
        'as'   => 'supervisorRejectedGoals',
    ]);

    //    Finance Goal Settings
    Route::post('/bsc_financial/store', [
        'uses' => 'Supervisor\FinanceAppraisalController@bscFinancialStore',
        'as'   => 'supervisor.bsc_financial.store',
    ]);
    Route::post('/delete/finance/appraisals', [
        'uses' => 'Supervisor\FinanceAppraisalController@deleteAppraisals',
        'as'   => 'supervisor.deleteFinanceAppraisals',
    ]);
    Route::post('/update/finance/appraisal', [
        'uses' => 'Supervisor\FinanceAppraisalController@updateFinanceAppraisal',
        'as'   => 'supervisor.updateFinanceAppraisal',
    ]);

//    Customer Goal Settings
    Route::post('/bsc_customer/store', [
        'uses' => 'Supervisor\CustomerAppraisalController@bscCustomerStore',
        'as'   => 'supervisor.bsc_customer.store',
    ]);
    Route::post('/delete/customer/appraisals', [
        'uses' => 'Supervisor\CustomerAppraisalController@deleteAppraisals',
        'as'   => 'supervisor.deleteCustomerAppraisals',
    ]);
    Route::post('/update/customer/appraisal', [
        'uses' => 'Supervisor\CustomerAppraisalController@updateCustomerAppraisal',
        'as'   => 'supervisor.updateCustomerAppraisal',
    ]);

//    Internal process Goal Settings
    Route::post('/bsc_internal/store', [
        'uses' => 'Supervisor\InternalAppraisalController@bscInternalStore',
        'as'   => 'supervisor.bsc_internal.store',
    ]);
    Route::post('/delete/internal/appraisals', [
        'uses' => 'Supervisor\InternalAppraisalController@deleteAppraisals',
        'as'   => 'supervisor.deleteInternalAppraisals',
    ]);
    Route::post('/update/internal/appraisal', [
        'uses' => 'Supervisor\InternalAppraisalController@updateInternalAppraisal',
        'as'   => 'supervisor.updateInternalAppraisal',
    ]);

//    Learning Goal Store
    Route::post('/bsc_learning/store', [
        'uses' => 'Supervisor\LearningAppraisalController@bscLearningStore',
        'as'   => 'supervisor.bsc_learning.store',
    ]);
    Route::post('/delete/learning/appraisals', [
        'uses' => 'Supervisor\LearningAppraisalController@deleteAppraisals',
        'as'   => 'supervisor.deleteLearningAppraisals',
    ]);
    Route::post('/update/learning/appraisal', [
        'uses' => 'Supervisor\LearningAppraisalController@updateLearningAppraisal',
        'as'   => 'supervisor.updateLearningAppraisal',
    ]);

    //    Staff Behavioural
    Route::post('/behavioural/store', [
        'uses' => 'Supervisor\StaffBehaviouralItemController@staffBehaviouralStore',
        'as'   => 'supervisor.behavioural.store',
    ]);

    Route::post('/behavioural/update', [
        'uses' => 'Supervisor\StaffBehaviouralItemController@updateStaffBehavioural',
        'as'   => 'supervisor.update.behavioural',
    ]);

    //    Appraisal Comment
    Route::get('/delete/comment/appraisal/{cID}', [
        'uses' => 'Supervisor\AppraisalCommentController@deleteAppraisalComment',
        'as'   => 'supervisor.deleteAppraisalComment',
    ]);

    Route::post('/update/comment/appraisal', [
        'uses' => 'Supervisor\AppraisalCommentController@updateAppraisalComment',
        'as'   => 'supervisor.updateAppraisalComment',
    ]);

//    Appraisal Signature
    Route::get('/delete/signature/appraisal/{signID}', [
        'uses' => 'Supervisor\AppraisalSignatureController@deleteAppraisalSignature',
        'as'   => 'supervisor.deleteAppraisalSignature',
    ]);

    Route::post('/update/signature/appraisal', [
        'uses' => 'Supervisor\AppraisalSignatureController@updateAppraisalSign',
        'as'   => 'supervisor.updateAppraisalSign',
    ]);

});
