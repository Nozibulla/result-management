<?php

namespace App\Http\Controllers;

use App\Dailyresult;
use App\Http\Controllers\Controller;
use App\Student;
use DB;
use Illuminate\Http\Request;
use App\Subject;

class ResultsController extends Controller {

	public function __construct() {

		$this->middleware('auth');

	}

	public function addResultPpage() {

		$students = Student::take(40)->orderBy('roll', 'ASC')->get();

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		// $months = Dailyresult::distinct()->lists('month', 'month');

		$subjects = Subject::distinct()->lists('name', 'name');

		// return $students;

		return view('results/add_result_page', compact('students', 'years', 'classes', 'batches', 'shifts', 'subjects'));

	}

	/**
	 * Save Result of a student
	 */

	public function saveResult(Request $request) {

		$student_id = $request->student_id;
		$date = $this->setDateinString($request->tarikh);
		$month = $request->month;
		$subject = $request->subject;
		$marks = $request->marks;

		// return compact('student_id', 'marks', 'date', 'month', 'subject');

		$check_if_exists = Dailyresult::where('student_id', '=', $student_id)->where($date, '!=', 0 )->where('month', '=', $month)->first();
		if($check_if_exists){

			return 'Result Already Exists Check Again';
		}elseif($marks != 0){

			$result = new Dailyresult;

			$result->month = $month;

			$result->subject = $subject;

			$result->$date = $marks;
			
			$result->student_id = $student_id;

			$result->save();
		}
	}

	/**
	 * Show page for result by date
	 */

	public function resultByDate()
	{
		$months = Dailyresult::distinct()->lists('month', 'month');

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		return view('results/result_by_date', compact('years', 'months', 'classes', 'shifts', 'batches'));
	}

	/**
	 * Show result by date in Class
	 */

	public function resultByDateClass(Request $request)
	{
		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$date = $this->setDateinString($request->input('tarikh'));
		
		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw("SUM($date) as $date"))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->orderBy('roll', 'asc')
		->get();

		return view('results/show_result_by_date_in_class', compact('results', 'year', 'month', 'class', 'date'));
	}

	/**
	 * Show result by date in Shift
	 */

	public function resultByDateShift(Request $request)
	{
		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$shift = $request->input('shift');
		$date = $this->setDateinString($request->input('tarikh'));
		
		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw("SUM($date) as $date"))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->orderBy('roll', 'asc')
		->get();

		return view('results/show_result_by_date_in_shift', compact('results', 'year', 'month', 'class', 'shift', 'date'));
	}
