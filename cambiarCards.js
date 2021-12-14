$(function () {
	// Método para obtener el tamaño de la pantalla y si es menor de 369 
	// lo cambie por card horizontal 
    if ($(window).width() <= 369) {
      	$('#tamañoC').attr('class', 'card horizontal');
    }

    // Método para obtener el tamaño de la pantalla y si es mayor de 369 
	// lo cambie por card
    else{
		$('#tamañoC').attr('class', 'card'); 
    } 

    $(window).resize(function() {

      if ($(window).width() <= 369) {
      	$('#tamañoC').attr('class', 'card horizontal');
      }

      else{
		$('#tamañoC').attr('class', 'card'); 
      }

    });
});