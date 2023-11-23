$(document).ready(function () {

    $("#region").ready(function () {

        $.ajax({
            url: "repuestaComunasRegiones.php",
            type: "POST",
            data: {
                regionLoad: "regionLoad",
            },
            dataType: "html",
            success: function (response) {
                $("#region").html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });

    });


    // Selector dependiente de regiones/comunas
    $("#region").change(function () {

        var regionSeleccionada = $(this).val();

        $.ajax({
            url: "repuestaComunasRegiones.php",
            type: "POST",
            data: {
                region: regionSeleccionada,
            },
            dataType: "html",
            success: function (response) {
                $("#comuna").html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });


    });



})