/**
	 * Show result by date in Batch
	 */

	public function resultByDateBatch(Request $request)
	{
		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$shift = $request->input('shift');
		$batch = $request->input('batch');
		$date = $this->setDateinString($request->input('tarikh'));
		
		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw("SUM($date) as $date"))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->where('batch', '=', $batch)
		->orderBy('roll', 'asc')
		->get();

		return view('results/show_result_by_date_in_batch', compact('results', 'year', 'month', 'class', 'shift', 'batch', 'date'));
	}

	/**
	 * Show page for showing different types of result like result for a class or a shift.
	 */

	public function resultCategory() {

		$months = Dailyresult::distinct()->lists('month', 'month');

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		return view('results/result_category', compact('years', 'months', 'classes', 'shifts', 'batches'));
	}

	/**
	 * View for show result by Class
	 */

	public function showResultByClass() {

		$months = Dailyresult::distinct()->lists('month', 'month');

		$classes = Student::distinct()->lists('class', 'class');

		return view('results/result_by_class', compact('months', 'classes'));
	}

	/**
	 * View for show result by Batch
	 */

	public function showResultByBatch() {

		$months = Dailyresult::distinct()->lists('month', 'month');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		return view('results/result_by_batch', compact('months', 'classes', 'batches'));
	}

	/**
	 * View for show result by Shift
	 */

	public function showResultByShift() {

		$months = Dailyresult::distinct()->lists('month', 'month');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		return view('results/result_by_shift', compact('months', 'classes', 'batches', 'shifts'));
	}

	/**
	 * Fetching result by class and send then to the view.
	 */

	public function viewResultByClass(Request $request) {

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('SUM(subject) as total_subject'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->get();
		// return $results;

		return view('results/show_result_by_class', compact('results', 'year', 'month', 'class'));

	}

	/**
	 * Fetching result by batch and send then to the view.
	 */

	public function viewResultByBatch(Request $request) {

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$shift = $request->input('shift');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('SUM(subject) as total_subject'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->get();

		return view('results/show_result_by_batch', compact('results', 'year', 'month', 'class', 'shift'));

	}

	/**
	 * Fetch result by Shift and send then to the view.
	 */

	public function viewResultByShift(Request $request) {

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$batch = $request->input('batch');
		$shift = $request->input('shift');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('SUM(subject) as total_subject'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->get();

		return view('results/show_result_by_shift', compact('results', 'year', 'month', 'class', 'batch', 'shift'));

	}

	public function alarmingStudent()
	{
		$months = Dailyresult::distinct()->lists('month', 'month');

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		return view('students/alarming_student', compact('years', 'months', 'classes', 'shifts', 'batches'));
	}

	public function alarmingStudentByClass(Request $request)
	{

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->get();

		if($results->first()){

			$student_postion = $this->calculateAlarming($results);

			return view('students/alarming_by_class', compact('student_postion', 'year', 'month', 'class'));

		}else{ return 'Result not found';}

	}

	/**
	 * Alarming Student in Shift
	 */
	
	public function alarmingStudentByShift(Request $request) {

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$shift = $request->input('shift');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->get();

		if($results->first()){

			$student_postion = $this->calculateAlarming($results);

			return view('students/alarming_by_shift', compact('student_postion', 'year', 'month', 'class', 'shift'));
		}else{ return 'Result not found';}
	}

	/**
	 * Show Alarming by Batch
	 */
	
	public function alarmingStudentByBatch(Request $request) {

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$batch = $request->input('batch');
		$shift = $request->input('shift');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->get();

		if($results->first()){

			$student_postion = $this->calculateAlarming($results);

			return view('students/alarming_by_batch', compact('student_postion', 'year', 'month', 'class', 'shift', 'batch'));
		}else{ return 'Result not found';}

	}



	public function showPosition()
	{
		$months = Dailyresult::distinct()->lists('month', 'month');

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		return view('results/show_position', compact('years', 'months', 'classes', 'shifts', 'batches'));
	}

	public function showPositionInClass(Request $request)
	{

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->get();

		if($results->first()){

			$student_postion = $this->calculatePosition($results);

			return view('results/show_position_in_class', compact('student_postion', 'year', 'month', 'class'));

		}else{ return 'Result not found';}

	}

	public function showPositionInShift(Request $request) {

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$shift = $request->input('shift');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->get();

		if($results->first()){

			$student_postion = $this->calculatePosition($results);

			return view('results/show_position_in_shift', compact('student_postion', 'year', 'month', 'class', 'shift'));
		}else{ return 'Result not found';}
	}

	/**
	 * Fetch result by Shift and send then to the view.
	 */

	public function showPositionInBatch(Request $request) {

		$year = $request->input('year');
		$month = $request->input('month');
		$class = $request->input('class');
		$batch = $request->input('batch');
		$shift = $request->input('shift');

		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('year', '=', $year)
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->get();

		if($results->first()){

			$student_postion = $this->calculatePosition($results);

			return view('results/show_position_in_batch', compact('student_postion', 'year', 'month', 'class', 'shift', 'batch'));
		}else{ return 'Result not found';}

	}


	public function calculatePosition($results)
	{
		$i = 0;

		foreach ($results as $result) {
			
			$total_marks = $result->one +
			$result->two +
			$result->three +
			$result->four +
			$result->five +
			$result->six +
			$result->seven +
			$result->eight +
			$result->nine +
			$result->ten +
			$result->eleven +
			$result->twelve +
			$result->thirteen +
			$result->fourteen +
			$result->fifteen +
			$result->sixteen +
			$result->seventeen +
			$result->eighteen +
			$result->nineteen +
			$result->twenty +
			$result->twentyone +
			$result->twentytwo +
			$result->twentythree +
			$result->twentyfour +
			$result->twentyfive +
			$result->twentysix +
			$result->twentyseven +
			$result->twentyeight +
			$result->twentynine +
			$result->thirty +
			$result->thirtyone;

			$total_subjects = $result->subject_one +
			$result->subject_two +
			$result->subject_three +
			$result->subject_four +
			$result->subject_five +
			$result->subject_six +
			$result->subject_seven +
			$result->subject_eight +
			$result->subject_nine +
			$result->subject_ten +
			$result->subject_eleven +
			$result->subject_twelve +
			$result->subject_thirteen +
			$result->subject_fourteen +
			$result->subject_fifteen +
			$result->subject_sixteen +
			$result->subject_seventeen +
			$result->subject_eighteen +
			$result->subject_nineteen +
			$result->subject_twenty +
			$result->subject_twentyone +
			$result->subject_twentytwo +
			$result->subject_twentythree +
			$result->subject_twentyfour +
			$result->subject_twentyfive +
			$result->subject_twentysix +
			$result->subject_twentyseven +
			$result->subject_twentyeight +
			$result->subject_twentynine +
			$result->subject_thirty +
			$result->subject_thirtyone;

//calculating grade and In percent

			$gross_marks = $total_subjects * 4;

			$student[$i]['total_marks'] = $total_marks;

			$student[$i]['name'] = $result->name;

			$student[$i]['roll'] = $result->roll;

			$student[$i]['in_percent'] = ($total_marks * 100) / $gross_marks;

			$student[$i]['grade'] = $this->calculateGrade($student[$i]['in_percent']);

			$i++;
		}

		usort( $student, function($a, $b) {
			if( $a['in_percent'] == $b['in_percent'] )
				return 0;
			return ( $a['in_percent'] < $b['in_percent'] ) ? 1 : -1;
		} );

		return $student;
	}

	public function calculateAlarming($results)
	{
		$i = 0;
		$student = null;

		foreach ($results as $result) {
			
			$total_marks = $result->one +
			$result->two +
			$result->three +
			$result->four +
			$result->five +
			$result->six +
			$result->seven +
			$result->eight +
			$result->nine +
			$result->ten +
			$result->eleven +
			$result->twelve +
			$result->thirteen +
			$result->fourteen +
			$result->fifteen +
			$result->sixteen +
			$result->seventeen +
			$result->eighteen +
			$result->nineteen +
			$result->twenty +
			$result->twentyone +
			$result->twentytwo +
			$result->twentythree +
			$result->twentyfour +
			$result->twentyfive +
			$result->twentysix +
			$result->twentyseven +
			$result->twentyeight +
			$result->twentynine +
			$result->thirty +
			$result->thirtyone;

			$total_subjects = $result->subject_one +
			$result->subject_two +
			$result->subject_three +
			$result->subject_four +
			$result->subject_five +
			$result->subject_six +
			$result->subject_seven +
			$result->subject_eight +
			$result->subject_nine +
			$result->subject_ten +
			$result->subject_eleven +
			$result->subject_twelve +
			$result->subject_thirteen +
			$result->subject_fourteen +
			$result->subject_fifteen +
			$result->subject_sixteen +
			$result->subject_seventeen +
			$result->subject_eighteen +
			$result->subject_nineteen +
			$result->subject_twenty +
			$result->subject_twentyone +
			$result->subject_twentytwo +
			$result->subject_twentythree +
			$result->subject_twentyfour +
			$result->subject_twentyfive +
			$result->subject_twentysix +
			$result->subject_twentyseven +
			$result->subject_twentyeight +
			$result->subject_twentynine +
			$result->subject_thirty +
			$result->subject_thirtyone;

//calculating grade and In percent
//

			

			$gross_marks = $total_subjects * 4;

			$in_percent = ($total_marks * 100) / $gross_marks;

			if ($in_percent < 60) {

				$student[$i]['total_marks'] = $total_marks;

				$student[$i]['name'] = $result->name;

				$student[$i]['roll'] = $result->roll;

				$student[$i]['in_percent'] = $in_percent;

				$student[$i]['grade'] = $this->calculateGrade($student[$i]['in_percent']);

				$i++;

			}
		}

		if ($student) {
			

			usort( $student, function($a, $b) {
				if( $a['in_percent'] == $b['in_percent'] )
					return 0;
				return ( $a['in_percent'] < $b['in_percent'] ) ? 1 : -1;
			} );

		}

		return $student;
	}

	/**
	* 
	*/

	/*public function filterResultByClass(Request $request) {

			$class = $request->class;
			$month = $request->month;
			$batch = $request->batch;
			$shift = $request->shift;

			if ($month != 'Select Month' && $class != 'Select Class' && $batch != 'Select Batch' && $shift != 'Select Shift') {

				$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
					->select(
						'students.name',
						'students.class',
						'students.batch',
						'students.shift',
						'students.roll',
						'dailyresults.month',
						DB::raw('SUM(one) as one'),
						DB::raw('SUM(two) as two'),
						DB::raw('SUM(three) as three'),
						DB::raw('SUM(four) as four'),
						DB::raw('SUM(five) as five'),
						DB::raw('SUM(six) as six'),
						DB::raw('SUM(seven) as seven'),
						DB::raw('SUM(eight) as eight'),
						DB::raw('SUM(nine) as nine'),
						DB::raw('SUM(ten) as ten'),
						DB::raw('SUM(eleven) as eleven'),
						DB::raw('SUM(twelve) as twelve'),
						DB::raw('SUM(thirteen) as thirteen'),
						DB::raw('SUM(fourteen) as fourteen'),
						DB::raw('SUM(fifteen) as fifteen'),
						DB::raw('SUM(sixteen) as sixteen'),
						DB::raw('SUM(seventeen) as seventeen'),
						DB::raw('SUM(eighteen) as eighteen'),
						DB::raw('SUM(nineteen) as nineteen'),
						DB::raw('SUM(twenty) as twenty'),
						DB::raw('SUM(twentyone) as twentyone'),
						DB::raw('SUM(twentytwo) as twentytwo'),
						DB::raw('SUM(twentythree) as twentythree'),
						DB::raw('SUM(twentyfour) as twentyfour'),
						DB::raw('SUM(twentyfive) as twentyfive'),
						DB::raw('SUM(twentysix) as twentysix'),
						DB::raw('SUM(twentyseven) as twentyseven'),
						DB::raw('SUM(twentyeight) as twentyeight'),
						DB::raw('SUM(twentynine) as twentynine'),
						DB::raw('SUM(thirty) as thirty'),
						DB::raw('SUM(thirtyone) as thirtyone'))
					->groupBy('student_id', 'month')
					->where('dailyresults.month', '=', $month)
					->where('students.class', '=', $class)
					->where('students.batch', '=', $batch)
					->where('students.shift', '=', $shift)
					->paginate(20);

				return json_encode($results);
			}

			if ($month != 'Select Month' && $class != 'Select Class' && $batch != 'Select Batch') {

				$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
					->select(
						'students.name',
						'students.class',
						'students.batch',
						'students.shift',
						'students.roll',
						'dailyresults.month',
						DB::raw('SUM(one) as one'),
						DB::raw('SUM(two) as two'),
						DB::raw('SUM(three) as three'),
						DB::raw('SUM(four) as four'),
						DB::raw('SUM(five) as five'),
						DB::raw('SUM(six) as six'),
						DB::raw('SUM(seven) as seven'),
						DB::raw('SUM(eight) as eight'),
						DB::raw('SUM(nine) as nine'),
						DB::raw('SUM(ten) as ten'),
						DB::raw('SUM(eleven) as eleven'),
						DB::raw('SUM(twelve) as twelve'),
						DB::raw('SUM(thirteen) as thirteen'),
						DB::raw('SUM(fourteen) as fourteen'),
						DB::raw('SUM(fifteen) as fifteen'),
						DB::raw('SUM(sixteen) as sixteen'),
						DB::raw('SUM(seventeen) as seventeen'),
						DB::raw('SUM(eighteen) as eighteen'),
						DB::raw('SUM(nineteen) as nineteen'),
						DB::raw('SUM(twenty) as twenty'),
						DB::raw('SUM(twentyone) as twentyone'),
						DB::raw('SUM(twentytwo) as twentytwo'),
						DB::raw('SUM(twentythree) as twentythree'),
						DB::raw('SUM(twentyfour) as twentyfour'),
						DB::raw('SUM(twentyfive) as twentyfive'),
						DB::raw('SUM(twentysix) as twentysix'),
						DB::raw('SUM(twentyseven) as twentyseven'),
						DB::raw('SUM(twentyeight) as twentyeight'),
						DB::raw('SUM(twentynine) as twentynine'),
						DB::raw('SUM(thirty) as thirty'),
						DB::raw('SUM(thirtyone) as thirtyone'))
					->groupBy('student_id', 'month')
					->where('dailyresults.month', '=', $month)
					->where('students.class', '=', $class)
					->where('students.batch', '=', $batch)
					->paginate(20);

				return json_encode($results);
			}

			if ($month != 'Select Month' && $class != 'Select Class') {

				$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
					->select(
						'students.name',
						'students.class',
						'students.batch',
						'students.shift',
						'students.roll',
						'dailyresults.month',
						DB::raw('SUM(one) as one'),
						DB::raw('SUM(two) as two'),
						DB::raw('SUM(three) as three'),
						DB::raw('SUM(four) as four'),
						DB::raw('SUM(five) as five'),
						DB::raw('SUM(six) as six'),
						DB::raw('SUM(seven) as seven'),
						DB::raw('SUM(eight) as eight'),
						DB::raw('SUM(nine) as nine'),
						DB::raw('SUM(ten) as ten'),
						DB::raw('SUM(eleven) as eleven'),
						DB::raw('SUM(twelve) as twelve'),
						DB::raw('SUM(thirteen) as thirteen'),
						DB::raw('SUM(fourteen) as fourteen'),
						DB::raw('SUM(fifteen) as fifteen'),
						DB::raw('SUM(sixteen) as sixteen'),
						DB::raw('SUM(seventeen) as seventeen'),
						DB::raw('SUM(eighteen) as eighteen'),
						DB::raw('SUM(nineteen) as nineteen'),
						DB::raw('SUM(twenty) as twenty'),
						DB::raw('SUM(twentyone) as twentyone'),
						DB::raw('SUM(twentytwo) as twentytwo'),
						DB::raw('SUM(twentythree) as twentythree'),
						DB::raw('SUM(twentyfour) as twentyfour'),
						DB::raw('SUM(twentyfive) as twentyfive'),
						DB::raw('SUM(twentysix) as twentysix'),
						DB::raw('SUM(twentyseven) as twentyseven'),
						DB::raw('SUM(twentyeight) as twentyeight'),
						DB::raw('SUM(twentynine) as twentynine'),
						DB::raw('SUM(thirty) as thirty'),
						DB::raw('SUM(thirtyone) as thirtyone'))
					->groupBy('student_id', 'month')
					->where('dailyresults.month', '=', $month)
					->where('students.class', '=', $class)
					->paginate(20);

				return json_encode($results);
			}

			if ($month != 'Select Month') {

				$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
					->select(
						'students.name',
						'students.class',
						'students.batch',
						'students.shift',
						'students.roll',
						'dailyresults.month',
						DB::raw('SUM(one) as one'),
						DB::raw('SUM(two) as two'),
						DB::raw('SUM(three) as three'),
						DB::raw('SUM(four) as four'),
						DB::raw('SUM(five) as five'),
						DB::raw('SUM(six) as six'),
						DB::raw('SUM(seven) as seven'),
						DB::raw('SUM(eight) as eight'),
						DB::raw('SUM(nine) as nine'),
						DB::raw('SUM(ten) as ten'),
						DB::raw('SUM(eleven) as eleven'),
						DB::raw('SUM(twelve) as twelve'),
						DB::raw('SUM(thirteen) as thirteen'),
						DB::raw('SUM(fourteen) as fourteen'),
						DB::raw('SUM(fifteen) as fifteen'),
						DB::raw('SUM(sixteen) as sixteen'),
						DB::raw('SUM(seventeen) as seventeen'),
						DB::raw('SUM(eighteen) as eighteen'),
						DB::raw('SUM(nineteen) as nineteen'),
						DB::raw('SUM(twenty) as twenty'),
						DB::raw('SUM(twentyone) as twentyone'),
						DB::raw('SUM(twentytwo) as twentytwo'),
						DB::raw('SUM(twentythree) as twentythree'),
						DB::raw('SUM(twentyfour) as twentyfour'),
						DB::raw('SUM(twentyfive) as twentyfive'),
						DB::raw('SUM(twentysix) as twentysix'),
						DB::raw('SUM(twentyseven) as twentyseven'),
						DB::raw('SUM(twentyeight) as twentyeight'),
						DB::raw('SUM(twentynine) as twentynine'),
						DB::raw('SUM(thirty) as thirty'),
						DB::raw('SUM(thirtyone) as thirtyone'))
					->groupBy('student_id', 'month')
					->where('dailyresults.month', '=', $month)
					->paginate(20);

				return json_encode($results);
			}

		}
	*/

		public function optionForIndivisualResult(Request $request)
		{
			$student_id = $request->student_id;

			$months = Dailyresult::distinct()->lists('month', 'month');

			return view('results/indivisial_result', compact('student_id', 'months'));
		}

/**
 * Fetch individual result for any student and send then to the view.
 * @param
 * @return
 */
public function showIndivisualResult(Request $request) {

	$student_id = $request->id;

	// return $student_id;

	$month = $request->month;

	$student = Student::findOrFail($student_id);

	$indivisual_results = Dailyresult::select(
		'id',
		'subject',
		'student_id',
		'month',
		DB::raw('SUM(one) as one'),
		DB::raw('SUM(two) as two'),
		DB::raw('SUM(three) as three'),
		DB::raw('SUM(four) as four'),
		DB::raw('SUM(five) as five'),
		DB::raw('SUM(six) as six'),
		DB::raw('SUM(seven) as seven'),
		DB::raw('SUM(eight) as eight'),
		DB::raw('SUM(nine) as nine'),
		DB::raw('SUM(ten) as ten'),
		DB::raw('SUM(eleven) as eleven'),
		DB::raw('SUM(twelve) as twelve'),
		DB::raw('SUM(thirteen) as thirteen'),
		DB::raw('SUM(fourteen) as fourteen'),
		DB::raw('SUM(fifteen) as fifteen'),
		DB::raw('SUM(sixteen) as sixteen'),
		DB::raw('SUM(seventeen) as seventeen'),
		DB::raw('SUM(eighteen) as eighteen'),
		DB::raw('SUM(nineteen) as nineteen'),
		DB::raw('SUM(twenty) as twenty'),
		DB::raw('SUM(twentyone) as twentyone'),
		DB::raw('SUM(twentytwo) as twentytwo'),
		DB::raw('SUM(twentythree) as twentythree'),
		DB::raw('SUM(twentyfour) as twentyfour'),
		DB::raw('SUM(twentyfive) as twentyfive'),
		DB::raw('SUM(twentysix) as twentysix'),
		DB::raw('SUM(twentyseven) as twentyseven'),
		DB::raw('SUM(twentyeight) as twentyeight'),
		DB::raw('SUM(twentynine) as twentynine'),
		DB::raw('SUM(thirty) as thirty'),
		DB::raw('SUM(thirtyone) as thirtyone'))
	->groupBy('student_id', 'month', 'subject')
	->wherestudent_id($student_id)
	->where('month', '=', $month)
	->get();

/**
 * This portion is for showing indivisual top part
 */
	$total_indivisual_results = Dailyresult::select(
		'id',
		'student_id',
		'month',
		DB::raw('SUM(one) as one'),
		DB::raw('SUM(two) as two'),
		DB::raw('SUM(three) as three'),
		DB::raw('SUM(four) as four'),
		DB::raw('SUM(five) as five'),
		DB::raw('SUM(six) as six'),
		DB::raw('SUM(seven) as seven'),
		DB::raw('SUM(eight) as eight'),
		DB::raw('SUM(nine) as nine'),
		DB::raw('SUM(ten) as ten'),
		DB::raw('SUM(eleven) as eleven'),
		DB::raw('SUM(twelve) as twelve'),
		DB::raw('SUM(thirteen) as thirteen'),
		DB::raw('SUM(fourteen) as fourteen'),
		DB::raw('SUM(fifteen) as fifteen'),
		DB::raw('SUM(sixteen) as sixteen'),
		DB::raw('SUM(seventeen) as seventeen'),
		DB::raw('SUM(eighteen) as eighteen'),
		DB::raw('SUM(nineteen) as nineteen'),
		DB::raw('SUM(twenty) as twenty'),
		DB::raw('SUM(twentyone) as twentyone'),
		DB::raw('SUM(twentytwo) as twentytwo'),
		DB::raw('SUM(twentythree) as twentythree'),
		DB::raw('SUM(twentyfour) as twentyfour'),
		DB::raw('SUM(twentyfive) as twentyfive'),
		DB::raw('SUM(twentysix) as twentysix'),
		DB::raw('SUM(twentyseven) as twentyseven'),
		DB::raw('SUM(twentyeight) as twentyeight'),
		DB::raw('SUM(twentynine) as twentynine'),
		DB::raw('SUM(thirty) as thirty'),
		DB::raw('SUM(thirtyone) as thirtyone'),
		DB::raw('SUM(subject) as total_sUbject'))
	->groupBy('student_id', 'month')
	->wherestudent_id($student_id)
	->where('month', '=', $month)
	->get();

	// return $total_indivisual_results;

	$subjects = Dailyresult::distinct()->lists('subject');

	$months = Dailyresult::distinct()->lists('month');

	$totalone = 0;
	$totaltwo = 0;
	$totalthree = 0;
	$totalfour = 0;
	$totalfive = 0;
	$totalsix = 0;
	$totalseven = 0;
	$totaleight = 0;
	$totalnine = 0;
	$totalten = 0;
	$totaleleven = 0;
	$totaltwelve = 0;
	$totalthirteen = 0;
	$totalfourteen = 0;
	$totalfifteen = 0;
	$totalsixteen = 0;
	$totalseventeen = 0;
	$totaleighteen = 0;
	$totalnineteen = 0;
	$totaltwenty = 0;
	$totaltwentyone = 0;
	$totaltwentytwo = 0;
	$totaltwentythree = 0;
	$totaltwentyfour = 0;
	$totaltwentyfive = 0;
	$totaltwentysix = 0;
	$totaltwentyseven = 0;
	$totaltwentyeight = 0;
	$totaltwentynine = 0;
	$totalthirty = 0;
	$totalthirtyone = 0;
	$inpercentone = 0;
	$inpercenttwo = 0;
	$inpercentthree = 0;
	$inpercentfour = 0;
	$inpercentfive = 0;
	$inpercentsix = 0;
	$inpercentseven = 0;
	$inpercenteight = 0;
	$inpercentnine = 0;
	$inpercentten = 0;
	$inpercenteleven = 0;
	$inpercenttwelve = 0;
	$inpercentthirteen = 0;
	$inpercentfourteen = 0;
	$inpercentfifteen = 0;
	$inpercentsixteen = 0;
	$inpercentseventeen = 0;
	$inpercenteighteen = 0;
	$inpercentnineteen = 0;
	$inpercenttwenty = 0;
	$inpercenttwentyone = 0;
	$inpercenttwentytwo = 0;
	$inpercenttwentythree = 0;
	$inpercenttwentyfour = 0;
	$inpercenttwentyfive = 0;
	$inpercenttwentysix = 0;
	$inpercenttwentyseven = 0;
	$inpercenttwentyeight = 0;
	$inpercenttwentynine = 0;
	$inpercentthirty = 0;
	$inpercentthirtyone = 0;
	$gradeone = 'N/A';
	$gradetwo = 'N/A';
	$gradethree = 'N/A';
	$gradefour = 'N/A';
	$gradefive = 'N/A';
	$gradesix = 'N/A';
	$gradeseven = 'N/A';
	$gradeeight = 'N/A';
	$gradenine = 'N/A';
	$gradeten = 'N/A';
	$gradeeleven = 'N/A';
	$gradetwelve = 'N/A';
	$gradethirteen = 'N/A';
	$gradefourteen = 'N/A';
	$gradefifteen = 'N/A';
	$gradesixteen = 'N/A';
	$gradeseventeen = 'N/A';
	$gradeeighteen = 'N/A';
	$gradenineteen = 'N/A';
	$gradetwenty = 'N/A';
	$gradetwentyone = 'N/A';
	$gradetwentytwo = 'N/A';
	$gradetwentythree = 'N/A';
	$gradetwentyfour = 'N/A';
	$gradetwentyfive = 'N/A';
	$gradetwentysix = 'N/A';
	$gradetwentyseven = 'N/A';
	$gradetwentyeight = 'N/A';
	$gradetwentynine = 'N/A';
	$gradethirty = 'N/A';
	$gradethirtyone = 'N/A';
	$onecounter = 0;
	$twocounter = 0;
	$threecounter = 0;
	$fourcounter = 0;
	$fivecounter = 0;
	$sixcounter = 0;
	$sevencounter = 0;
	$eightcounter = 0;
	$ninecounter = 0;
	$tencounter = 0;
	$elevencounter = 0;
	$twelvecounter = 0;
	$thirteencounter = 0;
	$fourteencounter = 0;
	$fifteencounter = 0;
	$sixteencounter = 0;
	$seventeencounter = 0;
	$eighteencounter = 0;
	$nineteencounter = 0;
	$twentycounter = 0;
	$twentyonecounter = 0;
	$twentytwocounter = 0;
	$twentythreecounter = 0;
	$twentyfourcounter = 0;
	$twentyfivecounter = 0;
	$twentysixcounter = 0;
	$twentysevencounter = 0;
	$twentyeightcounter = 0;
	$twentyninecounter = 0;
	$thirtycounter = 0;
	$thirtyonecounter = 0;

	foreach ($indivisual_results as $result) {

		if ($result->one > 0) {

			$totalone += $result->one;

			// $onecounter++;

			// $inpercentone = $totalone * 100 / ($onecounter * 4);
			$inpercentone = ($result->one * 100) / ($result->subject * 4);

			// return 	$result->subject;

			$gradeone = $this->calculateGrade($inpercentone);
		}

		if ($result->two > 0) {

			$totaltwo += $result->two;

			// $twocounter++;

			// $inpercenttwo = $totaltwo * 100 / ($twocounter * 4);

			$inpercenttwo = ($result->two * 100) / ($result->subject * 4);

			$gradetwo = $this->calculateGrade($inpercenttwo);

		}

		if ($result->three > 0) {

			$totalthree += $result->three;

			$threecounter++;

			$inpercentthree = $totalthree * 100 / ($threecounter * 4);

			$gradethree = $this->calculateGrade($inpercentthree);
		}

		if ($result->four > 0) {

			$totalfour += $result->four;

			$fourcounter++;

			$inpercentfour = $totalfour * 100 / ($fourcounter * 4);

			$gradefour = $this->calculateGrade($inpercentfour);
		}

		if ($result->five > 0) {

			$totalfive += $result->five;

			$fivecounter++;

			$inpercentfive = $totalfive * 100 / ($fivecounter * 4);

			$gradefive = $this->calculateGrade($inpercentfive);
		}

		if ($result->six > 0) {

			$totalsix += $result->six;

			$sixcounter++;

			$inpercentsix = $totalsix * 100 / ($sixcounter * 4);

			$gradesix = $this->calculateGrade($inpercentsix);
		}

		if ($result->seven > 0) {

			$totalseven += $result->seven;

			$sevencounter++;

			$inpercentseven = $totalseven * 100 / ($sevencounter * 4);

			$gradeseven = $this->calculateGrade($inpercentseven);
		}

		if ($result->eight > 0) {

			$totaleight += $result->eight;

			$eightcounter++;

			$inpercenteight = $totaleight * 100 / ($eightcounter * 4);

			$gradeeight = $this->calculateGrade($inpercenteight);
		}

		if ($result->nine > 0) {

			$totalnine += $result->nine;

			$ninecounter++;

			$inpercentnine = $totalnine * 100 / ($ninecounter * 4);

			$gradenine = $this->calculateGrade($inpercentnine);
		}

		if ($result->ten > 0) {

			$totalten += $result->ten;

			$tencounter++;

			$inpercentten = $totalten * 100 / ($tencounter * 4);

			$gradeten = $this->calculateGrade($inpercentten);
		}

		if ($result->eleven > 0) {

			$totaleleven += $result->eleven;

			$elevencounter++;

			$inpercenteleven = $totaleleven * 100 / ($elevencounter * 4);

			$gradeeleven = $this->calculateGrade($inpercenteleven);
		}

		if ($result->twelve > 0) {

			$totaltwelve += $result->twelve;

			$twelvecounter++;

			$inpercenttwelve = $totaltwelve * 100 / ($twelvecounter * 4);

			$gradetwelve = $this->calculateGrade($inpercenttwelve);
		}

		if ($result->thirteen > 0) {

			$totalthirteen += $result->thirteen;

			$thirteencounter++;

			$inpercentthirteen = $totalthirteen * 100 / ($thirteencounter * 4);

			$gradethirteen = $this->calculateGrade($inpercentthirteen);

		}

		if ($result->fourteen > 0) {

			$totalfourteen += $result->fourteen;

			$fourteencounter++;

			$inpercentfourteen = $totalfourteen * 100 / ($fourteencounter * 4);

			$gradefourteen = $this->calculateGrade($inpercentfourteen);
		}

		if ($result->fifteen > 0) {

			$totalfifteen += $result->fifteen;

			$fifteencounter++;

			$inpercentfifteen = $totalfifteen * 100 / ($fifteencounter * 4);

			$gradefifteen = $this->calculateGrade($inpercentfifteen);
		}

		if ($result->sixteen > 0) {

			$totalsixteen += $result->sixteen;

			$sixteencounter++;

			$inpercentsixteen = $totalsixteen * 100 / ($sixteencounter * 4);

			$gradesixteen = $this->calculateGrade($inpercentsixteen);
		}
		if ($result->seventeen > 0) {

			$totalseventeen += $result->seventeen;

			$seventeencounter++;

			$inpercentseventeen = $totalseventeen * 100 / ($seventeencounter * 4);

			$gradeseventeen = $this->calculateGrade($inpercentseventeen);
		}
		if ($result->eighteen > 0) {

			$totaleighteen += $result->eighteen;

			$eighteencounter++;

			$inpercenteighteen = $totaleighteen * 100 / ($eighteencounter * 4);

			$gradeeighteen = $this->calculateGrade($inpercenteighteen);
		}
		if ($result->nineteen > 0) {

			$totalnineteen += $result->nineteen;

			$nineteencounter++;

			$inpercentnineteen = $totalnineteen * 100 / ($nineteencounter * 4);

			$gradenineteen = $this->calculateGrade($inpercentnineteen);
		}
		if ($result->twenty > 0) {

			$totaltwenty += $result->twenty;

			$twentycounter++;

			$inpercenttwenty = $totaltwenty * 100 / ($twentycounter * 4);

			$gradetwenty = $this->calculateGrade($inpercenttwenty);
		}
		if ($result->twentyone > 0) {

			$totaltwentyone += $result->twentyone;

			$twentyonecounter++;

			$inpercenttwentyone = $totaltwentyone * 100 / ($twentyonecounter * 4);

			$gradetwentyone = $this->calculateGrade($inpercenttwentyone);
		}
		if ($result->twentytwo > 0) {

			$totaltwentytwo += $result->twentytwo;

			$twentytwocounter++;

			$inpercenttwentytwo = $totaltwentytwo * 100 / ($twentytwocounter * 4);

			$gradetwentytwo = $this->calculateGrade($inpercenttwentytwo);
		}
		if ($result->twentythree > 0) {

			$totaltwentythree += $result->twentythree;

			$twentythreecounter++;

			$inpercenttwentythree = $totaltwentythree * 100 / ($twentythreecounter * 4);

			$gradetwentythree = $this->calculateGrade($inpercenttwentythree);
		}
		if ($result->twentyfour > 0) {

			$totaltwentyfour += $result->twentyfour;

			$twentyfourcounter++;

			$inpercenttwentyfour = $totaltwentyfour * 100 / ($twentyfourcounter * 4);

			$gradetwentyfour = $this->calculateGrade($inpercenttwentyfour);
		}
		if ($result->twentyfive > 0) {

			$totaltwentyfive += $result->twentyfive;

			$twentyfivecounter++;

			$inpercenttwentyfive = $totaltwentyfive * 100 / ($twentyfivecounter * 4);

			$gradetwentyfive = $this->calculateGrade($inpercenttwentyfive);
		}
		if ($result->twentysix > 0) {

			$totaltwentysix += $result->twentysix;

			$twentysixcounter++;

			$inpercenttwentysix = $totaltwentysix * 100 / ($twentysixcounter * 4);

			$gradetwentysix = $this->calculateGrade($inpercenttwentysix);
		}
		if ($result->twentyseven > 0) {

			$totaltwentyseven += $result->twentyseven;

			$twentysevencounter++;

			$inpercenttwentyseven = $totaltwentyseven * 100 / ($twentysevencounter * 4);

			$gradetwentyseven = $this->calculateGrade($inpercenttwentyseven);
		}
		if ($result->twentyeight > 0) {

			$totaltwentyeight += $result->twentyeight;

			$twentyeightcounter++;

			$inpercenttwentyeight = $totaltwentyeight * 100 / ($twentyeightcounter * 4);

			$gradetwentyeight = $this->calculateGrade($inpercenttwentyeight);
		}
		if ($result->twentynine > 0) {

			$totaltwentynine += $result->twentynine;

			$twentyninecounter++;

			$inpercenttwentynine = $totaltwentynine * 100 / ($twentyninecounter * 4);

			$gradetwentynine = $this->calculateGrade($inpercenttwentynine);
		}
		if ($result->thirty > 0) {

			$totalthirty += $result->thirty;

			$thirtycounter++;

			$inpercentthirty = $totalthirty * 100 / ($thirtycounter * 4);

			$gradethirty = $this->calculateGrade($inpercentthirty);
		}
		if ($result->thirtyone > 0) {

			$totalthirtyone += $result->thirtyone;

			$thirtyonecounter++;

			$inpercentthirtyone = $totalthirtyone * 100 / ($thirtyonecounter * 4);

			$gradethirtyone = $this->calculateGrade($inpercentthirtyone);
		}

	}

	return view('results/show_indivisula_result', compact('month',
		'indivisual_results',
		'total_indivisual_results',
		'student',
		'subjects',
		'months',
		'totalone',
		'totaltwo',
		'totalthree',
		'totalfour',
		'totalfive',
		'totalsix',
		'totalseven',
		'totaleight',
		'totalnine',
		'totalten',
		'totaleleven',
		'totaltwelve',
		'totalthirteen',
		'totalfourteen',
		'totalfifteen',
		'totalsixteen',
		'totalseventeen',
		'totaleighteen',
		'totalnineteen',
		'totaltwenty',
		'totaltwentyone',
		'totaltwentytwo',
		'totaltwentythree',
		'totaltwentyfour',
		'totaltwentyfive',
		'totaltwentysix',
		'totaltwentyseven',
		'totaltwentyeight',
		'totaltwentynine',
		'totalthirty',
		'totalthirtyone',
		'inpercentone',
		'inpercentone',
		'inpercenttwo',
		'inpercentthree',
		'inpercentfour',
		'inpercentfive',
		'inpercentsix',
		'inpercentseven',
		'inpercenteight',
		'inpercentnine',
		'inpercentten',
		'inpercenteleven',
		'inpercenttwelve',
		'inpercentthirteen',
		'inpercentfourteen',
		'inpercentfifteen',
		'inpercentsixteen',
		'inpercentseventeen',
		'inpercenteighteen',
		'inpercentnineteen',
		'inpercenttwenty',
		'inpercenttwentyone',
		'inpercenttwentytwo',
		'inpercenttwentythree',
		'inpercenttwentyfour',
		'inpercenttwentyfive',
		'inpercenttwentysix',
		'inpercenttwentyseven',
		'inpercenttwentyeight',
		'inpercenttwentynine',
		'inpercentthirty',
		'inpercentthirtyone',
		'gradeone',
		'gradeone',
		'gradetwo',
		'gradethree',
		'gradefour',
		'gradefive',
		'gradesix',
		'gradeseven',
		'gradeeight',
		'gradenine',
		'gradeten',
		'gradeeleven',
		'gradetwelve',
		'gradethirteen',
		'gradefourteen',
		'gradefifteen',
		'gradesixteen',
		'gradeseventeen',
		'gradeeighteen',
		'gradenineteen',
		'gradetwenty',
		'gradetwentyone',
		'gradetwentytwo',
		'gradetwentythree',
		'gradetwentyfour',
		'gradetwentyfive',
		'gradetwentysix',
		'gradetwentyseven',
		'gradetwentyeight',
		'gradetwentynine',
		'gradethirty',
		'gradethirtyone'

		));
}


	/**
	 * Save Edited result.
	 */

	public function saveEditedResult(Request $request) {



		$student_id = $request->id;
		$month = $request->month;
		$subject = $request->subject;
		$date = $request->tarikh;
		$marks = $request->marks;

		$date = $this->setDateinString($date);
		$result = $this->fetchResultToEditOrDelete($student_id, $month, $date, $subject);


		if($marks!=0){

			$result->$date = $marks;

			$result->save();

		}else{

			$result->delete();
		}


		
	}

	/**
	 * Delete result.
	 */

	public function deleteResult(Request $request) {

		$student_id = $request->id;
		$month = $request->month;
		$subject = $request->subject;
		$date = $request->tarikh;

		$date = $this->setDateinString($date);

		$result = $this->fetchResultToEditOrDelete($student_id, $month, $date, $subject);

		$result->delete();
	}

	/**
	 * View for Successive Class perfomance
	 */

	public function successiveClassPerfomance() {

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		return view('results/successive', compact('classes', 'years', 'batches', 'shifts'));
	}

	/**
	 * Fetch Successive Class performance and send then to the view
	 */

	public function successiveClassPerfomanceByClassBatch(Request $request) {

		$year = $request->input('year');
		$class = $request->input('class');
		$batch = $request->input('batch');
		$shift = $request->input('shift');

		$students = Student::select('roll', 'name')
		->where('year', '=', $year)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->get();

		if ($students->first()) {

			$results_january = $this->getResultByMonth('January', $class, $batch, $shift, $year);

			if ($results_january->first()) {

				$january_inpercent = $this->inPercentGrade($results_january, $students);

				$january_grade = $this->grade($january_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$january_inpercent[$student->name] = '-';

					$january_grade[$student->name] = '-';
				}
			}

			$results_february = $this->getResultByMonth('February', $class, $batch, $shift, $year);

			if ($results_february->first()) {

				$february_inpercent = $this->inPercentGrade($results_february, $students);

				$february_grade = $this->grade($february_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$february_inpercent[$student->name] = '-';

					$february_grade[$student->name] = '-';
				}
			}

			$results_march = $this->getResultByMonth('March', $class, $batch, $shift, $year);

			if ($results_march->first()) {

				$march_inpercent = $this->inPercentGrade($results_march, $students);

				$march_grade = $this->grade($march_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$march_inpercent[$student->name] = '-';

					$march_grade[$student->name] = '-';
				}
			}

			$results_april = $this->getResultByMonth('April', $class, $batch, $shift, $year);

			if ($results_april->first()) {

				$april_inpercent = $this->inPercentGrade($results_april, $students);

				$april_grade = $this->grade($april_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$april_inpercent[$student->name] = '-';

					$april_grade[$student->name] = '-';
				}
			}

			$results_may = $this->getResultByMonth('May', $class, $batch, $shift, $year);

			if ($results_may->first()) {

				$may_inpercent = $this->inPercentGrade($results_may, $students);

				$may_grade = $this->grade($may_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$may_inpercent[$student->name] = '-';

					$may_grade[$student->name] = '-';
				}
			}

			$results_june = $this->getResultByMonth('June', $class, $batch, $shift, $year);

			if ($results_june->first()) {

				$june_inpercent = $this->inPercentGrade($results_june, $students);

				$june_grade = $this->grade($june_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$june_inpercent[$student->name] = '-';

					$june_grade[$student->name] = '-';
				}
			}

			$results_july = $this->getResultByMonth('July', $class, $batch, $shift, $year);

			if ($results_july->first()) {

				$july_inpercent = $this->inPercentGrade($results_july, $students);

				$july_grade = $this->grade($july_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$july_inpercent[$student->name] = '-';

					$july_grade[$student->name] = '-';
				}
			}

			$results_august = $this->getResultByMonth('August', $class, $batch, $shift, $year);

			if ($results_august->first()) {

				$august_inpercent = $this->inPercentGrade($results_august, $students);

				$august_grade = $this->grade($august_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$august_inpercent[$student->name] = '-';

					$august_grade[$student->name] = '-';
				}
			}

			$results_september = $this->getResultByMonth('September', $class, $batch, $shift, $year);

			if ($results_september->first()) {

				$september_inpercent = $this->inPercentGrade($results_september, $students);

				$september_grade = $this->grade($september_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$september_inpercent[$student->name] = '-';

					$september_grade[$student->name] = '-';
				}
			}

			$results_october = $this->getResultByMonth('October', $class, $batch, $shift, $year);

			if ($results_october->first()) {

				$october_inpercent = $this->inPercentGrade($results_october, $students);

				$october_grade = $this->grade($october_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$october_inpercent[$student->name] = '-';

					$october_grade[$student->name] = '-';
				}
			}

			$results_november = $this->getResultByMonth('November', $class, $batch, $shift, $year);

			if ($results_november->first()) {

				$november_inpercent = $this->inPercentGrade($results_november, $students);

				$november_grade = $this->grade($november_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$november_inpercent[$student->name] = '-';

					$november_grade[$student->name] = '-';
				}
			}

			$results_december = $this->getResultByMonth('December', $class, $batch, $shift, $year);

			if ($results_december->first()) {

				$december_inpercent = $this->inPercentGrade($results_december, $students);

				$december_grade = $this->grade($december_inpercent, $students);
			} else {

				foreach ($students as $student) {

					$december_inpercent[$student->name] = '-';

					$december_grade[$student->name] = '-';
				}
			}

			$classes = Student::distinct()->lists('class', 'class');

			$batches = Student::distinct()->lists('batch', 'batch');

			return view('results/successive_class_perfomance', compact('students', 'classes', 'year', 'batches', 'class', 'batch', 'shift', 'january_inpercent', 'january_grade', 'february_inpercent', 'february_grade', 'march_inpercent', 'march_grade', 'april_inpercent', 'april_grade', 'may_inpercent', 'may_grade', 'june_inpercent', 'june_grade', 'july_inpercent', 'july_grade', 'august_inpercent', 'august_grade', 'september_inpercent', 'september_grade', 'october_inpercent', 'october_grade', 'november_inpercent', 'november_grade', 'december_inpercent', 'december_grade'));
		} else {
			return view('students/student_not_found');
		}

	}

	/**
	 * View for getting Class performance by Batch and Shift.
	 */

	public function getClassPerfomanceByBatch() {

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		return view('results/class_perfomance', compact('classes', 'years', 'batches', 'shifts'));
	}

	/**
	 *  Fetching Class Performance for CLass and send then to view
	 */

	public function classPerfomanceByClass(Request $request)
	{
		$year = $request->input('year');

		$class = $request->input('class');

		$students = Student::select('roll', 'name')
		->where('year', '=', $year)
		->where('class', '=', $class)
		->get();

		if ($students->first()) {

			$results_january = $this->getResultByMonthForClass('January', $class, $year);

			if ($results_january->first()) {

				$january_inpercent = $this->inPercentGrade($results_january, $students);

				$january_grade_percentage = $this->percentageOfGrade($january_inpercent, $students);
			} else {

				$january_grade_percentage = $this->fillEmptyValue();
			}

			$results_february = $this->getResultByMonthForClass('February', $class, $year);

			if ($results_february->first()) {

				$february_inpercent = $this->inPercentGrade($results_february, $students);

				$february_grade_percentage = $this->percentageOfGrade($february_inpercent, $students);
			} else {

				$february_grade_percentage = $this->fillEmptyValue();
			}

			$results_march = $this->getResultByMonthForClass('March', $class, $year);

			if ($results_march->first()) {

				$march_inpercent = $this->inPercentGrade($results_march, $students);

				$march_grade_percentage = $this->percentageOfGrade($march_inpercent, $students);
			} else {

				$march_grade_percentage = $this->fillEmptyValue();
			}

			$results_april = $this->getResultByMonthForClass('April', $class, $year);

			if ($results_april->first()) {

				$april_inpercent = $this->inPercentGrade($results_april, $students);

				$april_grade_percentage = $this->percentageOfGrade($april_inpercent, $students);
			} else {

				$april_grade_percentage = $this->fillEmptyValue();
			}

			$results_may = $this->getResultByMonthForClass('May', $class, $year);

			if ($results_may->first()) {

				$may_inpercent = $this->inPercentGrade($results_may, $students);

				$may_grade_percentage = $this->percentageOfGrade($may_inpercent, $students);
			} else {

				$may_grade_percentage = $this->fillEmptyValue();
			}

			$results_june = $this->getResultByMonthForClass('June', $class, $year);

			if ($results_june->first()) {

				$june_inpercent = $this->inPercentGrade($results_june, $students);

				$june_grade_percentage = $this->percentageOfGrade($june_inpercent, $students);
			} else {

				$june_grade_percentage = $this->fillEmptyValue();
			}

			$results_july = $this->getResultByMonthForClass('July', $class, $year);

			if ($results_july->first()) {

				$july_inpercent = $this->inPercentGrade($results_july, $students);

				$july_grade_percentage = $this->percentageOfGrade($july_inpercent, $students);
			} else {

				$july_grade_percentage = $this->fillEmptyValue();
			}

			$results_august = $this->getResultByMonthForClass('August', $class, $year);

			if ($results_august->first()) {

				$august_inpercent = $this->inPercentGrade($results_august, $students);

				$august_grade_percentage = $this->percentageOfGrade($august_inpercent, $students);
			} else {

				$august_grade_percentage = $this->fillEmptyValue();

			}

			$results_september = $this->getResultByMonthForClass('September', $class, $year);

			if ($results_september->first()) {

				$september_inpercent = $this->inPercentGrade($results_september, $students);

				$september_grade_percentage = $this->percentageOfGrade($september_inpercent, $students);
			} else {

				$september_grade_percentage = $this->fillEmptyValue();

			}

			$results_october = $this->getResultByMonthForClass('October', $class, $year);

			if ($results_october->first()) {

				$october_inpercent = $this->inPercentGrade($results_october, $students);

				$october_grade_percentage = $this->percentageOfGrade($october_inpercent, $students);
			} else {

				$october_grade_percentage = $this->fillEmptyValue();
			}

			$results_november = $this->getResultByMonthForClass('November', $class, $year);

			if ($results_november->first()) {

				$november_inpercent = $this->inPercentGrade($results_november, $students);

				$november_grade_percentage = $this->percentageOfGrade($november_inpercent, $students);
			} else {

				$november_grade_percentage = $this->fillEmptyValue();
			}

			$results_december = $this->getResultByMonthForClass('December', $class, $year);

			if ($results_december->first()) {

				$december_inpercent = $this->inPercentGrade($results_december, $students);

				$december_grade_percentage = $this->percentageOfGrade($december_inpercent, $students);
			} else {

				$december_grade_percentage = $this->fillEmptyValue();
			}

			$classes = Student::distinct()->lists('class', 'class');

			$batches = Student::distinct()->lists('batch', 'batch');

			return view('results/class_perfomance_by_class',
				compact('year',
					'class',
					'classes',
					'batches',
					'january_grade_percentage',
					'february_grade_percentage',
					'march_grade_percentage',
					'april_grade_percentage',
					'may_grade_percentage',
					'june_grade_percentage',
					'july_grade_percentage',
					'august_grade_percentage',
					'september_grade_percentage',
					'october_grade_percentage',
					'november_grade_percentage',
					'december_grade_percentage'));
		} else {
			return view('students/student_not_found');
		}
	}

	/**
	 * Fetching Class Performance for Batch and send then to view
	 */

	public function classPerfomanceByShift(Request $request) {

		$year = $request->input('year');

		$class = $request->input('class');

		$shift = $request->input('shift');

		$students = Student::select('roll', 'name')
		->where('year', '=', $year)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->get();

		if ($students->first()) {

			$results_january = $this->getResultByMonthForShift('January', $class, $shift, $year);

			if ($results_january->first()) {

				$january_inpercent = $this->inPercentGrade($results_january, $students);

				$january_grade_percentage = $this->percentageOfGrade($january_inpercent, $students);
			} else {

				$january_grade_percentage = $this->fillEmptyValue();
			}

			$results_february = $this->getResultByMonthForShift('February', $class, $shift, $year);

			if ($results_february->first()) {

				$february_inpercent = $this->inPercentGrade($results_february, $students);

				$february_grade_percentage = $this->percentageOfGrade($february_inpercent, $students);
			} else {

				$february_grade_percentage = $this->fillEmptyValue();
			}

			$results_march = $this->getResultByMonthForShift('March', $class, $shift, $year);

			if ($results_march->first()) {

				$march_inpercent = $this->inPercentGrade($results_march, $students);

				$march_grade_percentage = $this->percentageOfGrade($march_inpercent, $students);
			} else {

				$march_grade_percentage = $this->fillEmptyValue();
			}

			$results_april = $this->getResultByMonthForShift('April', $class, $shift, $year);

			if ($results_april->first()) {

				$april_inpercent = $this->inPercentGrade($results_april, $students);

				$april_grade_percentage = $this->percentageOfGrade($april_inpercent, $students);
			} else {

				$april_grade_percentage = $this->fillEmptyValue();
			}

			$results_may = $this->getResultByMonthForShift('May', $class, $shift, $year);

			if ($results_may->first()) {

				$may_inpercent = $this->inPercentGrade($results_may, $students);

				$may_grade_percentage = $this->percentageOfGrade($may_inpercent, $students);
			} else {

				$may_grade_percentage = $this->fillEmptyValue();
			}

			$results_june = $this->getResultByMonthForShift('June', $class, $shift, $year);

			if ($results_june->first()) {

				$june_inpercent = $this->inPercentGrade($results_june, $students);

				$june_grade_percentage = $this->percentageOfGrade($june_inpercent, $students);
			} else {

				$june_grade_percentage = $this->fillEmptyValue();
			}

			$results_july = $this->getResultByMonthForShift('July', $class, $shift, $year);

			if ($results_july->first()) {

				$july_inpercent = $this->inPercentGrade($results_july, $students);

				$july_grade_percentage = $this->percentageOfGrade($july_inpercent, $students);
			} else {

				$july_grade_percentage = $this->fillEmptyValue();
			}

			$results_august = $this->getResultByMonthForShift('August', $class, $shift, $year);

			if ($results_august->first()) {

				$august_inpercent = $this->inPercentGrade($results_august, $students);

				$august_grade_percentage = $this->percentageOfGrade($august_inpercent, $students);
			} else {

				$august_grade_percentage = $this->fillEmptyValue();

			}

			$results_september = $this->getResultByMonthForShift('September', $class, $shift, $year);

			if ($results_september->first()) {

				$september_inpercent = $this->inPercentGrade($results_september, $students);

				$september_grade_percentage = $this->percentageOfGrade($september_inpercent, $students);
			} else {

				$september_grade_percentage = $this->fillEmptyValue();

			}

			$results_october = $this->getResultByMonthForShift('October', $class, $shift, $year);

			if ($results_october->first()) {

				$october_inpercent = $this->inPercentGrade($results_october, $students);

				$october_grade_percentage = $this->percentageOfGrade($october_inpercent, $students);
			} else {

				$october_grade_percentage = $this->fillEmptyValue();
			}

			$results_november = $this->getResultByMonthForShift('November', $class, $shift, $year);

			if ($results_november->first()) {

				$november_inpercent = $this->inPercentGrade($results_november, $students);

				$november_grade_percentage = $this->percentageOfGrade($november_inpercent, $students);
			} else {

				$november_grade_percentage = $this->fillEmptyValue();
			}

			$results_december = $this->getResultByMonthForShift('December', $class, $shift, $year);

			if ($results_december->first()) {

				$december_inpercent = $this->inPercentGrade($results_december, $students);

				$december_grade_percentage = $this->percentageOfGrade($december_inpercent, $students);
			} else {

				$december_grade_percentage = $this->fillEmptyValue();
			}

			$classes = Student::distinct()->lists('class', 'class');

			$batches = Student::distinct()->lists('batch', 'batch');

			return view('results/class_perfomance_by_shift',
				compact('year',
					'class',
					'batch',
					'shift',
					'classes',
					'batches',
					'january_grade_percentage',
					'february_grade_percentage',
					'march_grade_percentage',
					'april_grade_percentage',
					'may_grade_percentage',
					'june_grade_percentage',
					'july_grade_percentage',
					'august_grade_percentage',
					'september_grade_percentage',
					'october_grade_percentage',
					'november_grade_percentage',
					'december_grade_percentage'));
		} else {
			return view('students/student_not_found');
		}

	}

	/**
	 * Fetching Class Performance for Batch and send then to view
	 */

	public function classPerfomanceByBatch(Request $request) {

		$year = $request->input('year');

		$class = $request->input('class');

		$batch = $request->input('batch');

		$shift = $request->input('shift');

		$students = Student::select('roll', 'name')
		->where('year', '=', $year)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->get();

		if ($students->first()) {

			$results_january = $this->getResultByMonth('January', $class, $batch, $shift, $year);

			if ($results_january->first()) {

				$january_inpercent = $this->inPercentGrade($results_january, $students);

				$january_grade_percentage = $this->percentageOfGrade($january_inpercent, $students);
			} else {

				$january_grade_percentage = $this->fillEmptyValue();
			}

			$results_february = $this->getResultByMonth('February', $class, $batch, $shift, $year);

			if ($results_february->first()) {

				$february_inpercent = $this->inPercentGrade($results_february, $students);

				$february_grade_percentage = $this->percentageOfGrade($february_inpercent, $students);
			} else {

				$february_grade_percentage = $this->fillEmptyValue();
			}

			$results_march = $this->getResultByMonth('March', $class, $batch, $shift, $year);

			if ($results_march->first()) {

				$march_inpercent = $this->inPercentGrade($results_march, $students);

				$march_grade_percentage = $this->percentageOfGrade($march_inpercent, $students);
			} else {

				$march_grade_percentage = $this->fillEmptyValue();
			}

			$results_april = $this->getResultByMonth('April', $class, $batch, $shift, $year);

			if ($results_april->first()) {

				$april_inpercent = $this->inPercentGrade($results_april, $students);

				$april_grade_percentage = $this->percentageOfGrade($april_inpercent, $students);
			} else {

				$april_grade_percentage = $this->fillEmptyValue();
			}

			$results_may = $this->getResultByMonth('May', $class, $batch, $shift, $year);

			if ($results_may->first()) {

				$may_inpercent = $this->inPercentGrade($results_may, $students);

				$may_grade_percentage = $this->percentageOfGrade($may_inpercent, $students);
			} else {

				$may_grade_percentage = $this->fillEmptyValue();
			}

			$results_june = $this->getResultByMonth('June', $class, $batch, $shift, $year);

			if ($results_june->first()) {

				$june_inpercent = $this->inPercentGrade($results_june, $students);

				$june_grade_percentage = $this->percentageOfGrade($june_inpercent, $students);
			} else {

				$june_grade_percentage = $this->fillEmptyValue();
			}

			$results_july = $this->getResultByMonth('July', $class, $batch, $shift, $year);

			if ($results_july->first()) {

				$july_inpercent = $this->inPercentGrade($results_july, $students);

				$july_grade_percentage = $this->percentageOfGrade($july_inpercent, $students);
			} else {

				$july_grade_percentage = $this->fillEmptyValue();
			}

			$results_august = $this->getResultByMonth('August', $class, $batch, $shift, $year);

			if ($results_august->first()) {

				$august_inpercent = $this->inPercentGrade($results_august, $students);

				$august_grade_percentage = $this->percentageOfGrade($august_inpercent, $students);
			} else {

				$august_grade_percentage = $this->fillEmptyValue();

			}

			$results_september = $this->getResultByMonth('September', $class, $batch, $shift, $year);

			if ($results_september->first()) {

				$september_inpercent = $this->inPercentGrade($results_september, $students);

				$september_grade_percentage = $this->percentageOfGrade($september_inpercent, $students);
			} else {

				$september_grade_percentage = $this->fillEmptyValue();

			}

			$results_october = $this->getResultByMonth('October', $class, $batch, $shift, $year);

			if ($results_october->first()) {

				$october_inpercent = $this->inPercentGrade($results_october, $students);

				$october_grade_percentage = $this->percentageOfGrade($october_inpercent, $students);
			} else {

				$october_grade_percentage = $this->fillEmptyValue();
			}

			$results_november = $this->getResultByMonth('November', $class, $batch, $shift, $year);

			if ($results_november->first()) {

				$november_inpercent = $this->inPercentGrade($results_november, $students);

				$november_grade_percentage = $this->percentageOfGrade($november_inpercent, $students);
			} else {

				$november_grade_percentage = $this->fillEmptyValue();
			}

			$results_december = $this->getResultByMonth('December', $class, $batch, $shift, $year);

			if ($results_december->first()) {

				$december_inpercent = $this->inPercentGrade($results_december, $students);

				$december_grade_percentage = $this->percentageOfGrade($december_inpercent, $students);
			} else {

				$december_grade_percentage = $this->fillEmptyValue();
			}

			$classes = Student::distinct()->lists('class', 'class');

			$batches = Student::distinct()->lists('batch', 'batch');

			return view('results/class_perfomance_by_batch',
				compact('year',
					'class',
					'batch',
					'shift',
					'classes',
					'batches',
					'january_grade_percentage',
					'february_grade_percentage',
					'march_grade_percentage',
					'april_grade_percentage',
					'may_grade_percentage',
					'june_grade_percentage',
					'july_grade_percentage',
					'august_grade_percentage',
					'september_grade_percentage',
					'october_grade_percentage',
					'november_grade_percentage',
					'december_grade_percentage'));
		} else {
			return view('students/student_not_found');
		}

	}

	/**
	 * View for Compare class performance for two months
	 */

	public function comparePerfomance() {

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		$months = Dailyresult::distinct()->lists('month', 'month');

		return view('results/compare_perfomance', compact('classes', 'years', 'batches', 'shifts', 'months'));
	}

	/**
	 * 	Fetching class Perfomance for two Months and send then to View
	 */

	public function comparePerfomanceByMonth(Request $request) {

		$year = $request->input('year');

		$class = $request->input('class');

		$batch = $request->input('batch');

		$shift = $request->input('shift');

		$month1 = $request->input('month1');

		$month2 = $request->input('month2');

		$students = Student::select('roll', 'name')
		->where('year', '=', $year)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->get();

		if ($students->first()) {

			$results_month1 = $this->getResultByMonth($month1, $class, $batch, $shift, $year);

			if ($results_month1->first()) {

				$month1_inpercent = $this->inPercentGrade($results_month1, $students);

				$month1_grade_percentage = $this->percentageOfGrade($month1_inpercent, $students);
			} else {

				$month1_grade_percentage = $this->fillEmptyValue();
			}

			$results_month2 = $this->getResultByMonth($month2, $class, $batch, $shift, $year);

			if ($results_month2->first()) {

				$month2_inpercent = $this->inPercentGrade($results_month2, $students);

				$month2_grade_percentage = $this->percentageOfGrade($month2_inpercent, $students);
			} else {

				$month2_grade_percentage = $this->fillEmptyValue();
			}

			return view('results/show_compared_perfomance', compact('year', 'class', 'batch', 'shift', 'month1', 'month2', 'month1_grade_percentage', 'month2_grade_percentage'));
		}else{

			return 'Student not found';
		}

		

	}

	/**
	 * If no result is entered for an specific month then the month is filled by empty dashes.
	 */

	public function fillEmptyValue() {

		$grade_percentage['A++'] = '-';
		$grade_percentage['A+'] = '-';
		$grade_percentage['A-'] = '-';
		$grade_percentage['A'] = '-';
		$grade_percentage['B'] = '-';
		$grade_percentage['C'] = '-';


		return $grade_percentage;

	}

	/**
	 * Calculating Percentage for different of grades in a month.(How many A++ or A or any grades calculated in percent.)
	 */

	public function percentageOfGrade($percent, $students) {

		$all_grades = $this->grade($percent, $students);
		$ADoublePlus = 0;
		$APlus = 0;
		$AMinus = 0;
		$A = 0;
		$B = 0;
		$C = 0;


		foreach ($all_grades as $grade) {

			if ($grade == 'A++') {
				$ADoublePlus++;
			}

			if ($grade == 'A+') {
				$APlus++;
			}

			if ($grade == 'A-') {
				$AMinus++;
			}

			if ($grade == 'A') {
				$A++;
			}

			if ($grade == 'B') {
				$B++;
			}

			if ($grade == 'C') {
				$C++;
			}

		}

		$percentage_of_different_grade['A++'] = 100 * $ADoublePlus / count($students);
		$percentage_of_different_grade['A+'] = 100 * $APlus / count($students);
		$percentage_of_different_grade['A-'] = 100 * $AMinus / count($students);
		$percentage_of_different_grade['A'] = 100 * $A / count($students);
		$percentage_of_different_grade['B'] = 100 * $B / count($students);
		$percentage_of_different_grade['C'] = 100 * $C / count($students);

		return $percentage_of_different_grade;
	}

	/**
	 * Get Result for a Specific Month, Class, Shift, Batch and Year
	 */

	public function getResultByMonth($month, $class, $batch, $shift, $year) {
		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('SUM(subject) as total_subject'))

			// DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			// DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			// DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			// DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			// DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			// DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			// DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			// DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			// DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			// DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			// DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			// DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			// DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			// DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			// DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			// DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			// DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			// DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			// DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			// DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			// DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			// DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			// DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			// DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			// DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			// DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			// DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			// DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			// DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			// DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			// DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('dailyresults.month', '=', $month)
		->where('year', '=', $year)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->where('batch', '=', $batch)
		->orderBy('roll', 'desc')
		->get();

		return $results;
	}

	/**
	 * Get Result for a Specific Month, Class, Shift and Year
	 */

	public function getResultByMonthForShift($month, $class, $shift, $year) {
		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('SUM(subject) as total_subject'))
			// DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			// DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			// DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			// DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			// DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			// DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			// DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			// DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			// DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			// DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			// DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			// DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			// DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			// DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			// DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			// DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			// DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			// DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			// DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			// DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			// DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			// DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			// DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			// DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			// DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			// DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			// DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			// DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			// DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			// DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			// DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('dailyresults.month', '=', $month)
		->where('year', '=', $year)
		->where('class', '=', $class)
		->where('shift', '=', $shift)
		->orderBy('roll', 'desc')
		->get();

		return $results;
	}

	/**
	 * Get Result for a Specific Month, Class and Year
	 */

	public function getResultByMonthForClass($month, $class, $year) {
		$results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.month',
			DB::raw('SUM(one) as one'),
			DB::raw('SUM(two) as two'),
			DB::raw('SUM(three) as three'),
			DB::raw('SUM(four) as four'),
			DB::raw('SUM(five) as five'),
			DB::raw('SUM(six) as six'),
			DB::raw('SUM(seven) as seven'),
			DB::raw('SUM(eight) as eight'),
			DB::raw('SUM(nine) as nine'),
			DB::raw('SUM(ten) as ten'),
			DB::raw('SUM(eleven) as eleven'),
			DB::raw('SUM(twelve) as twelve'),
			DB::raw('SUM(thirteen) as thirteen'),
			DB::raw('SUM(fourteen) as fourteen'),
			DB::raw('SUM(fifteen) as fifteen'),
			DB::raw('SUM(sixteen) as sixteen'),
			DB::raw('SUM(seventeen) as seventeen'),
			DB::raw('SUM(eighteen) as eighteen'),
			DB::raw('SUM(nineteen) as nineteen'),
			DB::raw('SUM(twenty) as twenty'),
			DB::raw('SUM(twentyone) as twentyone'),
			DB::raw('SUM(twentytwo) as twentytwo'),
			DB::raw('SUM(twentythree) as twentythree'),
			DB::raw('SUM(twentyfour) as twentyfour'),
			DB::raw('SUM(twentyfive) as twentyfive'),
			DB::raw('SUM(twentysix) as twentysix'),
			DB::raw('SUM(twentyseven) as twentyseven'),
			DB::raw('SUM(twentyeight) as twentyeight'),
			DB::raw('SUM(twentynine) as twentynine'),
			DB::raw('SUM(thirty) as thirty'),
			DB::raw('SUM(thirtyone) as thirtyone'),
			DB::raw('SUM(subject) as total_subject'))
			// DB::raw('COUNT(NULLIF(one,0)) as subject_one'),
			// DB::raw('COUNT(NULLIF(two,0)) as subject_two'),
			// DB::raw('COUNT(NULLIF(three,0)) as subject_three'),
			// DB::raw('COUNT(NULLIF(four,0)) as subject_four'),
			// DB::raw('COUNT(NULLIF(five,0)) as subject_five'),
			// DB::raw('COUNT(NULLIF(six,0)) as subject_six'),
			// DB::raw('COUNT(NULLIF(seven,0)) as subject_seven'),
			// DB::raw('COUNT(NULLIF(eight,0)) as subject_eight'),
			// DB::raw('COUNT(NULLIF(nine,0)) as subject_nine'),
			// DB::raw('COUNT(NULLIF(ten,0)) as subject_ten'),
			// DB::raw('COUNT(NULLIF(eleven,0)) as subject_eleven'),
			// DB::raw('COUNT(NULLIF(twelve,0)) as subject_twelve'),
			// DB::raw('COUNT(NULLIF(thirteen,0)) as subject_thirteen'),
			// DB::raw('COUNT(NULLIF(fourteen,0)) as subject_fourteen'),
			// DB::raw('COUNT(NULLIF(fifteen,0)) as subject_fifteen'),
			// DB::raw('COUNT(NULLIF(sixteen,0)) as subject_sixteen'),
			// DB::raw('COUNT(NULLIF(seventeen,0)) as subject_seventeen'),
			// DB::raw('COUNT(NULLIF(eighteen,0)) as subject_eighteen'),
			// DB::raw('COUNT(NULLIF(nineteen,0)) as subject_nineteen'),
			// DB::raw('COUNT(NULLIF(twenty,0)) as subject_twenty'),
			// DB::raw('COUNT(NULLIF(twentyone,0)) as subject_twentyone'),
			// DB::raw('COUNT(NULLIF(twentytwo,0)) as subject_twentytwo'),
			// DB::raw('COUNT(NULLIF(twentythree,0)) as subject_twentythree'),
			// DB::raw('COUNT(NULLIF(twentyfour,0)) as subject_twentyfour'),
			// DB::raw('COUNT(NULLIF(twentyfive,0)) as subject_twentyfive'),
			// DB::raw('COUNT(NULLIF(twentysix,0)) as subject_twentysix'),
			// DB::raw('COUNT(NULLIF(twentyseven,0)) as subject_twentyseven'),
			// DB::raw('COUNT(NULLIF(twentyeight,0)) as subject_twentyeight'),
			// DB::raw('COUNT(NULLIF(twentynine,0)) as subject_twentynine'),
			// DB::raw('COUNT(NULLIF(thirty,0)) as subject_thirty'),
			// DB::raw('COUNT(NULLIF(thirtyone,0)) as subject_thirtyone'))
		->groupBy('student_id', 'month')
		->where('dailyresults.month', '=', $month)
		->where('year', '=', $year)
		->where('class', '=', $class)
		->orderBy('roll', 'desc')
		->get();

		return $results;
	}

	/**
	 * Fill Student grade array
	 */

	public function grade($inPercents, $students) {

		foreach ($students as $student) {

			$grade[$student->name] = '-';

			if ($inPercents[$student->name] != '-') {

				$grade[$student->name] = $this->calculateGrade($inPercents[$student->name]);
			}
		}

		return $grade;
	}

	/**
	 * Calculate In Percent.
	 */

	public function inPercentGrade($results, $rolls) {

		foreach ($rolls as $roll) {

			$student_in_percent[$roll->name] = '-';

		}

		foreach ($results as $result) {

			$total_marks = 0;

			$total_marks = $result->one +
			$result->two +
			$result->three +
			$result->four +
			$result->five +
			$result->six +
			$result->seven +
			$result->eight +
			$result->nine +
			$result->ten +
			$result->eleven +
			$result->twelve +
			$result->thirteen +
			$result->fourteen +
			$result->fifteen +
			$result->sixteen +
			$result->seventeen +
			$result->eighteen +
			$result->nineteen +
			$result->twenty +
			$result->twentyone +
			$result->twentytwo +
			$result->twentythree +
			$result->twentyfour +
			$result->twentyfive +
			$result->twentysix +
			$result->twentyseven +
			$result->twentyeight +
			$result->twentynine +
			$result->thirty +
			$result->thirtyone;

			// $total_subjects = $result->subject_one +
			// $result->subject_two +
			// $result->subject_three +
			// $result->subject_four +
			// $result->subject_five +
			// $result->subject_six +
			// $result->subject_seven +
			// $result->subject_eight +
			// $result->subject_nine +
			// $result->subject_ten +
			// $result->subject_eleven +
			// $result->subject_twelve +
			// $result->subject_thirteen +
			// $result->subject_fourteen +
			// $result->subject_fifteen +
			// $result->subject_sixteen +
			// $result->subject_seventeen +
			// $result->subject_eighteen +
			// $result->subject_nineteen +
			// $result->subject_twenty +
			// $result->subject_twentyone +
			// $result->subject_twentytwo +
			// $result->subject_twentythree +
			// $result->subject_twentyfour +
			// $result->subject_twentyfive +
			// $result->subject_twentysix +
			// $result->subject_twentyseven +
			// $result->subject_twentyeight +
			// $result->subject_twentynine +
			// $result->subject_thirty +
			// $result->subject_thirtyone;

			$gross_marks = $result->total_subject * 4;

			$in_percent = ($total_marks * 100) / $gross_marks;

			$grade = $this->calculateGrade($in_percent);

			$student_in_percent[$result->name] = $in_percent;

			// $i++;

		}

		return $student_in_percent;
	}

	/**
	 * Grade Calculation
	 */

	public function calculateGrade($in_percent) {

		if ($in_percent>=91 && $in_percent<=100) {

			$grade = 'A++';
			
		}elseif ($in_percent>=81 && $in_percent<91) {
			$grade = 'A+';
			
		}elseif ($in_percent>=71 && $in_percent<81) {
			$grade = 'A';
			
		}elseif ($in_percent>=61 && $in_percent<71) {
			$grade = 'A-';
			
		}elseif ($in_percent>=51 && $in_percent<61) {
			$grade = 'B';
			
		}elseif ($in_percent>=0 && $in_percent<51) {
			$grade = 'C';

		}else{
			$grade = 'w/g';
		}


		/*$gradecalc = $in_percent / 10;

		settype($gradecalc, "integer");

		switch ($gradecalc) {

			case 10:
			$grade = 'A++';
			break;

			case 9:
			$grade = 'A++';
			break;

			case 8:
			$grade = 'A+';
			break;

			case 7:
			$grade = 'A';
			break;

			case 6:
			$grade = 'A-';
			break;

			case 5:
			$grade = 'B';
			break;

			case 4:
			$grade = 'C';
			break;

			case 3:
			$grade = 'C';
			break;

			case 2:
			$grade = 'C';
			break;

			case 1:
			$grade = 'C';
			break;

			default:
			$grade = 'w/g';
			break;


		}
*/
		return $grade;

	}

	public function fetchResultToEditOrDelete($student_id, $month, $date, $subject)
	{

		$result = Student::join('dailyresults', 'students.id' , '=', 'dailyresults.student_id')
		->where('student_id', '=', $student_id)
		->where('month', '=', $month)
		// ->where('subject', '=', $subject)
		->where($date, '!=', 0)->first();

		// if($result->first()){

		$result = Dailyresult::findOrFail($result->id);
	// }

		return $result;
	}

	/**
	 * Here we take the numeric date and return the string value
	 * like 1 return as one
	 */

	public function setDateinString($date)
	{
		switch ($date) {

			case 31:
			$date = 'thirtyone';
			break;

			case 30:
			$date = 'thirty';
			break;

			case 29:
			$date = 'twentynine';
			break;

			case 28:
			$date = 'twentyeight';
			break;

			case 27:
			$date = 'twentyseven';
			break;

			case 26:
			$date = 'twentysix';
			break;

			case 25:
			$date = 'twentyfive';
			break;

			case 24:
			$date = 'twentyfour';
			break;

			case 23:
			$date = 'twentythree';
			break;

			case 22:
			$date = 'twentytwo';
			break;

			case 21:
			$date = 'twentyone';
			break;

			case 20:
			$date = 'twenty';
			break;

			case 19:
			$date = 'nineteen';
			break;

			case 18:
			$date = 'eighteen';
			break;

			case 17:
			$date = 'seventeen';
			break;

			case 16:
			$date = 'sixteen';
			break;

			case 15:
			$date = 'fifteen';
			break;

			case 14:
			$date = 'fourteen';
			break;

			case 13:
			$date = 'thirteen';
			break;

			case 12:
			$date = 'twelve';
			break;

			case 11:
			$date = 'eleven';
			break;

			case 10:
			$date = 'ten';
			break;

			case 9:
			$date = 'nine';
			break;

			case 8:
			$date = 'eight';
			break;

			case 7:
			$date = 'seven';
			break;

			case 6:
			$date = 'six';
			break;

			case 5:
			$date = 'five';
			break;

			case 4:
			$date = 'four';
			break;

			case 3:
			$date = 'three';
			break;

			case 2:
			$date = 'two';
			break;

			case 1:
			$date = 'one';
			break;
		}

		return $date;
	}

}
