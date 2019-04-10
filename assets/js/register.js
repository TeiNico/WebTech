$(document).ready(function(){

//Gibt im register.php den spans hidelogin und hideRegister die Funktion beim klicken die jeweilige form zu verbergen
	$("#hideLogin").click(function(){
		$("#loginForm").hide();
		$("#registerForm").show();
	});

	$("#hideRegister").click(function(){
		$("#registerForm").hide();
		$("#loginForm").show();
	});
}) ;