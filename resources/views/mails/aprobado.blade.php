@extends('mails.layout.layout')

@section('contenido')
    <p
        style="Margin:0;margin-top:10px;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:1.3em;color:#2D3142;font-size:16px;margin-bottom:20px; text-align: center;">
        Tu negocio ha sido APROBADO
    </p>
    <h3
        style="Margin:0;line-height:34px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#2D3142; text-align: center;font-size:25px;">
        <strong>{{ $data->nombre }}</strong>
    </h3>
    <p
        style="Margin:0;margin-top:10px;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:24px;color:#2D3142;font-size:14px; text-align: center;">
        <span style="margin-bottom: 10px;">Tu negocio ya esta disponible en Directorio Dulce Halloween para recibir muchas
            visitas. Ya
            no puedes hacer cambios en el mismo, en su caso puedes comunicarte con
            nosotros.</span>

    </p>
@endsection

@section('boton')
    <a target="_blank"
        style="text-decoration:none;color:#ffffff;font-size:22px;padding:15px 20px 15px 20px;display:block;background:#BC2B2BFF;border-radius:10px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:bold;font-style:normal;line-height:26px;width:auto;text-align:center;mso-hide:all;padding-left:5px;padding-right:5px;border-color:#BC2B2BFF;width:100%"
        href="{{ route('negocio', $data->slug) }}">
        Ver Página de Negocio
    </a>
@endsection

@section('mensaje', 'Te sugerimos revisar tu información y si hay algun error comuncarte con nosotros.')
