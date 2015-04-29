(function ($, Drupal, window, document, undefined) {
	$(function(){
		updateSavedProgramDisplay();
	});

	window.addProgram = function(){
		program = getProgramFromCurrentPage();
		programs = getProgramsFromStorage();

		programs[program.title] = program.link

		savePrograms(programs);

		updateSavedProgramDisplay();

		$(function(){
			$("#issaved").toggle();
		});
		return false;
	};

	savePrograms = function(programs){
		programs = JSON.stringify(programs);
		setCookie("programs", programs, 7);
	};


	updateSavedProgramDisplay = function(){
		$("#savedProgramDisplay ul").append("<li>asdfsdf</li>");
		programs = getProgramsFromStorage();
		$("#savedProgramDisplay ul").html("");
		forEachInObj(programs, function(program){
			programLink = "<a href='"+programs[program]+"'>" +program+ "</a>";
			program = '"' + program + '"';
			deleteLink = "<a class='delete' onclick='deleteProgram("+ program +")'>" + " x" + "</a>";
			$("#savedProgramDisplay ul").append("<li>"+ programLink + deleteLink + "</li>");
		})
	}

	deleteProgram = function(program){
		programs = getProgramsFromStorage();
		delete programs[program];
		savePrograms(programs);
		updateSavedProgramDisplay();
	}



	getProgramFromCurrentPage = function(){
		var program = {};
		program.title = $(".page__title").html();
		program.link = window.location.href;
		return program;
	};

	logPrograms = function(){
		programs = getProgramsFromStorage();
		forEachInObj(programs, function(program){
			console.log(program);
			console.log(programs[program]);
		})	
	};


	forEachInObj = function(obj, func){
		for (var property in obj) {
		    if (obj.hasOwnProperty(property)) {
		        func(property);
		    }
		}
	};

	getProgramsFromStorage = function(){
		var programs = getCookie("programs");
		try{
			programs = JSON.parse(programs)
		}
		catch(err){
			console.log("programs is empty or broken: " + err)
			programs = {};
		}
		return programs;
	};
	
})(jQuery, Drupal, this, this.document);
