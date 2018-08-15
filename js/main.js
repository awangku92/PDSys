"use strict";

// ----- js for registration form show hide ----- 

function showform(){ 

	//make case here
	var userType = document.getElementById('usertype').value;

	switch(userType){
		case "HQ":
			$("#hq").show();
			$("#dealer").hide();
			$("#contractor").hide();
	        break;
	    case "D":
	     	$("#hq").hide();
			$("#dealer").show();
			$("#contractor").hide();
	        break;
	    case "C":
	        $("#hq").hide();
			$("#dealer").hide();
			$("#contractor").show();
	        break;
	    default:
	    	break;
	}

	// if(document.getElementById('usertype').value == 'hq'){
	// 	$("#hq").show();
	// 	$("#others").hide();
	// }
	// else {
	// 	$("#hq").hide();
	// 	$("#others").show();
	// }
}

 // ----- js for modal view open and close -----

 $ (document).ready ( (e)=> {

	function testAnim(x) {
	  $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
		};
		$('#myModal').on('show.bs.modal', function (e) {
		  var anim = $('#entrance').val();
		      testAnim(anim);
		})
		$('#myModal').on('hide.bs.modal', function (e) {
		  var anim = $('#exit').val();
		      testAnim(anim);
		})

});