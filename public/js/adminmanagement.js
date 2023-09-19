// $(document).ready(function(){
// 	// Activate tooltip
// 	$('[data-toggle="tooltip"]').tooltip();

// 	// Select/Deselect checkboxes
// 	var checkbox = $('table tbody input[type="checkbox"]');
// 	$("#selectAll").click(function(){
// 		if(this.checked){
// 			checkbox.each(function(){
// 				this.checked = true;
// 			});
// 		} else{
// 			checkbox.each(function(){
// 				this.checked = false;
// 			});
// 		}
// 	});
// 	checkbox.click(function(){
// 		if(!this.checked){
// 			$("#selectAll").prop("checked", false);
// 		}
// 	});
// });

// document.getElementById('modal-close').addEventListener('click',clearInput);

// function clearInput(){
// 	document.getElementById('modal-close').innerHTML = "";
// 	document.getElementById('msg').innerHTML = "";
// }



var requiredField = 0; // json_encode($selectedReportType);

// Get a reference to the submit button
var submitButton = document.getElementById('submitButton');

// Function to toggle the button's disabled attribute based on the value of `requiredField`
function toggleButton() {
    if(submitButton) {
        submitButton.disabled = requiredField;
    }
}

// Call the function initially to set the initial state of the button
toggleButton();

// Add an event listener to `requiredField` so that the button is enabled or disabled in real-time
// whenever `requiredField` changes its value
Object.defineProperty(window, 'selectedReportType', {
	set: function(value) {
		selectedReportType = value;
		toggleButton();
	}
});






$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;
			});
		} else{
			checkbox.each(function(){
				this.checked = false;
			});
		}
	});


	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

window.addEventListener('close-modal', event => {
	$('#addCategoryModal').modal('hide');
});


function hideContent() {
	var elementToHide = document.getElementById("password");
	elementToHide.classList.add("hidden");
  }


function hideContentde() {
	var field1 = document.getElementById("fname");
	var field2 = document.getElementById("sname");
	var field3 = document.getElementById("email");
	var field4 = document.getElementById("staff_number");
	var field5 = document.getElementById("role_name");
	var field6 = document.getElementById("password");
	var field7 = document.getElementById("password_confirmation");

	// Toggle visibility of fields
	if (field1.classList.contains("hiddenField")) {
		field6.classList.add("hiddenField");
		field7.classList.add("hiddenField");
		field1.classList.remove("hiddenField");
		field2.classList.remove("hiddenField");
		field3.classList.remove("hiddenField");
		field4.classList.remove("hiddenField");
		field5.classList.remove("hiddenField");
	} else {
	  field6.classList.remove("hiddenField");
	  field7.classList.remove("hiddenField");
	  field1.classList.add("hiddenField");
	  field2.classList.add("hiddenField");
	  field3.classList.add("hiddenField");
	  field4.classList.add("hiddenField");
	  field5.classList.add("hiddenField");
	}
  }

