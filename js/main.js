"use strict";

// ----- js for registration form show hide ----- 

function showform(){ 
	if(document.getElementById('usertype').value == 'hq'){
		$("#hq").show();
		$("#others").hide();
	}
	else {
		$("#hq").hide();
		$("#others").show();
	}
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