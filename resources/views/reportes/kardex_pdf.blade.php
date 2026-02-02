<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kardex - {{ $estudiante->nombre }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #6610f2; padding-bottom: 10px; }
        .logo-text { font-size: 20px; font-weight: bold; color: #6610f2; }
        .info-table { width: 100%; margin-bottom: 20px; background: #f8f9fa; padding: 10px; }
        
        table.data { width: 100%; border-collapse: collapse; }
        table.data th { background: #6610f2; color: white; padding: 8px; text-align: left; }
        table.data td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        
        .resumen { float: right; width: 200px; margin-top: 20px; border: 1px solid #6610f2; padding: 10px; }
        .text-left { text-align: left !important; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 9px; color: #aaa; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-text">KT&U ACADEMY</div>
        <div>Expediente Académico</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="20%"><strong>ESTUDIANTE:</strong></td>
            <td width="50%">{{ strtoupper($estudiante->nombre) }}</td>
            <td width="15%"><strong>ID:</strong></td>
            <td width="15%">{{ $estudiante->id }}</td>
        </tr>
        <tr>
            <td><strong>FACULTAD:</strong></td>
            <td>{{ $estudiante->facultad->nombre ?? 'N/A' }}</td>
            <td><strong>FECHA:</strong></td>
            <td>{{ date('d/m/Y') }}</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th class="text-left">ASIGNATURA</th>
                <th>PARCIAL</th>
                <th>FINAL</th>
                <th>TOTAL</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPromedio = 0; $conteo = 0; @endphp
            @foreach($estudiante->calificaciones as $nota)
                @php 
                    $suma = $nota->nota_parcial + $nota->nota_final; 
                    $totalPromedio += $suma;
                    $conteo++;
                @endphp
                <tr>
                    <td class="text-left">{{ $nota->matricula->asignatura->nombre ?? 'N/A' }}</td>
                    <td>{{ number_format($nota->nota_parcial, 0) }}</td>
                    <td>{{ number_format($nota->nota_final, 0) }}</td>
                    <td><strong>{{ number_format($suma, 0) }}</strong></td>
                    <td>
                        @if($suma >= 60)
                            <span style="color: green; font-weight: bold;">APROBADO</span>
                        @else
                            <span style="color: red; font-weight: bold;">REPROBADO</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="resumen">
        <strong>PROMEDIO: </strong> 
        <span style="font-size: 14px; color: #6610f2;">
            {{ $conteo > 0 ? number_format($totalPromedio / $conteo, 2) : '0.00' }}%
        </span>
    </div>

    <div class="footer">
        Documento generado por el Sistema de Gestión KT&U Academy.
    </div>
</body>
</html>