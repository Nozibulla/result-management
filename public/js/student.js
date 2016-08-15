(function($){

	var subject, month, date;

	$('#alert').hide();

	$('#editStudent').modal('hide');

	$('#addResult').modal('hide');

	$('#editResult').modal('hide');

	$('#deleteResult').modal('hide');

	$('select#tarikh').change(function(){

		$('.tik_image').hide();

		date = $(this).find('option:selected').val();

		if(date){
			$('.gettarikh').val(date);
		}
	});

	$('select#month').change(function(){

		$('.tik_image').hide();

		month = $(this).find('option:selected').val();

		if(month){
			$('.getmonth').val(month);
		}


	});

	$('select#subject').change(function(){

		$('.tik_image').hide();

		subject = $(this).find('option:selected').val();

		if(subject){
			$('.getsubject').val(subject);
		}
	});

	$("#search").keyup(function(){
		_this = this;
        // Show only matching TR, hide rest of them
        $.each($("#student_list tbody tr"), function() {
        	if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
        		$(this).hide();
        	else
        		$(this).show();                
        });
    }); 

	/*$('#studentTable').ddTableFilter();*/

	var studentManager = {

		init : function(){

			$('.main').on('submit','.addstudent form[data-remote]', this.savestudent);

			$('.row').on('submit','.add_subject form[data-remote]', this.saveSubject);

			$('.row').on('submit','.add_batch form[data-remote]', this.saveBatch);

			$('.row').on('submit','.add_class form[data-remote]', this.saveClass);

			$('.row').on('submit','.add_shift form[data-remote]', this.saveShift);

			$('.row').on('click','.editClass', this.editStudent);

			$('.row').on('submit','.edit_student form[data-remote]',this.saveEditedSubject);

			$('.row').on('click','.deleteClass', this.deleteStudent);

			$('.row').on('click','.addresult', this.addResultShowModal);

			$('.row').on('click','.showresult', this.showOptionIndivisual);

			$('.row').on('click','.edit_result', this.editResult);

			$('.row').on('click','.delete_result', this.fetchResultToBeDeleted);

			$('.row').on('submit','.fetch_result_to_be_deleted form[data-remote]',this.deleteResult);

			$('.row').on('submit','.save_edited_result form[data-remote]',this.saveEditedResult);

			$('.row').on('submit','.add_result form[data-remote]',this.addResult);

			$('.row').on('click','.select_class_batch',this.showSuccessiveResult);

			$('select#select_year').change(this.studentListByYear);

			$('select#select_class').change(this.studentListByClass);

			$('select#select_batch').change(this.studentListByBatch);

			$('select#select_shift').change(this.studentListByShift);

			$('select#select_year_result').change(this.studentListByYearResult);

			$('select#select_class_result').change(this.studentListByClassResult);

			$('select#select_batch_result').change(this.studentListByBatchResult);

			$('select#select_shift_result').change(this.studentListByShiftResult);

			/*$('select#select_month_result').change(this.resultListByClass);
			
			$('select#select_class_result').change(this.resultListByClass);
			
			$('select#select_shift_result').change(this.resultListByClass);
			
			$('select#select_batch_result').change(this.resultListByClass);*/

			$('.row').on('submit','.save_result form[data-remote]', this.saveResult);

			

		},
		
		saveResult: function(e){

			e.preventDefault();
			
			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			form.find('#load_save').show();

			$.ajax({

				type : method,

				url  : url,

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : dataString 
			})
			.done(function(msg){

				form.find('#load_save').hide();

				form.find('.tik_image').show();

				form.trigger('reset');

				if(msg){alert(msg);}

			})
			.fail(function(){

				form.find('#load_save').hide();

				alert("error");

			});
		},

		showSuccessiveResult: function(e){

			e.preventDefault();

			$clas = $('#class  option:selected' ).text();
			$batch = $('#batch  option:selected' ).text();

			// alert($clas+$batch);
			
			$.ajax({

				type : "POST",

				url  : "/successive_class_perfomance_by_class_and_batch",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {class : clas, batch: batch} 
			})
			.done(function(){

				var currentPageUrl = window.location.href;

				$('.result_list').load(currentPageUrl+' .result_list');


			})
			.fail(function(){

				alert("error");

			});

		},

		resultListByClass: function(e){

			e.preventDefault();

			var month = $( "#select_month_result option:selected" ).text();
			var clas = $( "#select_class_result option:selected" ).text();
			var batch = $( "#select_batch_result option:selected" ).text();
			var shift = $( "#select_shift_result option:selected" ).text();

			// alert(month+ clas+ batch+ shift);

			$.ajax({

				type : "POST",

				url  : "/filter_result_by_class",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {class : clas, month: month, batch: batch, shift: shift} 
			})
			.done(function(results){

				results = JSON.parse(results);



				var totalDiv = $("#all_result_table");

				var gradeCounterDiv = $("#grade_counter");

				totalDiv.find("tr:gt(0)").remove();

				gradeCounterDiv.find("tr:gt(0)").remove();

				var startTR = "<tr>";

				var endTR = "</tr>";

					// alert(students);
					var grade, ADoublePlus=0, APlus=0, A = 0, AMinus = 0, B = 0, C= 0, D = 0, F = 0;



					for (var i = results.data.length - 1; i >= 0; i--) {

						/**
						 * Counting Working Day
						 */

						 var working_day = 0;

						 if(results.data[i]['one']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['two']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['three']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['four']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['five']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['six']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['seven']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['eight']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['nine']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['ten']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['eleven']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twelve']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['thirteen']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['fourteen']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['fifteen']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['sixteen']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['seventeen']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['eighteen']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['nineteen']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twenty']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentyone']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentytwo']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentythree']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentyfour']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentyfive']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentysix']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentysix']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentyseven']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentyeight']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['twentynine']!=0){
						 	working_day++;
						 }

						 if(results.data[i]['thirty']!=0){
						 	working_day++;
						 }
						 if(results.data[i]['thirtyone']!=0){
						 	working_day++;
						 }


						/**
						 * Calculating Total Result of each Student
						 * 
						 */
						 var totalresult = results.data[i]['one']+
						 results.data[i]['two']+
						 results.data[i]['three']+
						 results.data[i]['four']+
						 results.data[i]['five']+
						 results.data[i]['six']+
						 results.data[i]['seven']+
						 results.data[i]['eight']+
						 results.data[i]['nine']+
						 results.data[i]['ten']+
						 results.data[i]['eleven']+
						 results.data[i]['twelve']+
						 results.data[i]['thirteen']+
						 results.data[i]['fourteen']+
						 results.data[i]['fifteen']+
						 results.data[i]['sixteen']+
						 results.data[i]['seventeen']+
						 results.data[i]['eighteen']+
						 results.data[i]['nineteen']+
						 results.data[i]['twenty']+
						 results.data[i]['twentyone']+
						 results.data[i]['twentytwo']+
						 results.data[i]['twentythree']+
						 results.data[i]['twentyfour']+
						 results.data[i]['twentyfive']+
						 results.data[i]['twentysix']+
						 results.data[i]['twentyseven']+
						 results.data[i]['twentyeight']+
						 results.data[i]['twentynine']+
						 results.data[i]['thirty']+
						 results.data[i]['thirtyone'];

						 /**
						  * Calculating Grade and In Percent
						  */
						  
						  
						  var gross_marks = working_day*100;
						  
						  var in_percent = (totalresult*100)/gross_marks;
						  
						  var gradecalc = Math.floor(in_percent/10);
						  
						  switch (gradecalc) {

						  	case 10:
						  	grade = 'A++';
						  	ADoublePlus++;
						  	break;

						  	case 9:
						  	grade = 'A++';
						  	ADoublePlus++;
						  	break;

						  	case 8:
						  	grade = 'A+';
						  	APlus++;
						  	break;

						  	case 7:
						  	grade = 'A';
						  	A++;
						  	break;

						  	case 6:
						  	grade = 'A-';
						  	AMinus++;
						  	break;

						  	case 5:
						  	grade = 'B';
						  	B++;
						  	break;

						  	case 4:
						  	grade = 'C';
						  	C++;
						  	break;

						  	case 3:
						  	grade = 'D';
						  	D++;
						  	break;

						  	default:
						  	grade = 'F';
						  	F++;
						  	break;
						  }

						  totalData = "<td>"+results.data[i]['name']+"</td>";
						  totalData += "<td>"+results.data[i]['month']+"</td>";
						  totalData += "<td>"+results.data[i]['class']+"</td>";
						  totalData += "<td>"+results.data[i]['roll']+"</td>";
						  totalData += "<td>"+results.data[i]['batch']+"</td>";
						  totalData += "<td>"+results.data[i]['shift']+"</td>";
						  totalData += "<td>"+results.data[i]['one']+"</td>";
						  totalData += "<td>"+results.data[i]['two']+"</td>";
						  totalData += "<td>"+results.data[i]['three']+"</td>";
						  totalData += "<td>"+results.data[i]['four']+"</td>";
						  totalData += "<td>"+results.data[i]['five']+"</td>";
						  totalData += "<td>"+results.data[i]['six']+"</td>";
						  totalData += "<td>"+results.data[i]['seven']+"</td>";
						  totalData += "<td>"+results.data[i]['eight']+"</td>";
						  totalData += "<td>"+results.data[i]['nine']+"</td>";
						  totalData += "<td>"+results.data[i]['ten']+"</td>";
						  totalData += "<td>"+results.data[i]['eleven']+"</td>";
						  totalData += "<td>"+results.data[i]['twelve']+"</td>";
						  totalData += "<td>"+results.data[i]['thirteen']+"</td>";
						  totalData += "<td>"+results.data[i]['fourteen']+"</td>";
						  totalData += "<td>"+results.data[i]['fifteen']+"</td>";
						  totalData += "<td>"+results.data[i]['sixteen']+"</td>";
						  totalData += "<td>"+results.data[i]['seventeen']+"</td>";
						  totalData += "<td>"+results.data[i]['eighteen']+"</td>";
						  totalData += "<td>"+results.data[i]['nineteen']+"</td>";
						  totalData += "<td>"+results.data[i]['twenty']+"</td>";
						  totalData += "<td>"+results.data[i]['twentyone']+"</td>";
						  totalData += "<td>"+results.data[i]['twentytwo']+"</td>";
						  totalData += "<td>"+results.data[i]['twentythree']+"</td>";
						  totalData += "<td>"+results.data[i]['twentyfour']+"</td>";
						  totalData += "<td>"+results.data[i]['twentyfive']+"</td>";
						  totalData += "<td>"+results.data[i]['twentysix']+"</td>";
						  totalData += "<td>"+results.data[i]['twentyseven']+"</td>";
						  totalData += "<td>"+results.data[i]['twentyeight']+"</td>";
						  totalData += "<td>"+results.data[i]['twentynine']+"</td>";
						  totalData += "<td>"+results.data[i]['thirty']+"</td>";
						  totalData += "<td>"+results.data[i]['thirtyone']+"</td>";
						  totalData += "<td>"+totalresult+"</td>";
						  totalData += "<td>"+in_percent+"</td>";
						  totalData += "<td>"+grade+"</td>";


						  totalDiv.append(startTR+totalData+endTR);
						}



						gradeData = "<td>"+ADoublePlus+"</td>";
						gradeData += "<td>"+APlus+"</td>";
						gradeData += "<td>"+A+"</td>";
						gradeData += "<td>"+AMinus+"</td>";
						gradeData += "<td>"+B+"</td>";
						gradeData += "<td>"+C+"</td>";
						gradeData += "<td>"+D+"</td>";
						gradeData += "<td>"+F+"</td>";

						gradeCounterDiv.append(startTR+gradeData+endTR);

					})
