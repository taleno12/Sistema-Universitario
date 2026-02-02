<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte General de Matrículas</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        .title { font-size: 20px; font-weight: bold; color: #4f46e5; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #4f46e5; color: white; padding: 10px; text-transform: uppercase; font-size: 10px; }
        td { border-bottom: 1px solid #eee; padding: 10px; text-align: center; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Control de Matrículas - KT&U</div>
        <div>Reporte General de Estudiantes Inscritos</div>
        <small>Fecha de generación: {{ $fecha }}</small>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Asignatura</th>
                <th>Carrera</th>
                <th>Periodo</th>
                <th>Fecha Reg.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matriculas as $matricula)
            <tr>
                <td>#{{ str_pad($matricula->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $matricula->estudiante->nombre }} {{ $matricula->estudiante->apellido }}</td>
                <td>{{ $matricula->asignatura->nombre }}</td>
                <td>{{ $matricula->carrera->nombre ?? 'N/A' }}</td>
                <td>{{ $matricula->periodo }}</td>
                <td>{{ $matricula->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Página generada por el Sistema de Gestión KT&U
    </div>
</body>
</html>