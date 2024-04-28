$(document).ready(function(){
    // Función para cargar los comentarios al cargar la página
    cargarComentarios();

    // Función para cargar los comentarios desde PHP
    function cargarComentarios() {
        $.ajax({
            url: 'cargar_comentarios.php',
            type: 'GET',
            success: function(response) {
                $('#comentarios-lista').html(response);

                // Agregar evento click al botón de me gusta
                $('.btn-like').click(function(){
                    var idComentario = $(this).data('id');
                    darMeGusta(idComentario);
                });
            }
        });
    }

    // Función para dar me gusta a un comentario
    function darMeGusta(idComentario) {
        $.ajax({
            url: 'dar_me_gusta.php',
            type: 'POST',
            data: { idComentario: idComentario },
            success: function(response) {
                if (response.status == 'success') {
                    // Actualizar la cantidad de me gusta mostrada en el botón
                    var likes = response.likes;
                    $('.btn-like[data-id=' + idComentario + ']').text('Me gusta (' + likes + ')');
                } else {
                    alert('Error al dar me gusta.');
                }
            }
        });
    }
});
