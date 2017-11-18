function setBackground(e) {
	if (e.type == "focus") {
		e.target.className += " highlight";
	}
	else if (e.type == "blur") {
		e.target.classList.remove("highlight");
		if (e.target.value != null && e.target.value != '') {
		    e.target.classList.remove("error");
		}
	}
}

window.addEventListener("load", function() {
    var fields = document.querySelectorAll(".hilightable");
    
    for (var i = 0; i<fields.length; i++) {
        fields[i].addEventListener("focus", setBackground);
        fields[i].addEventListener("blur", setBackground);
    }
});




function init() {
    document.getElementById("mainForm").addEventListener("submit", checkForEmptyFields);
}

window.addEventListener("load", init);

function checkForEmptyFields(e){
    var fields = document.querySelectorAll(".required");
    for (var i=0; i<fields.length; i++) {
        if (fields[i].value == null || fields[i].value =='') {
            e.preventDefault();
            fields[i].classList.add("error");
        }
    }
}
