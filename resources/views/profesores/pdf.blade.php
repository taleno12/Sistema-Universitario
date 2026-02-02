<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Profesores</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        .bg-title { background-color: #6610f2; color: white; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Reporte de Docentes KT&U</h2>
    <p>Fecha: {{ $fecha }}</p>

    <table>
        <thead>
            <tr class="bg-title">
                <th>FOTO</th>
                <th>CÓDIGO</th>
                <th>NOMBRE COMPLETO</th>
                <th>DNI</th>
                <th>ESPECIALIDAD</th>
                <th>TELÉFONO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesores as $profe)
            <tr>
                <td style="width: 55px;">
                    @php
                        $path = public_path('storage/' . $profe->foto);
                        $imgBase64 = null;
                        if($profe->foto && file_exists($path)) {
                            try {
                                $imgData = base64_encode(file_get_contents($path));
                                $extension = pathinfo($path, PATHINFO_EXTENSION);
                                $imgBase64 = 'data:image/' . $extension . ';base64,' . $imgData;
                            } catch (\Exception $e) { $imgBase64 = null; }
                        }
                    @endphp

                    @if($imgBase64)
                        <img src="{{ $imgBase64 }}" width="40" height="40">
                    @else
                        <span style="font-size: 8px;">Sin Foto</span>
                    @endif
                </td>
                <td>{{ $profe->codigo }}</td>
                <td style="text-align: left;">{{ $profe->nombres }} {{ $profe->apellidos }}</td>
                <td>{{ $profe->dni }}</td>
                <td>{{ $profe->especialidad }}</td>
                <td>{{ $profe->telefono }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>