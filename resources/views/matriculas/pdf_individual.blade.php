<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Matrícula #{{ $matricula->id }}</title>
    <style>
        @page { margin: 2cm; }
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        .logo-text { font-size: 24px; font-weight: bold; color: #4f46e5; margin: 0; }
        .subtitle { font-size: 14px; color: #666; text-transform: uppercase; letter-spacing: 1px; }
        
        .content { margin-top: 20px; }
        .title { text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 25px; text-decoration: underline; }
        
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .info-table td { padding: 10px; border-bottom: 1px solid #eee; }
        .label { font-weight: bold; color: #4f46e5; width: 35%; }
        
        .footer { margin-top: 50px; text-align: center; font-size: 11px; color: #777; }
        .signature-box { margin-top: 60px; text-align: center; }
        .line { border-top: 1px solid #333; width: 200px; margin: 0 auto 5px auto; }
    </style>
</head>
<body>
    <div class="header">
        <p class="logo-text">KT&U - Sistema Académico</p>
        <p class="subtitle">Comprobante Oficial de Matrícula</p>
    </div>

    <div class="content">
        <div class="title">DATOS DE LA INSCRIPCIÓN</div>

        <table class="info-table">
            <tr>
                <td class="label">Número de Matrícula:</td>
                <td><strong>#{{ str_pad($matricula->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Fecha de Registro:</td>
                <td>{{ $matricula->created_at->format('d/m/Y h:i A') }}</td>
            </tr>
            <tr>
                <td class="label">Estudiante:</td>
                <td>{{ strtoupper($matricula->estudiante->nombre) }} {{ strtoupper($matricula->estudiante->apellido) }}</td>
            </tr>
            <tr>
                <td class="label">Carrera:</td>
                <td>{{ $matricula->carrera->nombre ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Asignatura:</td>
                <td>{{ $matricula->asignatura->nombre }}</td>
            </tr>
            <tr>
                <td class="label">Periodo Lectivo:</td>
                <td>{{ $matricula->periodo }}</td>
            </tr>
        </table>

        <div style="background-color: #f8fafc; padding: 15px; border-radius: 5px; font-size: 12px; border: 1px solid #e2e8f0;">
            <strong>Nota Importante:</strong> Este documento certifica que el estudiante se encuentra debidamente inscrito en la asignatura mencionada para el periodo vigente. Cualquier alteración de este documento anula su validez legal ante la institución.
        </div>
    </div>

    <div class="signature-box">
        <div class="line"></div>
        <p>Sello y Firma Autorizada<br>Registro Académico KT&U</p>
    </div>

    <div class="footer">
        Documento generado automáticamente por el sistema el {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>