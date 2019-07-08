<?php

Route::name('appraisal.')->middleware(['auth'])->prefix('hr')->group(function () {

    Route::get('/', [
        'uses' => 'HrController@index',
        'as'   => 'hr.index',
    ]);

    Route::get('/behavioural/items', [
        'uses' => 'HrController@behaviouralItems',
        'as'   => 'hr.behavioural.items',
    ]);

    Route::resource('behavioural', 'BehaviouralController');
    Route::resource('behavioural_item', 'BehaviouralItemController');
    Route::resource('levels', 'LevelController');

    Route::get('/staff/goals', [
        'uses' => 'HrController@hrStaffGoals',
        'as'   => 'hrStaffGoals',
    ]);

    Route::get('/staff/goals/as/supervisor', [
        'uses' => 'HrController@hrStaffGoalsAsSupervisor',
        'as'   => 'hrStaffGoals.asSupervisor',
    ]);

    Route::get('/staff/goals/{appraisalID}', [
        'uses' => 'HrController@appraisal',
        'as'   => 'hrViewAppraisal',
    ]);

    Route::post('/goals/{appraisalID}/approval', [
        'uses' => 'HrController@goalsApproval',
        'as'   => 'hrGoalsApproval',
    ]);

    Route::get('/staff/appraisals', [
        'uses' => 'Appraisal\HrAppraisalController@hrStaffAppraisals',
        'as'   => 'hrStaffAppraisals',
    ]);

    Route::get('/staff/appraisal/{appraisalID}', [
        'uses' => 'Appraisal\HrAppraisalController@viewAppraisal',
        'as'   => 'hrViewStaffAppraisal',
    ]);

    Route::get('/staff/score/report/{appraisalID}', [
        'uses' => 'Appraisal\HrAppraisalController@viewScoreReport',
        'as'   => 'hrViewScoreReport',
    ]);

    Route::get('/all/staff/appraisals/home', [
        'uses' => 'Appraisal\HrAppraisalController@allStaffIndexAppraisals',
        'as'   => 'hrAllStaffIndexAppraisals',
    ]);

    Route::post('/all/staff/appraisals/', [
        'uses' => 'Appraisal\HrAppraisalController@allStaffAppraisals',
        'as'   => 'hrAllStaffAppraisals',
    ]);

    Route::get('/download/score/report/{apID}', [
        'uses' => 'Appraisal\HrAppraisalController@downloadScoreReport',
        'as'   => 'downloadScoreReport',
    ]);

    // Route::get('/export/appraisals/pdf', [
    //     'uses' => 'Appraisal\HrAppraisalController@export_pdf',
    //     'as'   => 'exportAppraisals',
    // ]);

});
