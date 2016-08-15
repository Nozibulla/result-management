<?php

/*
|--------------------------------------------------------------------------
| Front-End Routes
|--------------------------------------------------------------------------
|
| Heres all the routes for result search in front-end.
|
 */

Route::group(['middleware' => ['web']], function () {

	Route::get('/', 'SearchResult@searchResult');

	Route::post('/', 'SearchResult@fetchsearchResult');

	Route::get('/single_result', 'SearchResult@searchResult');

	Route::post('/single_result', 'SearchResult@showIndivisualResult');

});

Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::get('/dashboard', function () {
		return view('index');
	});

/*==========================================
=            Add details Routes            =
==========================================*/

	Route::get('add_details', 'StudentsController@addDetails');

	Route::post('save_subject', 'StudentsController@saveSubject');

	Route::post('save_class', 'StudentsController@saveClass');

	Route::post('save_batch', 'StudentsController@saveBatch');

	Route::post('save_shift', 'StudentsController@saveShift');

/*=====  End of Add details Routes  ======*/

/*========================================================
=            Students Add, Edit, Delete, List, Filter    =
========================================================*/

	Route::get('add-student', 'StudentsController@addStudent');

	Route::get('student-list', 'StudentsController@studentList');

	Route::post('savestudent', 'StudentsController@saveStudent');

	Route::post('deletestudent', 'StudentsController@deleteStudent');

	Route::post('editstudent', 'StudentsController@editStudent');

	Route::post('save-edited-student', 'StudentsController@saveEditStudent');

	Route::post('filter-student', 'StudentsController@filterStudent');

	Route::post('filter_student_by_year', 'StudentsController@filterStudentByYear');

/*=====  End of Students Add, Edit, Delete, List  ======*/

/*=================================================
=            Results Add, Edit, Delete            =
=================================================*/
	Route::get('add_result', 'ResultsController@addResultPpage');

	Route::post('save_result', 'ResultsController@saveResult');

	Route::post('add-result', 'ResultsController@addResult');

	Route::post('deleteresult', 'ResultsController@deleteResult');

	Route::post('editresult', 'ResultsController@editResult');

	Route::post('save-edited-result', 'ResultsController@saveEditedResult');

/*=====  End of Results Add, Edit, Delete  ======*/

/*=====================================
=            Filter Result            =
=====================================*/

	Route::get('result_category', 'ResultsController@resultCategory');

	Route::get('show_result_by_class', 'ResultsController@showResultByClass');

	Route::post('view_result_by_class', 'ResultsController@viewResultByClass');
	Route::get('view_result_by_class', function () {
		return 'This page is dead already please go to show result page to show result again';
	});

	Route::get('show_result_by_batch', 'ResultsController@showResultByBatch');

	Route::post('view_result_by_batch', 'ResultsController@viewResultByBatch');
	Route::get('view_result_by_batch', function () {
		return 'This page is dead already please go to show result page to show result again';
	});

	Route::get('show_result_by_shift', 'ResultsController@showResultByShift');

	Route::post('view_result_by_shift', 'ResultsController@viewResultByShift');
	Route::get('view_result_by_shift', function () {
		return 'This page is dead already please go to show result page to show result again';
	});

/*=====  End of Filter Result  ======*/

/*=========================================
=            Successive Result            =
=========================================*/

	Route::get('successive_class_perfomance_by_class_and_batch', 'ResultsController@successiveClassPerfomance');

	Route::post('successive_class_perfomance_by_class_and_batch', 'ResultsController@successiveClassPerfomanceByClassBatch');

/*=====  End of Successive Result  ======*/

/*========================================
=            Class Perfomance            =
========================================*/

	Route::get('class_perfomance_by_batch', 'ResultsController@getClassPerfomanceByBatch');

	Route::post('class_perfomance_by_batch', 'ResultsController@classPerfomanceByBatch');
	Route::post('class_perfomance_by_class', 'ResultsController@classPerfomanceByClass');
	Route::post('class_perfomance_by_shift', 'ResultsController@classPerfomanceByShift');

/*=====  End of Class Perfomance  ======*/

/*==========================================
=            Compare Perfomance            =
==========================================*/

	Route::get('compare_perfomance', 'ResultsController@comparePerfomance');

	Route::post('compare_perfomance', 'ResultsController@comparePerfomanceByMonth');

/*=====  End of Compare Perfomance  ======*/

/**
 * Individual Result
 */
	Route::get('show_invivisual_result/{student_id}', 'ResultsController@optionForIndivisualResult');
	Route::get('/show_invivisual_result', function () {
		return 'This page is dead already please go to student list page to show result again';
	});
	Route::post('/show_invivisual_result', 'ResultsController@showIndivisualResult');


/**
 * Show Postion 
 */

Route::get('show_position', 'ResultsController@showPosition');

Route::get('/show_position_in_class', 'ResultsController@showPosition');
Route::get('/show_position_in_shift', 'ResultsController@showPosition');
Route::get('/show_position_in_batch', 'ResultsController@showPosition');

Route::post('/show_position_in_class', 'ResultsController@showPositionInClass');
Route::post('/show_position_in_shift', 'ResultsController@showPositionInShift');
Route::post('/show_position_in_batch', 'ResultsController@showPositionInBatch');


/**
 * Show Alarming Student
 */
Route::get('/alarming_student', 'ResultsController@alarmingStudent');

Route::get('/alarming_student_by_class', 'ResultsController@alarmingStudent');
Route::get('/alarming_student_by_shift', 'ResultsController@alarmingStudent');
Route::get('/alarming_student_by_batch', 'ResultsController@alarmingStudent');

Route::post('/alarming_student_by_class', 'ResultsController@alarmingStudentByClass');
Route::post('/alarming_student_by_shift', 'ResultsController@alarmingStudentByShift');
Route::post('/alarming_student_by_batch', 'ResultsController@alarmingStudentByBatch');

/**
 * Result by Date
 */

Route::get('result_by_date', 'ResultsController@resultByDate');

Route::post('result_by_date_class', 'ResultsController@resultByDateClass');
Route::post('result_by_date_shift', 'ResultsController@resultByDateShift');
Route::post('result_by_date_batch', 'ResultsController@resultByDateBatch');

});


