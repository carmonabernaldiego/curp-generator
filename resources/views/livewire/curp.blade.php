<style>
    .container-curp {
        width: 600px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 10px;
    }

    .curp-result {
        display: none;
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .curp-result.show {
        display: block;
    }

    #codigo_verificacion_generado {
        display: block;
        text-align: center;
        font-size: 2em;
        user-select: none;
    }
</style>

<label for="codigo_verificacion" id="codigo_verificacion_generado">Código de
    Verificación:</label>
<div class="container mt-3 container-curp">
    <form onsubmit="event.preventDefault(); generarCurp();">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" wire:model="nombre" id="nombre" name="nombre">
            <div class="invalid-feedback" id="nombreError" style="display: none;">Por favor, ingrese el nombre.</div>
        </div>
        <div class="form-group">
            <label for="primer_apellido" class="mt-3">Primer apellido:</label>
            <input type="text" class="form-control" wire:model="primer_apellido" id="primer_apellido"
                   name="primer_apellido">
            <div class="invalid-feedback" id="primerApellidoError" style="display: none;">Por favor, ingrese el
                primer apellido.
            </div>
        </div>
        <div class="form-group">
            <label for="segundo_apellido" class="mt-3">Segundo apellido:</label>
            <input type="text" class="form-control" wire:model="segundo_apellido" id="segundo_apellido"
                   name="segundo_apellido">
            <div class="invalid-feedback" id="segundoApellidoError" style="display: none;">Por favor, ingrese el
                segundo apellido.
            </div>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento" class="mt-3">Fecha de nacimiento: día, mes, año.</label>
            <input type="date" class="form-control" wire:model="fecha_nacimiento" id="fecha_nacimiento"
                   name="fecha_nacimiento">
            <div class="invalid-feedback" id="fechaNacimientoError" style="display: none;">Por favor, ingrese la fecha
                de nacimiento.
            </div>
        </div>
        <div class="form-group">
            <label for="sexo" class="mt-3">Sexo:</label>
            <select class="form-control" wire:model="sexo" id="sexo" name="sexo">
                <option value="" selected>Seleccione</option>
                <option value="M">Mujer</option>
                <option value="H">Hombre</option>
            </select>
            <div class="invalid-feedback" id="sexoError" style="display: none;">Por favor, ingrese el sexo.</div>
        </div>
        <div class="form-group">
            <label for="entidad_nacimiento" class="mt-3">Entidad de Nacimiento:</label>
            <select class="form-control" wire:model="entidad_nacimiento" id="entidad_nacimiento"
                    name="entidad_nacimiento">
                <option value="" selected>Seleccione</option>
                @foreach($entidades as $entidad)
                    <option value="{{ $entidad->codigo }}">{{ $entidad->nombre }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="entidadError" style="display: none;">Por favor, ingrese la entidad de
                nacimiento.
            </div>
        </div>
        <div class="form-group">
            <label for="codigo_verificacion" class="mt-3">Código de
                Verificación:</label>
            <input type="text" class="form-control" id="codigo_verificacion" name="codigo_verificacion"
                   autocomplete="off">
            <div class="invalid-feedback" id="verificacionError" style="display: none;">Por favor, ingrese el código de
                verificación correcto.
            </div>
            <small class="text-muted">Por favor, capture el código de verificación mostrado arriba.</small>
        </div>
        <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-primary">Generar CURP</button>
        </div>
    </form>
    <div class="curp-result" id="curpResult">
        <!-- Aquí se mostrará la CURP generada -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/curp.js') }}"></script>
<script>
    // Función para generar un código de verificación aleatorio
    function generarCodigoVerificacion() {
        var longitud = 6;
        var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var codigo = '';
        for (var i = 0; i < longitud; i++) {
            codigo += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }
        return codigo;
    }

    // Función para mostrar el código de verificación generado
    function mostrarCodigoVerificacion() {
        var codigoVerificacion = generarCodigoVerificacion();
        document.getElementById('codigo_verificacion_generado').textContent = codigoVerificacion;
    }

    // Función para verificar el código de verificación ingresado por el usuario
    function verificarCodigo() {
        var codigoIngresado = document.getElementById('codigo_verificacion').value.trim();
        var codigoGenerado = document.getElementById('codigo_verificacion_generado').textContent.trim();

        if (codigoIngresado === codigoGenerado) {
            document.getElementById('codigo_verificacion').classList.remove('is-invalid');
            document.getElementById('verificacionError').style.display = 'none';
            return true;
        } else {
            document.getElementById('codigo_verificacion').classList.add('is-invalid');
            document.getElementById('verificacionError').style.display = 'block';
        }

        return false;
    }

    function generarCurp() {
        var nombre = document.getElementById('nombre').value.trim();
        var apellidoPaterno = document.getElementById('primer_apellido').value.trim();
        var apellidoMaterno = document.getElementById('segundo_apellido').value.trim();
        var fechaNacimiento = document.getElementById('fecha_nacimiento').value.trim();
        var sexo = document.getElementById('sexo').value.trim();
        var entidadNacimiento = document.getElementById('entidad_nacimiento').value.trim();
        var formularioValido = true; // Variable para verificar si el formulario es válido

        if (nombre === '') {
            document.getElementById('nombre').classList.add('is-invalid');
            document.getElementById('nombreError').style.display = 'block';
            formularioValido = false;
        } else {
            document.getElementById('nombre').classList.remove('is-invalid');
            document.getElementById('nombreError').style.display = 'none';
        }

        if (apellidoPaterno === '') {
            document.getElementById('primer_apellido').classList.add('is-invalid');
            document.getElementById('primerApellidoError').style.display = 'block';
            formularioValido = false;
        } else {
            document.getElementById('primer_apellido').classList.remove('is-invalid');
            document.getElementById('primerApellidoError').style.display = 'none';
        }

        if (apellidoMaterno === '') {
            document.getElementById('segundo_apellido').classList.add('is-invalid');
            document.getElementById('segundoApellidoError').style.display = 'block';
            formularioValido = false;
        } else {
            document.getElementById('segundo_apellido').classList.remove('is-invalid');
            document.getElementById('segundoApellidoError').style.display = 'none';
        }

        if (fechaNacimiento === '') {
            document.getElementById('fecha_nacimiento').classList.add('is-invalid');
            document.getElementById('fechaNacimientoError').style.display = 'block';
            formularioValido = false;
        } else {
            document.getElementById('fecha_nacimiento').classList.remove('is-invalid');
            document.getElementById('fechaNacimientoError').style.display = 'none';
        }

        if (sexo === '') {
            document.getElementById('sexo').classList.add('is-invalid');
            document.getElementById('sexoError').style.display = 'block';
            formularioValido = false;
        } else {
            document.getElementById('sexo').classList.remove('is-invalid');
            document.getElementById('sexoError').style.display = 'none';
        }

        if (entidadNacimiento === '') {
            document.getElementById('entidad_nacimiento').classList.add('is-invalid');
            document.getElementById('entidadError').style.display = 'block';
            formularioValido = false;
        } else {
            document.getElementById('entidad_nacimiento').classList.remove('is-invalid');
            document.getElementById('entidadError').style.display = 'none';
        }

        // Si el formulario no es válido, no continuar con la generación de la CURP
        if (!formularioValido) {
            mostrarCodigoVerificacion();
            return;
        }

        if (verificarCodigo()) {
            // Llama a la función generaCurp() con los datos del formulario
            var curp = generaCurp({
                nombre: nombre,
                apellido_paterno: apellidoPaterno,
                apellido_materno: apellidoMaterno,
                sexo: sexo,
                estado: entidadNacimiento,
                fecha_nacimiento: fechaNacimiento.split('-').reverse().map(Number) // Convierte la fecha en un array [día, mes, año]
            });

            // Mostrar la CURP en un Sweet Alert
            Swal.fire({
                title: 'CURP generada',
                text: curp,
                icon: 'success'
            }).then((result) => {
                // Si el usuario hace clic en OK, limpiar los inputs
                if (result.isConfirmed) {
                    limpiarInputs();
                    mostrarCodigoVerificacion();
                }
            });
        }
    }

    // Función para limpiar todos los inputs
    function limpiarInputs() {
        document.getElementById('nombre').value = '';
        document.getElementById('primer_apellido').value = '';
        document.getElementById('segundo_apellido').value = '';
        document.getElementById('fecha_nacimiento').value = '';
        document.getElementById('sexo').value = '';
        document.getElementById('entidad_nacimiento').value = '';
        document.getElementById('codigo_verificacion').value = '';
    }

    // Llamar a la función para mostrar el código de verificación al cargar la página
    mostrarCodigoVerificacion();
</script>

