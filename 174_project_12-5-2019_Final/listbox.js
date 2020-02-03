// Declare elements

//for switching between tabs
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
} 

/*for adding variable number of text boxes*/



var j = 0;
	
function addTeam(){
	var original = document.getElementById('testing'); //record original element on page
	var newP = document.createElement("p"); //create new seciton for team
	var newTeam = document.createElement("input");
	
	newP.innerHTML = 'Team Name:<br>';	

	newTeam.id = "team" + ++j;
	newTeam.type = "text";
	newTeam.id = "team" + j;
	newTeam.setAttribute('name', "team" + j);
	newTeam.placeholder = "Team Name";


	newP.appendChild(newTeam);	
	newP.innerHTML += 'Team Member Names:<br>';

	var newButton = document.createElement("button"); //create a new 'AddMember' button
	newButton.id = "memButton" + j;
	newButton.textContent="Add Member";
	newButton.value = j;
	newButton.setAttribute('onclick', 'addmember(this.id, this.value)');

	var originalButton = document.getElementById('teamButton');
	var clone = originalButton.cloneNode(true);

	var newMember = document.createElement("input");
	newMember.id = "teammembers" + j;
	newMember.type = "text";
	newMember.name = "name0" + "team" + j;
	newMember.placeholder = "Last name, First name";

	newP.appendChild(newMember); //adds newMember to paragraph
	newP.appendChild(newButton); //adds newButton to paragraph
	original.appendChild(newP);

	original.parentNode.removeChild(originalButton); //update 'Add Team' button
	document.getElementById('testing').parentNode.insertBefore(clone, document.getElementById('brr'));
}


var i = 0;

function addmember(bid, bval){
	var newMember = document.createElement("input"); //create new Member Textfield
	newMember.id = "teammembers" + ++i; //increase id value of new object
	newMember.type = "text";
	newMember.name = "name" + i + "team" + bval;
	newMember.placeholder = "Last name, First name";
	
	var pid = document.getElementById(bid).parentNode; //get id of parent node
	var originalButton = document.getElementById(bid); //get a clone of the 'AddMember' button
	var clone = originalButton.cloneNode(true);
	pid.appendChild(newMember);
	pid.removeChild(document.getElementById(bid));
	pid.appendChild(clone);
}

var k = 0;

function addjudge() {
	var original = document.getElementById('judges');
	var newJudge = document.createElement("input"); //create a new judge input box
	var originalButton = document.getElementById('jbutton');
	var clone = originalButton.cloneNode(true);

	newJudge.id = "judgemembers" + ++k;
	newJudge.setAttribute('type', 'text');
	newJudge.setAttribute('name', "jname" + k);
	newJudge.placeholder = "Last name, First name";
	original.appendChild(newJudge);

	original.parentNode.removeChild(originalButton); //updates 'Add Judge' button
	document.getElementById('testing').parentNode.insertBefore(clone, document.getElementById('testing'));
}

