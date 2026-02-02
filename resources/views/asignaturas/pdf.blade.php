<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plan de Estudios - KT&U</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #6610f2; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 22px; font-weight: bold; color: #6610f2; }
        .subtitle { font-size: 14px; color: #555; margin-top: 5px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #6610f2; color: white; padding: 10px; text-align: left; font-size: 11px; text-transform: uppercase; }
        td { padding: 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 5px; }
        .page-number:before { content: "Página " counter(page); }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">KT&U UNIVERSITARIO</div>
        <div class="subtitle">Reporte Oficial de Asignaturas y Plan de Estudios</div>
    </div>

    <div style="font-size: 12px; margin-bottom: 10px;">
        <strong>Fecha de emisión:</strong> {{ date('d/m/Y H:i A') }} <br>
        <strong>Total de registros:</strong> {{ $asignaturas->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 40%;">Asignatura</th>
                <th style="width: 35%;">Carrera</th>
                <th style="width: 15%;" class="text-center">Créditos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaturas as $asignatura)
            <tr>
                <td>#{{ str_pad($asignatura->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td class="font-bold">{{ $asignatura->nombre }}</td>
                <td>{{ $asignatura->carrera->nombre ?? 'N/A' }}</td>
                <td class="text-center">{{ $asignatura->creditos }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        © {{ date('Y') }} KT&U - Sistema de Gestión Académica | <span class="page-number"></span>
    </div>
</body>
</html>