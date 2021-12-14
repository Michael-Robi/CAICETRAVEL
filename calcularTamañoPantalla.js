$(function () {

  // Función para obtener el Ancho(Width)
  function obtenerAncho(obj, ancho) {
    $( "#anchoV" ).text( "El ancho de la " + obj + " es " + ancho + "px. (Width)" );
  }

  // Función para obtener el Alto(Height)
  function obtenerAlto(obj, alto) {
    $( "#altoV" ).text( "El alto de la " + obj + " es " + alto + "px. (Height)" );
  }
  
  obtenerAncho("ventana", $(window).width());
  obtenerAlto("ventana", $(window).height());

  $(window).resize(function(){
    obtenerAncho("ventana", $(window).width());
    obtenerAlto("ventana", $(window).height());
  });

});