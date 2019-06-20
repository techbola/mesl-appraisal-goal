<?php

Route::middleware(['auth'])->prefix('supervisor')->group(function () {

    Route::get('/', [
        'uses' => 'SupervisorController@index',
        'as' => 'supervisor.index'
    ]);

    Route::get('/appraisal/{appraisalID}', [
        'uses' => 'SupervisorController@appraisal',
        'as' => 'supervisorViewAppraisal'
    ]);

    Route::post('/goals/{appraisalID}/approval', [
        'uses' => 'SupervisorController@goalsApproval',
        'as' => 'goalsApproval'
    ]);

    Route::get('/submit/appraisal/{appraisalID}/hr', [
        'uses' => 'SupervisorController@submitToHr',
        'as' => 'submitToHr'
    ]);

});