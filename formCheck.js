// function to test if field is empty and use errorString as function parameterso that we can use same function for any field //
	function fieldEmpty(fieldvalue, errorString) {
	    if (fieldvalue == "") {
			return (errorString);
		} else {
	    	return "";    // return empty string
		}
	}
	// test if radio button is selected //
	function radioButtonSelected (radioButtons, errorString) {
		radioSelected = -1;
		// for loop: first need an index i to iterate through array of radio buttons;
		// next we need to decide if to start at beginning or end of array
		// i=radioButtons.length-1 means we start at end
		// test if all elements of array ... know if i > -1 that we have still elements to examine
		// i-- means that we subtract -1 from i
		for (i=radioButtons.length-1; i > -1; i--) {
			if (radioButtons[i].checked) {
				radioSelected = i; 
				i = -1;   // set index to -1 so that for loop stops
			}
		}
		// test if we found a selected radio button ... if radioSelected equal to -1, then we have not and return errorString
		if (radioSelected == -1) {
			return (errorString);
		} else {
			return "";
		}
	}
	// test how many checkboxes selected //
	function checkboxesSelected (checkboxes, errorString) {
		// keep a count of how many checkboxes have been selected ... initially zero
		// have to use var checkboxesSelected = 0; 
		// because: 1) function is also called "checkboxesSelected" and without explicit var declaration, a name conflict is created.
		// 2) Good practice to have var when declaring a variable ...not doing it in our JavaScript examples to not add more complexity.
		var checkboxesSelected = 0;
		// for loop: first need an index i to iterate through array of checkboxes;
		// start at beginning of array of checkboxes
		// i=0 means we start at beginning of array
		// test if all elements of array have been tested... know if i < checkboxes.length that we have still elements to examine
		// i-- means that we subtract -1 from i
		for (i=0; i<checkboxes.length; i++) {
			// test if current checkbox is checked ... if yes, add 1 to counter
			if (checkboxes[i].checked) {
				// increment counter
				checkboxesSelected += 1; 
			}
		}
		// test how many checkboxes have been selected ... 
		// if checkboxesSelected equal to 0, then we have not and return errorString
		if (checkboxesSelected < 2) {
			if(checkboxesSelected==0)	
				return (errorString);
			else
				return ("Select atleast two favorite tools")
		} 
		else {
			return "";
		}
	}
	// next several functions that might be useful for Exercise 4 "as is" or you can modify them to achieve the desired effect
	// 
	function validateUsername (fieldvalue) {
	    if (fieldvalue == "") return "No Username was entered.\n"
	    else if (fieldvalue.length < 5)
	        return "Usernames must be at least 5 characters.\n"
	    else if (/[^a-zA-Z0-9_-]/.test(fieldvalue))
	        return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
	    return ""
	}
	// test length of fieldvalue and whether at least one letter is of a certain type
	function validatePassword (fieldvalue) {
	    if (fieldvalue == "") return "No Password was entered.\n"
	    else if (fieldvalue.length < 6)
	        return "Passwords must be at least 6 characters.\n"
	    else if (!/[a-z]/.test(fieldvalue) || ! /[A-Z]/.test(fieldvalue) ||
	             !/[0-9]/.test(fieldvalue))
	        return "Passwords require one each of a-z, A-Z and 0-9.\n"
	    return ""
	}
	//
	function validateAge (fieldvalue) {
	    if (isNaN(fieldvalue)) return "No Age was entered.\n"
	    else if (fieldvalue < 18 || fieldvalue > 110)
	        return "Age must be between 18 and 110.\n"
	    return ""
	}
	//
	function validateEmail (fieldvalue) {
	    if (fieldvalue == "") return "No Email was entered.\n"
	        else if (!((fieldvalue.indexOf(".") > 0) &&
	                   (fieldvalue.indexOf("@") > 0)) ||
	                  /[^a-zA-Z0-9.@_-]/.test(fieldvalue))
	        return "The Email address is invalid.\n"
	    return ""
	}

	function validateState (fieldvalue) {
    	if (fieldvalue.length != 2) return "State must be two characters.\n"
    		return ""
	}
	// validate function that calls other functions and acculumates errorString and test if this is empty or not //
	function validate (form) {
	    fail  = fieldEmpty(form.name.value, "Name is empty.\n")  // \n creates new line
	    fail += fieldEmpty(form.address.value, "Address is empty.\n")
		fail += fieldEmpty(form.city.value, "City is empty.\n")
		fail += validateState(form.state.value)
		fail += fieldEmpty(form.zip.value, "Zip is empty.\n")
		fail += validateEmail(form.email.value)
		fail += radioButtonSelected(form.format, "Book format choice not selected.\n")
		fail += checkboxesSelected(form.favtool, "No Favorite Tools selected.\n")
	    if (fail == "") return true
	    else { alert(fail); return false }
	}

