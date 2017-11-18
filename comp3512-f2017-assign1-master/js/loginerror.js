/*
    Functions based off of lab.
*/

//When a key is pressed in text field, it removes the error colors
function setBackground(e) {
	if (e.type == "keydown") {
		e.target.classList.remove("error");
	}
}

//Adds listeners for key presses in login input boxes
window.addEventListener("load", function() {
    var fields = document.querySelectorAll(".form-control");
    
    for (var i = 0; i<fields.length; i++) {
        fields[i].addEventListener("keydown", setBackground);
    }
});