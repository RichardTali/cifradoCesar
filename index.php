<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado de César</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Cifrado de César</h1>
        <form id="cifradoForm" method="post">
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <input type="text" class="form-control" id="mensaje" name="mensaje" required>
            </div>
            <div class="form-group">
                <label for="clave">Clave:</label>
                <input type="text" class="form-control" id="clave" name="clave" required pattern="\d+">
            </div>
            <button type="submit" class="btn btn-primary" name="encriptar">Encriptar</button>
            <button type="submit" class="btn btn-primary" name="desencriptar">Desencriptar</button>
        </form>
        <div id="resultado" class="mt-4">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["encriptar"])) {
                    echo "<p class='alert alert-success'>Mensaje encriptado: " . cifrarCesar($_POST["mensaje"], intval($_POST["clave"])) . "</p>";
                } elseif (isset($_POST["desencriptar"])) {
                    echo "<p class='alert alert-success'>Mensaje desencriptado: " . cifrarCesar($_POST["mensaje"], -intval($_POST["clave"])) . "</p>";
                }
            }

            function cifrarCesar($mensaje, $clave)
            {
                $resultado = '';
                $longitud = mb_strlen($mensaje);
                $alfabeto = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';

                for ($i = 0; $i < $longitud; $i++) {
                    $caracter = mb_strtoupper(mb_substr($mensaje, $i, 1));
                    $posicion = mb_strpos($alfabeto, $caracter);

                    if ($posicion === false) {
                        
                        $resultado .= $caracter;
                        continue;
                    }

                    $nuevaPosicion = ($posicion + $clave) % 27;

                    if ($nuevaPosicion < 0) {
                        $nuevaPosicion += 27;
                    }

                    $nuevoCaracter = mb_substr($alfabeto, $nuevaPosicion, 1);
                    $resultado .= $nuevoCaracter;
                }

                return $resultado;
            }
            ?>
        </div>
    </div>

   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