.fail(function(){

	alert("error");

});



},

studentListByYearResult: function(e){

	e.preventDefault();

	var year = $( "#select_year_result option:selected" ).text();

	if(year != 'Select Year'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter_student_by_year",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year} 
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students = JSON.parse(students);

					//alert(students.length);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += '<td><div class="form-inline save_result"><form method="POST" action="/save_result" accept-charset="UTF-8" data-remote="data-remote" data-remote-success="Result Added successfully"><input class="id" name="student_id" value='+students[i]['id']+' type="hidden"><input class="getmonth" name="month" value="January" id="month" type="hidden"><input class="getsubject" name="subject" value="Bangla" id="subject" type="hidden"><input class="gettarikh" name="tarikh" value="1" id="tarikh" type="hidden"><input class="form-control" required="required" name="marks" type="text"> <input class="btn btn-primary btnGo" value="Add" type="submit"><img class="tik_image" style="display:none" src="images/tik.png" alt="not found"><img id="load_save" style="display:none" src="images/loading.gif"></form></div></td>';

						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},

studentListByShiftResult: function(e){

	e.preventDefault();
	var year = $( "#select_year_result option:selected" ).text();
	var clas = $( "#select_class_result option:selected" ).text();
	var batch = $( "#select_batch_result option:selected" ).text();
	var shift = $( "#select_shift_result option:selected" ).text();	

	if(shift !='Select Shift'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter-student",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year, class : clas, batch: batch, shift: shift}
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students = JSON.parse(students);

					//alert(students.length);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					// alert(students);



					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += '<td><div class="form-inline save_result"><form method="POST" action="/save_result" accept-charset="UTF-8" data-remote="data-remote" data-remote-success="Result Added successfully"><input class="id" name="student_id" value='+students[i]['id']+' type="hidden"><input class="getmonth" name="month" value="January" id="month" type="hidden"><input class="getsubject" name="subject" value="Bangla" id="subject" type="hidden"><input class="gettarikh" name="tarikh" value="1" id="tarikh" type="hidden"><input class="form-control" required="required" name="marks" type="text"> <input class="btn btn-primary btnGo" value="Add" type="submit"><img class="tik_image" style="display:none" src="images/tik.png" alt="not found"><img id="load_save" style="display:none" src="images/loading.gif"></form></div></td>';

						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},

studentListByBatchResult: function(e){

	e.preventDefault();
	var year = $( "#select_year_result option:selected" ).text();
	var clas = $( "#select_class_result option:selected" ).text();
	var batch = $( "#select_batch_result option:selected" ).text();
	var shift = $( "#select_shift_result option:selected" ).text();

	if(batch !='Select Batch'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter-student",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year, class : clas, batch: batch, shift: shift}
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students= JSON.parse(students);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					//alert(students.length);



					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += '<td><div class="form-inline save_result"><form method="POST" action="/save_result" accept-charset="UTF-8" data-remote="data-remote" data-remote-success="Result Added successfully"><input class="id" name="student_id" value='+students[i]['id']+' type="hidden"><input class="getmonth" name="month" value="January" id="month" type="hidden"><input class="getsubject" name="subject" value="Bangla" id="subject" type="hidden"><input class="gettarikh" name="tarikh" value="1" id="tarikh" type="hidden"><input class="form-control" required="required" name="marks" type="text"> <input class="btn btn-primary btnGo" value="Add" type="submit"><img class="tik_image" style="display:none" src="images/tik.png" alt="not found"><img id="load_save" style="display:none" src="images/loading.gif"></form></div></td>';

						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},

studentListByClassResult: function(e){

	e.preventDefault();

	var year = $( "#select_year_result option:selected" ).text();
	var clas = $( "#select_class_result option:selected" ).text();
	var batch = $( "#select_batch_result option:selected" ).text();
	var shift = $( "#select_shift_result option:selected" ).text();

	if( clas!='Select Class'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter-student",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year, class : clas, batch: batch, shift: shift}
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students= JSON.parse(students);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					//alert(students.length);



					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += '<td><div class="form-inline save_result"><form method="POST" action="/save_result" accept-charset="UTF-8" data-remote="data-remote" data-remote-success="Result Added successfully"><input class="id" name="student_id" value='+students[i]['id']+' type="hidden"><input class="getmonth" name="month" value="January" id="month" type="hidden"><input class="getsubject" name="subject" value="Bangla" id="subject" type="hidden"><input class="gettarikh" name="tarikh" value="1" id="tarikh" type="hidden"><input class="form-control" required="required" name="marks" type="text"> <input class="btn btn-primary btnGo" value="Add" type="submit"><img class="tik_image" style="display:none" src="images/tik.png" alt="not found"><img id="load_save" style="display:none" src="images/loading.gif"></form></div></td>';

						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},

studentListByYear: function(e){

	e.preventDefault();

	var year = $( "#select_year option:selected" ).text();

	if(year != 'Select Year'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter_student_by_year",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year} 
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students = JSON.parse(students);

					//alert(students.length);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += "<td><a target='_blank' href='show_invivisual_result/"+students[i]['id']+"' class='showresult' data-id="+students[i]['id']+">Show Result</a></td>";
						totalData += "<td><a href='#' class='editClass' data-id="+students[i]['id']+">Edit</a></td>";
						totalData += "<td><a href='#' class='deleteClass' data-id="+students[i]['id']+">Delete</a></td>";


						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},

studentListByShift: function(e){

	e.preventDefault();
	var year = $( "#select_year option:selected" ).text();
	var clas = $( "#select_class option:selected" ).text();
	var batch = $( "#select_batch option:selected" ).text();
	var shift = $( "#select_shift option:selected" ).text();

	if(shift !='Select Shift'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter-student",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year, class : clas, batch: batch, shift: shift}
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students = JSON.parse(students);

					//alert(students.length);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					// alert(students);



					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += "<td><a target='_blank' href='show_invivisual_result/"+students[i]['id']+"' class='showresult' data-id="+students[i]['id']+">Show Result</a></td>";
						totalData += "<td><a href='#' class='editClass' data-id="+students[i]['id']+">Edit</a></td>";
						totalData += "<td><a href='#' class='deleteClass' data-id="+students[i]['id']+">Delete</a></td>";


						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},

studentListByBatch: function(e){

	e.preventDefault();
	var year = $( "#select_year option:selected" ).text();
	var clas = $( "#select_class option:selected" ).text();
	var batch = $( "#select_batch option:selected" ).text();
	var shift = $( "#select_shift option:selected" ).text();

	if(batch !='Select Batch'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter-student",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year, class : clas, batch: batch, shift: shift}
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students= JSON.parse(students);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					//alert(students.length);



					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += "<td><a target='_blank' href='show_invivisual_result/"+students[i]['id']+" class='showresult' data-id="+students[i]['id']+">Show Result</a></td>";
						totalData += "<td><a href='#' class='editClass' data-id="+students[i]['id']+">Edit</a></td>";
						totalData += "<td><a href='#' class='deleteClass' data-id="+students[i]['id']+">Delete</a></td>";


						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},


studentListByClass: function(e){

	e.preventDefault();

	var year = $( "#select_year option:selected" ).text();
	var clas = $( "#select_class option:selected" ).text();
	var batch = $( "#select_batch option:selected" ).text();
	var shift = $( "#select_shift option:selected" ).text();

	if( clas!='Select Class'){

		$('#loading').show();

		$.ajax({

			type : "POST",

			url  : "/filter-student",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {year: year, class : clas, batch: batch, shift: shift}
		})
		.done(function(students){

					//var appendArea = $(".student_list");
					//
					students= JSON.parse(students);

					var totalDiv = $(".studentTable");

					totalDiv.find("tr:gt(0)").remove();

					var startTR = "<tr>";

					var endTR = "</tr>";

					//alert(students.length);



					for (var i = 0; i < students.length; i++) {

						totalData = "<td>"+(i+1)+"</td>";
						totalData += "<td>"+students[i]['name']+"</td>";
						totalData += "<td>"+students[i]['class']+"</td>";
						totalData += "<td>"+students[i]['roll']+"</td>";
						totalData += "<td>"+students[i]['batch']+"</td>";
						totalData += "<td>"+students[i]['shift']+"</td>";
						totalData += "<td>"+students[i]['year']+"</td>";
						totalData += "<td><a target='_blank' href='show_invivisual_result/"+students[i]['id']+" class='showresult' data-id="+students[i]['id']+">Show Result</a></td>";
						totalData += "<td><a href='#' class='editClass' data-id="+students[i]['id']+">Edit</a></td>";
						totalData += "<td><a href='#' class='deleteClass' data-id="+students[i]['id']+">Delete</a></td>";


						totalDiv.append(startTR+totalData+endTR);
					}

					$('#loading').hide();
				})
		.fail(function(){

			$('#loading').hide();

			alert("error");

		});
	}
},

deleteResult: function(e){

	e.preventDefault();

	var form = $(this);

	var method = form.find('input[name="_method"]').val() || 'POST';

	var url = form.prop('action');

	var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : dataString 
			})
			.done(function(){

				$('#deleteResult').modal('hide');

				form.trigger('reset');

				$('#editResult').modal('hide');

			})
			.fail(function(){

				alert("Opps!! Please add result for this date first!");

			});
		},

		editResult: function(e){

			e.preventDefault();

			var clickedResult = $(this);

			var studentID = clickedResult.data('id');
			var subject = clickedResult.data('subject');
			var month = clickedResult.data('month');

	// alert(roll+clas+shift+batch+month);

	$('.id').val(studentID);
	$('.month').val(month);
	$('.subject').val(subject);
	$('#editResult').modal('show');
},

fetchResultToBeDeleted: function(e){

	e.preventDefault();

	var clickedResult = $(this);

	var studentID = clickedResult.data('id');
	var subject = clickedResult.data('subject');
	var month = clickedResult.data('month');

	// alert(roll+clas+shift+batch+month);

	$('.id').val(studentID);
	$('.month').val(month);
	$('.subject').val(subject);
	$('#deleteResult').modal('show');
},


saveEditedResult:  function(e){

	e.preventDefault();

			// alert('hi');

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : dataString 
			})
			.done(function(){

				form.trigger('reset');

				$('#editResult').modal('hide');

			})
			.fail(function(){

				alert("Opps!! Please add result for this date first!");

			});


		},

		addResultShowModal: function(e){

			e.preventDefault();

			var clickedStudent = $(this);

			var clickedStudentId = clickedStudent.data('id');
			var clickedStudentName = clickedStudent.data('name');
			var clickedStudentClass = clickedStudent.data('class');
			var clickedStudentRoll = clickedStudent.data('roll');
			var clickedStudentBatch = clickedStudent.data('batch');
			var clickedStudentShift = clickedStudent.data('shift');
			var clickedStudentYear = clickedStudent.data('year');

			$('.id').val(clickedStudentId);

			if(month){
				$('.getmonth').val(month);
			}
			
			if(subject){
				$('.getsubject').val(subject);
			}

			if(date){
				$('.gettarikh').val(date);
			}


			$('p.student_details').html('Name: ' + clickedStudentName + ' | '+ 'Class: ' +  clickedStudentClass + ' | '+ 'Roll: ' + clickedStudentRoll + ' | '+ 'Batch: ' + clickedStudentBatch + ' | '+ 'Shift: ' + clickedStudentShift + ' | '+ 'Year: ' + clickedStudentYear);

			$('#addResult').modal('show');
		},

		addResult: function(e){

			e.preventDefault();

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				data : dataString 
			})
			.done(function(result){

				// if(result){
				// 	alert(result);
				// }else{

					form.trigger('reset');

					$('#addResult').modal('hide');
				// }

			})
			.fail(function(){

				alert("error");

			});

		}, 

		deleteStudent: function(e){

			e.preventDefault();

			/*var clickedStudent = $(this);

			var clickedStudentId = clickedStudent.data('id');

			alert(clickedStudentId);*/


			if (confirm("Do you really want to delete this Student?")) {

				var clickedStudent = $(this);

				var clickedStudentId = clickedStudent.data('id');

				$.ajax({

					type : "POST",

					url  : "/deletestudent",

					headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

					data : {id : clickedStudentId} 
				})
				.done(function(){

					var currentPageUrl = window.location.href;

					$('.student_list').load(currentPageUrl+' .student_list');

					
					/*$('#studentTable').ddTableFilter();*/

				})
				.fail(function(){

					alert("error");

				});
			}
		},

		editStudent: function(e){

			e.preventDefault();

			var clickedStudent = $(this);

			var clickedStudentId = clickedStudent.data('id');

			$.ajax({

				type : "POST",

				url  : "/editstudent",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {id : clickedStudentId} 
			})
			.done(function(student){

				student = JSON.parse(student);
					// alert(student['id']);
					$('.id').val(student['id']);
					$('.name').val(student['name']);
					$('.class').val(student['class']);
					$('.roll').val(student['roll']);
					$('.batch').val(student['batch']);
					$('.shift').val(student['shift']);
					$('.mobile').val(student['mobile']);
					$('.year').val(student['year']);

					$('#editStudent').modal('show');

				})
			.fail(function(){

				alert("error");

			});
		},

		saveEditedSubject: function(e){

			e.preventDefault();
			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				data : dataString 
			})
			.done(function(){

				$('#editStudent').modal('hide');

				var currentPageUrl = window.location.href;

				$('body').load(currentPageUrl);

				

			})
			.fail(function(){

				alert("error");

			});

		},

		savestudent: function(e){

			e.preventDefault();

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				data : dataString 
			})
			.done(function(){

				// form.trigger('reset');
				$('.name').val('');
				$('.roll').val('');
				$('.mobile').val('');

				$('#alert').show();
				$('#alert').delay(4000).hide(300);

			})
			.fail(function(){

				alert("error");

			});

		},

		saveSubject: function(e){

			e.preventDefault();

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				data : dataString 
			})
			.done(function(){

				form.trigger('reset');

				var message = form.data('remote-success');

				alert(message);
			})
			.fail(function(){

				alert("error");

			});

		},

		saveClass: function(e){

			e.preventDefault();

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				data : dataString 
			})
			.done(function(){

				form.trigger('reset');

				var message = form.data('remote-success');

				alert(message);
			})
			.fail(function(){

				alert("error");

			});

		},

		saveBatch: function(e){

			e.preventDefault();

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				data : dataString 
			})
			.done(function(){

				form.trigger('reset');

				var message = form.data('remote-success');

				alert(message);
			})
			.fail(function(){

				alert("error");

			});

		},

		saveShift: function(e){

			e.preventDefault();

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				data : dataString 
			})
			.done(function(){

				form.trigger('reset');

				var message = form.data('remote-success');

				alert(message);
			})
			.fail(function(){

				alert("error");

			});

		}
	};

	$(function(){

		studentManager.init();

		/*$('#studentTable').ddTableFilter();*/

	});

})(jQuery);