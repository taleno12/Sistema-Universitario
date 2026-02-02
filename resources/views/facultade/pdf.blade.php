<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Facultades</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        header { text-align: center; margin-bottom: 20px; }
        h2 { margin: 0; font-size: 18px; }
        p.fecha { font-size: 11px; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <header>
        <h2>Universidad Central de Nicaragua</h2>
        <p class="fecha">Listado generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </header>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre de la Facultad</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facultades as $index => $facultad)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $facultad->nombre }}</td>
                    <td>{{ $facultad->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
