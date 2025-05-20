<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de transacciones</title>
    <style>
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de transacciones</h1>
        <table>
            <thead>
                <tr>
                    <th>ID de usuario</th>
                    <th>Descripcion</th>
                    <th>Monto</th>
                    <th>Fecha de transaccion</th>
                    <th>Creado en</th>
                    <th>Actualizado en</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datos as $dato): ?>
                <tr>
                    <td><?= $dato['user_id'] ?></td>
                    <td><?= $dato['description'] ?></td>
                    <td><?= $dato['amount'] ?></td>
                    <td><?= $dato['transaction_date'] ?></td>
                    <td><?= $dato['created_at'] ?></td>
                    <td><?= $dato['updated_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        // Se ejecuta el codigo JS solamente cuando haya cargado la pagina y todos los elementos del DOM
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Cargo la pagina");
        });
    </script>
</body>
</html>