<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Classe;
use App\Http\Controllers\Controller;
use App\Shift;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use App\Dailyresult;
use DB;

class StudentsController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Add Student View
	 */

	public function addStudent() {

		$classes = Classe::distinct()->lists('name', 'name');

		$batches = Batch::distinct()->lists('name', 'name');

		$shifts = Shift::distinct()->lists('name', 'name');

		return view('students/add-student', compact('classes', 'batches', 'shifts'));

	}

	/**
	 * Fetch student and Show then in a list
	 */

	public function studentList() {

		$students = Student::take(20)->orderBy('roll', 'ASC')->get();

		$years = Student::distinct()->lists('year', 'year');

		$classes = Student::distinct()->lists('class', 'class');

		$batches = Student::distinct()->lists('batch', 'batch');

		$shifts = Student::distinct()->lists('shift', 'shift');

		$months = Dailyresult::distinct()->lists('month', 'month');

		$subjects = Subject::distinct()->lists('name', 'name');

		// return $students;

		return view('students/student-list', compact('students', 'years', 'classes', 'batches', 'shifts', 'subjects', 'months'));

	}

	/**
	 * Filter Student By Year
	 */

	public function filterStudentByYear(Request $request) {

		$year = $request->year;

		$students = Student::take(20)->where('year', '=', $year)->orderBy('roll', 'ASC')->get();

		return json_encode($students);
	}

	/**
	 * Fetch Student for specific selection and send then to the view
	 */

	public function filterStudent(Request $request) {

		$class = $request->class;

		$batch = $request->batch;

		$shift = $request->shift;

		$year = $request->year;

		if ($shift != 'Select Shift') {

			if ($class == 'Select Class' && $batch == 'Select Batch') {

				$students = Student::where('year', '=', $year)->wherewhereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($class == 'Select Class' && $batch != 'Select Batch') {

				$students = Student::where('year', '=', $year)->wherebatch($batch)->whereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($batch == 'Select Batch' && $class != 'Select Class') {

				$students = Student::where('year', '=', $year)->whereclass($class)->whereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($batch != 'Select Batch' && $class != 'Select Class') {

				$students = Student::where('year', '=', $year)->whereclass($class)->wherebatch($batch)->whereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}
		}

		if ($class != 'Select Class') {

			if ($batch == 'Select Batch' && $shift == 'Select Shift') {

				$students = Student::take(20)->where('year', '=', $year)->whereclass($class)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($batch == 'Select Batch' && $shift != 'Select Shift') {

				$students = Student::where('year', '=', $year)->whereclass($class)->whereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($batch != 'Select Batch' && $shift == 'Select Shift') {

				$students = Student::where('year', '=', $year)->whereclass($class)->wherebatch($batch)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($batch != 'Select Batch' && $shift != 'Select Shift') {

				$students = Student::where('year', '=', $year)->whereclass($class)->wherebatch($batch)->whereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}
		}

		if ($batch != 'Select batch') {

			if ($class == 'Select Class' && $shift == 'Select Shift') {

				$students = Student::where('year', '=', $year)->wherebatch($batch)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($class == 'Select Class' && $shift != 'Select Shift') {

				$students = Student::where('year', '=', $year)->wherebatch($batch)->whereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($class != 'Select Class' && $shift == 'Select Shift') {

				$students = Student::where('year', '=', $year)->whereclass($class)->wherebatch($batch)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}

			if ($class != 'Select Class' && $shift != 'Select Shift') {

				$students = Student::where('year', '=', $year)->whereclass($class)->wherebatch($batch)->whereshift($shift)->orderBy('roll', 'ASC')->get();

				return json_encode($students);
			}
		}

	}

	/**
	 * Saves Students
	 */

	public function saveStudent(Request $request) {

		$student = new Student;

		$student->name = $request->name;

		$student->class = $request->class;

		$student->roll = $request->roll;

		$student->batch = $request->batch;

		$student->shift = $request->shift;

		$student->mobile = $request->mobile;

		$student->year = $request->year;

		$student->save();

	}

	/**
	 * Delete Student
	 */

	public function deleteStudent(Request $request) {

		$id = $request->id;

		$student = Student::findOrFail($id);

		$student->delete();
	}

	/**
	 * Edit Student view
	 */

	public function editStudent(Request $request) {

		$id = $request->id;

		$student = Student::findOrFail($id);

		return json_encode($student);
	}

	/**
	 * Save Edited Student
	 */

	public function saveEditStudent(Request $request) {

		$id = $request->id;

		$student = Student::findOrFail($id);

		$student->name = $request->name;

		$student->class = $request->class;

		$student->roll = $request->roll;

		$student->batch = $request->batch;

		$student->shift = $request->shift;

		$student->mobile = $request->mobile;

		$student->year = $request->year;

		$student->save();

	}

	/**
	 * View for Adding Subject, Class, Shift, Batch
	 */

	public function addDetails() {

		return view('students/add_details');
	}

	/**
	 * Saves Subject
	 */

	public function saveSubject(Request $request) {

		$subject = new Subject;

		$subject->name = $request->name;

		$subject->save();
	}

	/**
	 * Saves Class
	 */

	public function saveClass(Request $request) {

		$class = new Classe;

		$class->name = $request->name;

		$class->save();
	}

	/**
	 * Saves Shift
	 */

	public function saveShift(Request $request) {

		$shift = new Shift;

		$shift->name = $request->name;

		$shift->save();

	}

	/**
	 * Saves Batch
	 */

	public function saveBatch(Request $request) {

		$batch = new Batch;

		$batch->name = $request->name;

		$batch->save();
	}

}
