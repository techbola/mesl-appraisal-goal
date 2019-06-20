<?php

Route::middleware(['auth'])->prefix('hr')->group(function () {

    Route::get('/', [
        'uses' => 'HrController@index',
        'as' => 'hr.index'
    ]);

    Route::get('/behavioural/items', [
        'uses' => 'HrController@behaviouralItems',
        'as' => 'hr.behavioural.items'
    ]);

    Route::resource('behavioural', 'BehaviouralController');
    Route::resource('behavioural_item', 'BehaviouralItemController');
    Route::resource('levels', 'LevelController');

    Route::get('/staff/goals', [
        'uses' => 'HrController@hrStaffGoals',
        'as' => 'hrStaffGoals'
    ]);

    Route::get('/appraisal/{appraisalID}', [
        'uses' => 'HrController@appraisal',
        'as' => 'hrViewAppraisal'
    ]);

    Route::post('/goals/{appraisalID}/approval', [
        'uses' => 'HrController@goalsApproval',
        'as' => 'hrGoalsApproval'
    ]);

});