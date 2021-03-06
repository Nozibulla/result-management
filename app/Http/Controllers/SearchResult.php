<?php
namespace App\Http\Controllers;
use App\Dailyresult;
use App\Http\Controllers\Controller;
use App\Student;
use DB;
use Illuminate\Http\Request;
class SearchResult extends Controller {
	/**
	 * View for search result from frontend.
	 * @return
	 */
	public function searchResult() {
		$months = Dailyresult::distinct()->lists('month', 'month');
		$years = Student::distinct()->lists('year', 'year');
		$classes = Student::distinct()->lists('class', 'class');
		$batches = Student::distinct()->lists('batch', 'batch');
		$shifts = Student::distinct()->lists('shift', 'shift');
		return view('results/search_result', compact('months', 'classes', 'batches', 'shifts', 'years'));
	}
	/**
	 * Fetch Search Result and Show then in a page to print
	 */
	public function fetchsearchResult(Request $request) {
		$roll = $request->input('roll');
		$class = $request->input('class');
		$batch = $request->input('batch');
		$shift = $request->input('shift');
		$month = $request->input('month');
		$year = $request->input('year');
		// return compact('month', 'class', 'batch', 'shift', 'roll');
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
		->where('month', '=', $month)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->where('roll', '=', $roll)
		->where('year', '=', $year)
		->get();
		if ($results->first()) {
			$total_marks = $this->calculateTotalMarks($results);
			$in_percent = $this->calculateInPercent($total_marks, $results);
			$grade = $this->calculateGrade($in_percent);
			return view('results/show_fetch_results', compact('results', 'total_marks', 'in_percent', 'grade'));
		} else {
			return view('errors/result_not_found');
		}
	}
	public function showIndivisualResult(Request $request) {
		$roll = $request->input('roll');
		$class = $request->input('class');
		$batch = $request->input('batch');
		$shift = $request->input('shift');
		$month = $request->input('month');
		$year = $request->input('year');
		// return compact('month', 'class', 'batch', 'shift', 'roll');
		$total_indivisual_results = Dailyresult::join('students', 'dailyresults.student_id', '=', 'students.id')
		->select(
			'students.name',
			'students.class',
			'students.batch',
			'students.shift',
			'students.roll',
			'students.year',
			'dailyresults.subject',
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
		->where('roll', '=', $roll)
		->where('class', '=', $class)
		->where('batch', '=', $batch)
		->where('shift', '=', $shift)
		->get();
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

		foreach ($total_indivisual_results as $result) {
			if ($result->one > 0) {
				$totalone += $result->one;
				$inpercentone = ($result->one * 100) / ($result->subject * 4);
				$gradeone = $this->calculateGrade($inpercentone);
			}
			if ($result->two > 0) {
				$totaltwo += $result->two;
				$inpercenttwo = ($result->two * 100) / ($result->subject * 4);
				$gradetwo = $this->calculateGrade($inpercenttwo);
			}
			if ($result->three > 0) {
				$totalthree += $result->three;
				$inpercentthree = $totalthree * 100 / ($result->subject * 4);
				$gradethree = $this->calculateGrade($inpercentthree);
			}
			if ($result->four > 0) {
				$totalfour += $result->four;
				$fourcounter++;
				$inpercentfour = $totalfour * 100 / ($result->subject * 4);
				$gradefour = $this->calculateGrade($inpercentfour);
			}
			if ($result->five > 0) {
				$totalfive += $result->five;
				$inpercentfive = $totalfive * 100 / ($result->subject * 4);
				$gradefive = $this->calculateGrade($inpercentfive);
			}
			if ($result->six > 0) {
				$totalsix += $result->six;
				$inpercentsix = $totalsix * 100 / ($result->subject * 4);
				$gradesix = $this->calculateGrade($inpercentsix);
			}
			if ($result->seven > 0) {
				$totalseven += $result->seven;
				$inpercentseven = $totalseven * 100 / ($result->subject * 4);
				$gradeseven = $this->calculateGrade($inpercentseven);
			}
			if ($result->eight > 0) {
				$totaleight += $result->eight;
				$inpercenteight = $totaleight * 100 / ($result->subject * 4);
				$gradeeight = $this->calculateGrade($inpercenteight);
			}
			if ($result->nine > 0) {
				$totalnine += $result->nine;
				$inpercentnine = $totalnine * 100 / ($result->subject * 4);
				$gradenine = $this->calculateGrade($inpercentnine);
			}
			if ($result->ten > 0) {
				$totalten += $result->ten;
				$inpercentten = $totalten * 100 / ($result->subject * 4);
				$gradeten = $this->calculateGrade($inpercentten);
			}
			if ($result->eleven > 0) {
				$totaleleven += $result->eleven;
				$inpercenteleven = $totaleleven * 100 / ($result->subject * 4);
				$gradeeleven = $this->calculateGrade($inpercenteleven);
			}
			if ($result->twelve > 0) {
				$totaltwelve += $result->twelve;
				$inpercenttwelve = $totaltwelve * 100 / ($result->subject * 4);
				$gradetwelve = $this->calculateGrade($inpercenttwelve);
			}
			if ($result->thirteen > 0) {
				$totalthirteen += $result->thirteen;
				$inpercentthirteen = $totalthirteen * 100 / ($result->subject * 4);
				$gradethirteen = $this->calculateGrade($inpercentthirteen);
			}
			if ($result->fourteen > 0) {
				$totalfourteen += $result->fourteen;
				$inpercentfourteen = $totalfourteen * 100 / ($result->subject * 4);
				$gradefourteen = $this->calculateGrade($inpercentfourteen);
			}
			if ($result->fifteen > 0) {
				$totalfifteen += $result->fifteen;
				$inpercentfifteen = $totalfifteen * 100 / ($result->subject * 4);
				$gradefifteen = $this->calculateGrade($inpercentfifteen);
			}
			if ($result->sixteen > 0) {
				$totalsixteen += $result->sixteen;
				$inpercentsixteen = $totalsixteen * 100 / ($result->subject * 4);
				$gradesixteen = $this->calculateGrade($inpercentsixteen);
			}
			if ($result->seventeen > 0) {
				$totalseventeen += $result->seventeen;
				$inpercentseventeen = $totalseventeen * 100 / ($result->subject * 4);
				$gradeseventeen = $this->calculateGrade($inpercentseventeen);
			}
			if ($result->eighteen > 0) {
				$totaleighteen += $result->eighteen;
				$inpercenteighteen = $totaleighteen * 100 / ($result->subject * 4);
				$gradeeighteen = $this->calculateGrade($inpercenteighteen);
			}
			if ($result->nineteen > 0) {
				$totalnineteen += $result->nineteen;
				$inpercentnineteen = $totalnineteen * 100 / ($result->subject * 4);
				$gradenineteen = $this->calculateGrade($inpercentnineteen);
			}
			if ($result->twenty > 0) {
				$totaltwenty += $result->twenty;
				$inpercenttwenty = $totaltwenty * 100 / ($result->subject * 4);
				$gradetwenty = $this->calculateGrade($inpercenttwenty);
			}
			if ($result->twentyone > 0) {
				$totaltwentyone += $result->twentyone;
				$inpercenttwentyone = $totaltwentyone * 100 / ($result->subject * 4);
				$gradetwentyone = $this->calculateGrade($inpercenttwentyone);
			}
			if ($result->twentytwo > 0) {
				$totaltwentytwo += $result->twentytwo;
				$inpercenttwentytwo = $totaltwentytwo * 100 / ($result->subject * 4);
				$gradetwentytwo = $this->calculateGrade($inpercenttwentytwo);
			}
			if ($result->twentythree > 0) {
				$totaltwentythree += $result->twentythree;
				$inpercenttwentythree = $totaltwentythree * 100 / ($result->subject * 4);
				$gradetwentythree = $this->calculateGrade($inpercenttwentythree);
			}
			if ($result->twentyfour > 0) {
				$totaltwentyfour += $result->twentyfour;
				$inpercenttwentyfour = $totaltwentyfour * 100 / ($result->subject * 4);
				$gradetwentyfour = $this->calculateGrade($inpercenttwentyfour);
			}
			if ($result->twentyfive > 0) {
				$totaltwentyfive += $result->twentyfive;
				$inpercenttwentyfive = $totaltwentyfive * 100 / ($result->subject * 4);
				$gradetwentyfive = $this->calculateGrade($inpercenttwentyfive);
			}
			if ($result->twentysix > 0) {
				$totaltwentysix += $result->twentysix;
				$inpercenttwentysix = $totaltwentysix * 100 / ($result->subject * 4);
				$gradetwentysix = $this->calculateGrade($inpercenttwentysix);
			}
			if ($result->twentyseven > 0) {
				$totaltwentyseven += $result->twentyseven;
				$inpercenttwentyseven = $totaltwentyseven * 100 / ($result->subject * 4);
				$gradetwentyseven = $this->calculateGrade($inpercenttwentyseven);
			}
			if ($result->twentyeight > 0) {
				$totaltwentyeight += $result->twentyeight;
				$inpercenttwentyeight = $totaltwentyeight * 100 / ($result->subject * 4);
				$gradetwentyeight = $this->calculateGrade($inpercenttwentyeight);
			}
			if ($result->twentynine > 0) {
				$totaltwentynine += $result->twentynine;
				$inpercenttwentynine = $totaltwentynine * 100 / ($result->subject * 4);
				$gradetwentynine = $this->calculateGrade($inpercenttwentynine);
			}
			if ($result->thirty > 0) {
				$totalthirty += $result->thirty;
				$inpercentthirty = $totalthirty * 100 / ($result->subject * 4);
				$gradethirty = $this->calculateGrade($inpercentthirty);
			}
			if ($result->thirtyone > 0) {
				$totalthirtyone += $result->thirtyone;
				$inpercentthirtyone = $totalthirtyone * 100 / ($result->subject * 4);
				$gradethirtyone = $this->calculateGrade($inpercentthirtyone);
			}
		}
		return view('results/result_per_day', compact(
			'total_indivisual_results',
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
	 * Calculation of Total Marks
	 */
	public function calculateTotalMarks($results) {
		$total_marks = 0;
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
		}
		return $total_marks;
	}
	public function calculateInPercent($total_marks, $results) {
		foreach ($results as $result) {
			$gross_marks = $result->total_subject * 4;
			$in_percent = ($total_marks * 100) / $gross_marks;
			return $in_percent;
		}
	}
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
		return $grade;
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
		return $grade;
	}*/
}
