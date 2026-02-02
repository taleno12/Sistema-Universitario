<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Carreras - KT&U</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; margin: 30px; }
        .header { text-align: center; border-bottom: 2px solid #6610f2; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; color: #6610f2; text-transform: uppercase; }
        .subtitle { font-size: 14px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #6610f2; color: white; padding: 10px; text-align: left; font-size: 12px; text-transform: uppercase; }
        td { padding: 10px; border-bottom: 1px solid #eee; font-size: 12px; }
        .badge { background-color: #f0f0f0; padding: 4px 8px; border-radius: 10px; font-size: 10px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #aaa; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">KT&U Universitario</div>
        <div class="subtitle">Reporte Oficial de Carreras Profesionales</div>
    </div>

    <p style="font-size: 12px;"><strong>Fecha de generación:</strong> {{ date('d/m/Y H:i A') }}</p>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 45%;">Nombre de la Carrera</th>
                <th style="width: 45%;">Facultad Perteneciente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carreras as $carrera)
            <tr>
                <td>#{{ str_pad($carrera->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td><strong>{{ $carrera->nombre }}</strong></td>
                <td>{{ $carrera->facultade->nombre ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        © {{ date('Y') }} KT&U Universitario - Sistema de Gestión Académica.
    </div>
</body>
</html>