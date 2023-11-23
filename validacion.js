$().ready(function () {

    $("#form").validate({
        rules: {
            name: { required: true, minlength: 7, maxlength: 20 },
            alias: { required: true, minlength: 5, maxlength: 15, numeroLetras: true },
            rut: { required: true, minlength: 2, validarRut: true },
            region: { required: true },
            comuna: { required: false },
            candidato: { required: true },
            email: { required: true, email: true, validarEmail: true },
            check: { required: true },

        },
        messages: {
            name: { required: "Por favor, ingresa tu nombre", minlength: "Tu nombre debe tener al menos 7 caracteres" },
            alias: { required: "Por favor, ingresa tu alias", minlength: "Tu alias debe tener al menos 5 caracteres" },
            rut: { required: "Por favor, ingresa tu rut", minlength: "Tu rut debe tener al menos 2 caracteres" },
            region: { required: "Por favor, selecciona una region" },
            comuna: { required: "Por favor, selecciona una comuna" },
            candidato: { required: "Por favor, selecciona un candidato" },
            email: { required: "Por favor, ingresa tu correo electronico", email: "Por favor, ingresa un correo electronico valido" },
            check: { required: "Por favor, selecciona almenos una" },
        }
    });


    // validar campo alias que contenga numeros y letras
    jQuery.validator.addMethod("numeroLetras", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    }, "Por favor, ingresa solo letras y numeros");


    // validacion campo email
    jQuery.validator.addMethod("validarEmail", function (value, element) {
        return this.optional(element) || /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value);
    }, "Por favor, ingresa un correo electronico valido");


    // validacion rut formato XXXXXXXX-X
    jQuery.validator.addMethod("validarRut", function (value, element) {
        return this.optional(element) || /^[0-9]+-[0-9kK]{1}$/.test(value);
    }, "Por favor, ingresa un rut valido");


    $("#form").submit(function (event) {
        event.preventDefault();
        var name = $("#name").val();
        var alias = $("#alias").val();
        var rut = $("#rut").val();
        var email = $("#email").val();
        var region = $("#region").val();
        var comuna = $("#comuna").val();
        var candidato = $("#candidato").val();
        let groupCheck = document.getElementsByName('check');

        var check = Array();
        for (let i = 0; i < groupCheck.length; i++) {

            // get all checked in the group
            if (groupCheck[i].checked) {
                check.push(groupCheck[i].value);
            }

        }
        // parse check to string
        check = check.toString();

        if ($("#form").valid()) {

            Swal.fire({
                title: "¿La información es correcta?",
                text: "nombre: " + name + "\n" + "alias: " + alias + "\n" + " rut: " + rut + "\n" + " email: " + email + "\n" + " region: " + region + "\n" + " comuna: " + comuna + "\n" + " candidato: " + candidato + "\n" + " check: " + check,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, es correcto!"
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("enviado", name, alias, rut, email, region, comuna, candidato, check);

                    $.ajax({
                        url: "captura.php",
                        type: "POST",
                        data: {
                            data: {
                                name: name,
                                alias: alias,
                                rut: rut,
                                email: email,
                                region: region,
                                comuna: comuna,
                                candidato: candidato,
                                check: check
                            }

                        },
                        dataType: "json",
                        success: function (response) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: response.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            });

                            // Limpiar el formulario
                            $("#form")[0].reset();


                            console.log("carga realizada", response);
                        },
                        finally: function () {
                            $("#form")[0].reset();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });

                }
            });


        }


    }


    );


});





