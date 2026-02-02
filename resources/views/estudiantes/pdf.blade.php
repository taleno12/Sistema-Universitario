<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Estudiantes</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; }
        h2 { text-align: center; text-transform: uppercase; color: #1e293b; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: left; }
        th { background-color: #6610f2; color: white; text-transform: uppercase; font-size: 10px; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .img-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Listado de Estudiantes - KT&U Academy</h2>
    <table>
        <thead>
            <tr>
                <th class="text-center">Foto</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha Nac.</th>
                <th>Facultad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
                <tr>
                    <td class="text-center">
                        @php
                            // Lógica para obtener la imagen en Base64 para DomPDF
                            $path = public_path('storage/' . $estudiante->foto);
                            if ($estudiante->foto && file_exists($path)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            } else {
                                // Imagen por defecto si no tiene foto (opcional)
                                $base64 = null;
                            }
                        @endphp

                        @if($base64)
                            <img src="{{ $base64 }}" class="img-avatar">
                        @else
                            <div style="font-size: 8px; color: #999;">SIN FOTO</div>
                        @endif
                    </td>
                    <td style="font-weight: bold;">{{ $estudiante->nombre }}</td>
                    <td>{{ $estudiante->correo }}</td>
                    <td>{{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $estudiante->facultad->nombre ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 30px; text-align: right; font-size: 9px; color: #64748b;">
        Fecha de generación: {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>