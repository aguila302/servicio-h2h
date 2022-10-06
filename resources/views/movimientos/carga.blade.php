@extends('base')
@section('page-title', 'Carga de movimientos')

@push('css-lib')

<link rel="stylesheet" href="{{ asset('css/misc/panel.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')

<div class="container-fluid">

    {{-- {% if error_carga %}
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 22px;">&times;</span></button>
        <strong>Error en la Carga: </strong> {{ error_carga|e }}
    </div>
    {% endif %}

    {% if error_aplicacion %}
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 22px;">&times;</span></button>
        <strong>Error en la Aplicación de Pagos: </strong> {{ error_aplicacion|e }}
    </div>
    {% endif %} --}}

    <div class="row">

        <div class="col-md-6 col-sm-12">

            <div class="panel panel-default">

                <div class="panel-heading" style="display: flex; justify-content: space-between;">
                    <h3 class="panel-title">Carga de Movimientos Bancarios</h3>
                    <img id="loader-movimientos" width="20" height="20" src="https://acegif.com/wp-content/uploads/loading-12.gif" style="display:none;">
                </div>

                <form class="form-horizontal" id="formLayoutMov" name="formLayoutMov" style="margin-bottom: 0px;"
                    method="post" enctype="multipart/form-data" action="/EstadoDeCuentaBancario">

                    <!-- ACCION CONTROLLER -->
                    <input type="hidden" name="accion" value="guardar">
                    <input type="hidden" name="bloque" value="concentrado">

                    <div class="panel-body py-3" style="padding-bottom: 0px;">

                        <!-- ELEMENTS FORM -->

                        <div class="form-group mb-3 row justify-content-center">
                            <label class="control-label col-md-3">Banco</label>
                            <div class="col-md-8">
                                <select class="form-control" id="banco_select" name="banco">
                                    <option value="banorte">Banorte</option>
                                    <option value="citibanamex">Citibanamex</option>
                                    <option value="bbva">BBVA (Bancomer)</option>
                                    <option value="general">CIBanco o Sabadell</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="control-label col-md-3">Layout de Movimientos</label>
                            <div class="col-md-8">
                                <input class="form-control" type="file" id="layout_movimientos" name="layout_movimientos" />
                            </div>
                        </div>

                        {{-- {% if (process) and (not es_archivo_cargado) and (not es_detalle) and (es_original)%}

                            <div class="row alert alert-info text-center" role="info">
                                <p><b>{{ archivo|e }}</b></p>
                                <p>Lineas en el archivo</p>
                                <p><b>{{TotalLinea|number_format(0, '.', ',')}}</b></p>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        Procesadas<br>
                                        <b>{{lineasProcesadas|number_format(0, '.', ',')}}</b>
                                    </div>
                                    <div class="col-md-6">
                                        Omitidas<br>
                                        <b>{{lineasNoProcesadas|number_format(0, '.', ',')}}</b>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        Guardadas<br>
                                        <b>{{cargados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#DetalleProcesos" role="button" aria-expanded="false" aria-controls="DetalleProcesos">ver detalle</a>
                                    </div>
                                    <div class="col-md-4">
                                        Over Night<br>
                                        <b>{{overnights|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-warning btn-sm" data-toggle="collapse" href="#DetalleONight" role="button" aria-expanded="false" aria-controls="DetalleONight">ver detalle</a>
                                    </div>
                                    <div class="col-md-4">
                                        Duplicadas/Omitidas<br>
                                        <b>{{lineasNoProcesadas|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-danger btn-sm" data-toggle="collapse" href="#DetalleNOProcesos" role="button" aria-expanded="false" aria-controls="DetalleNOProcesos">ver detalle</a>
                                    </div>
                                </div>
                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-success row" id="DetalleProcesos" role="info">
                                        <ul class="list-group">
                                            {% for lineas in Process %}
                                                <li class="list-group-item">Linea: <b>{{ lineas.Linea|e }}</b><br>Dato:<br><b>{{ lineas.datos|e }}</b><br>motivo:<br><b>{{ lineas.razon|e }}</b></li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-warning row" id="DetalleONight" role="info">
                                        <ul class="list-group">
                                            {% for on in OverNight %}
                                                <li class="list-group-item">Linea: <b>{{ on.Linea|e }}</b><br>Dato:<br><b>{{ on.datos|e }}</b><br>motivo:<br><b>{{ on.razon|e }}</b></li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-warning row" id="DetalleWarnings" role="info">
                                        <ul class="list-group">
                                            {% for on in warnings %}
                                                <li class="list-group-item">Linea: <b>{{ on.linea_csv|e }}</b><br>Dato:<br><b>{{ on.contenido|e }}</b><br>Motivo:<br><b>{{ on.motivo|e }}</b></li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-danger" id="DetalleNOProcesos">
                                        <ul class="list-group">
                                            {% for lines in NoProcess %}
                                                <li class="list-group-item">Linea: <b>{{ lines.Linea|e }}</b><br>Dato:<br><b>{{ lines.datos|e }}</b><br>motivo:<br><b>{{ lines.razon|e }}</b></li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        {% endif %}

                        {% if (es_archivo_cargado) and (not es_detalle) and (not es_original)%}
                            <div class="row alert bg-info text-center" role="info" style="margin-bottom: 0px">

                                <div class="col-md-12" style="margin-top: 20px">

                                    <div class="col-md-6">
                                        Archivo<br>
                                        <b>{{ nombre_archivo|e }}</b>
                                    </div>

                                    <div class="col-md-6">
                                        Total movimientos<br>
                                        <b>{{ total_movimientos|number_format(0, '.', ',') }}</b>
                                    </div>

                                </div>

                                <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">

                                    <div class="col-md-2">
                                        Guardados<br>
                                        <b>{{total_guardados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#DetalleGuardados" role="button" aria-expanded="false" aria-controls="DetalleGuardados">ver detalle</a>
                                    </div>

                                    <div class="col-md-2">
                                        Identificados<br>
                                        <b>{{total_identificados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#DetalleIdentificados" role="button" aria-expanded="false" aria-controls="DetalleIdentificados">ver detalle</a>
                                    </div>

                                    <div class="col-md-2">
                                        No Identificados<br>
                                        <b>{{total_no_identificados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-warning btn-sm" data-toggle="collapse" href="#DetalleNoIdentificados" role="button" aria-expanded="false" aria-controls="DetalleIdentificados">ver detalle</a>
                                    </div>

                                    <div class="col-md-2">
                                        Advertencias<br>
                                        <b>{{total_advertencias|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-warning btn-sm" data-toggle="collapse" href="#DetalleAdvertencias" role="button" aria-expanded="false" aria-controls="DetalleAdvertencias">ver detalle</a>
                                    </div>

                                    <div class="col-md-2">
                                        Duplicados<br>
                                        <b>{{total_duplicados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#DetalleDuplicados" role="button" aria-expanded="false" aria-controls="DetalleDuplicados">ver detalle</a>
                                    </div>

                                    <div class="col-md-2">
                                        Errores<br>
                                        <b>{{total_errores|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-danger btn-sm" data-toggle="collapse" href="#DetalleErrores" role="button" aria-expanded="false" aria-controls="DetalleErrores">ver detalle</a>
                                    </div>

                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-success row" id="DetalleGuardados" role="info">
                                        <ul class="list-group">
                                            {% for item in guardados %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-danger row" id="DetalleErrores" role="info">
                                        <ul class="list-group">
                                            {% for item in errores %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-warning row" id="DetalleNoIdentificados" role="info">
                                        <ul class="list-group">
                                            {% for item in no_identificados %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-warning row" id="DetalleAdvertencias" role="info">
                                        <ul class="list-group">
                                            {% for item in advertencias %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-info row" id="DetalleIdentificados" role="info">
                                        <ul class="list-group">
                                            {% for item in identificados %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                    {% if item.tipo != "" %}
                                                        <br>
                                                        Tipo:<br><b>{{ item.tipo|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-info" id="DetalleDuplicados">
                                        <ul class="list-group">
                                            {% for item in duplicados %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            {% if (total_aplicados > 0) or (total_omitidos_aplicacion > 0) %}
                                <div class="row alert bg-info text-center" role="info" style="margin-bottom: 0px">

                                    <div class="col-md-12">

                                        <strong>Aplicación de pagos</strong>

                                    </div>

                                    <div class="col-md-12" style="display: flex; margin-top: 20px; margin-bottom: 20px; text-align: center;">

                                        <div class="col-md-6">
                                            Aplicados<br>
                                            <b>{{total_aplicados|number_format(0, '.', ',')}}</b><br>
                                            <a class="btn btn-success btn-sm" data-toggle="collapse" href="#DetalleAplicados" role="button" aria-expanded="false" aria-controls="DetalleAplicados">ver detalle</a>
                                        </div>

                                        <div class="col-md-6">
                                            Omitidos<br>
                                            <b>{{total_omitidos_aplicacion|number_format(0, '.', ',')}}</b><br>
                                            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#DetalleOmitidosAplicacion" role="button" aria-expanded="false" aria-controls="DetalleOmitidosAplicacion">ver detalle</a>
                                        </div>

                                    </div>

                                    <div class="col-md-12 text-left">
                                        <div class="collapse alert alert-success row" id="DetalleAplicados" role="info">
                                            <ul class="list-group">
                                                {% for item in aplicados %}
                                                    <li class="list-group-item" style="overflow-wrap: break-word;">
                                                        Línea: <b>{{ item.linea|e }}</b>
                                                        <br>
                                                        Dato:<br><b>{{ item.datos|e }}</b>
                                                        {% if item.nota != "" %}
                                                            <br>
                                                            Nota:<br><b>{{ item.nota|e }}</b>
                                                        {% endif %}
                                                    </li>
                                                {% endfor %}
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-left">
                                        <div class="collapse alert alert-danger row" id="DetalleOmitidosAplicacion" role="info">
                                            <ul class="list-group">
                                                {% for item in omitidos_aplicacion %}
                                                    <li class="list-group-item" style="overflow-wrap: break-word;">
                                                        Línea: <b>{{ item.linea|e }}</b>
                                                        <br>
                                                        Dato:<br><b>{{ item.datos|e }}</b>
                                                        {% if item.nota != "" %}
                                                            <br>
                                                            Nota:<br><b>{{ item.nota|e }}</b>
                                                        {% endif %}
                                                    </li>
                                                {% endfor %}
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            {% endif %}
                        {% endif %} --}}


                    </div>

                    <div class="panel-footer text-center">
                        <button class="btn btn-primary" type="submit" id="btn_action_movimientos">
                            Cargar
                        </button>
                    </div>

                </form>

            </div>


            <div class="panel panel-default">


                <div class="panel-heading" style="display: flex; justify-content: space-between;">
                    <h3 class="panel-title">Carga de detalle de movimientos bancarios</h3>
                    <img id="loader-detalle" width="20" height="20" src="https://acegif.com/wp-content/uploads/loading-12.gif" style="display:none;">
                </div>

                <form class="form-horizontal" id="formDetalle" name="formDetalle" style="margin-bottom: 0px;"
                    method="post" enctype="multipart/form-data" action="/EstadoDeCuentaBancario">

                    <!-- ACCION CONTROLLER -->
                    <input type="hidden" name="accion" value="guardar">
                    <input type="hidden" name="bloque" value="detalle">

                    <div class="panel-body py-3" style="padding-bottom: 0px;">

                        <!-- ELEMENTS FORM -->

                        <div class="form-group mb-3 row justify-content-center">
                            <label class="control-label col-md-3">Banco</label>
                            <div class="col-md-8">
                                <select class="form-control" id="banco" name="banco">
                                    <option value="banorte">Banorte</option>
                                    <option value="bbva-netcash-24x7">BBVA Netcash 24x7</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label class="control-label col-md-3">Layout Detalle de Movimientos</label>
                            <div class="col-md-8">
                                <input class="form-control" type="file" id="layout_detalle" name="layout_movimientos" />
                            </div>
                        </div>

                        {{-- {% if (es_archivo_cargado) and (es_detalle) %}
                            <div class="row alert bg-info text-center" role="info" style="margin-bottom: 0px">

                                <div class="col-md-12" style="margin-top: 20px">

                                    <div class="col-md-6">
                                        Archivo<br>
                                        <b>{{ nombre_archivo|e }}</b>
                                    </div>

                                    <div class="col-md-6">
                                        Total movimientos<br>
                                        <b>{{ total_movimientos|number_format(0, '.', ',') }}</b>
                                    </div>

                                </div>

                                <div class="col-md-12" style="display: flex; margin-top: 20px; margin-bottom: 20px; text-align: center;">

                                    <div class="col-md-4">
                                        Guardados<br>
                                        <b>{{total_guardados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#DetalleGuardados" role="button" aria-expanded="false" aria-controls="DetalleGuardados">ver detalle</a>
                                    </div>

                                    <div class="col-md-4">
                                        Identificados<br>
                                        <b>{{total_identificados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#DetalleIdentificados" role="button" aria-expanded="false" aria-controls="DetalleIdentificados">ver detalle</a>
                                    </div>

                                    <div class="col-md-4">
                                        Advertencias<br>
                                        <b>{{total_advertencias|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-warning btn-sm" data-toggle="collapse" href="#DetalleAdvertencias" role="button" aria-expanded="false" aria-controls="DetalleAdvertencias">ver detalle</a>
                                    </div>

                                    <div class="col-md-4">
                                        Duplicados<br>
                                        <b>{{total_duplicados|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#DetalleDuplicados" role="button" aria-expanded="false" aria-controls="DetalleDuplicados">ver detalle</a>
                                    </div>

                                    <div class="col-md-4">
                                        Errores<br>
                                        <b>{{total_errores|number_format(0, '.', ',')}}</b><br>
                                        <a class="btn btn-danger btn-sm" data-toggle="collapse" href="#DetalleErrores" role="button" aria-expanded="false" aria-controls="DetalleErrores">ver detalle</a>
                                    </div>

                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-success row" id="DetalleGuardados" role="info">
                                        <ul class="list-group">
                                            {% for item in guardados %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-danger row" id="DetalleErrores" role="info">
                                        <ul class="list-group">
                                            {% for item in errores %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-warning row" id="DetalleAdvertencias" role="info">
                                        <ul class="list-group">
                                            {% for item in advertencias %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-info row" id="DetalleIdentificados" role="info">
                                        <ul class="list-group">
                                            {% for item in identificados %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                    {% if item.tipo != "" %}
                                                        <br>
                                                        Tipo:<br><b>{{ item.tipo|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <div class="collapse alert alert-info" id="DetalleDuplicados">
                                        <ul class="list-group">
                                            {% for item in duplicados %}
                                                <li class="list-group-item" style="overflow-wrap: break-word;">
                                                    Línea: <b>{{ item.linea|e }}</b>
                                                    <br>
                                                    Dato:<br><b>{{ item.datos|e }}</b>
                                                    {% if item.nota != "" %}
                                                        <br>
                                                        Nota:<br><b>{{ item.nota|e }}</b>
                                                    {% endif %}
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            {% if (total_aplicados > 0) or (total_omitidos_aplicacion > 0) %}
                                <div class="row alert bg-info text-center" role="info" style="margin-bottom: 0px">

                                    <div class="col-md-12">

                                        <strong>Aplicación de pagos</strong>

                                    </div>

                                    <div class="col-md-12" style="display: flex; margin-top: 20px; margin-bottom: 20px; text-align: center;">

                                        <div class="col-md-6">
                                            Aplicados<br>
                                            <b>{{total_aplicados|number_format(0, '.', ',')}}</b><br>
                                            <a class="btn btn-success btn-sm" data-toggle="collapse" href="#DetalleAplicados" role="button" aria-expanded="false" aria-controls="DetalleAplicados">ver detalle</a>
                                        </div>

                                        <div class="col-md-6">
                                            Omitidos<br>
                                            <b>{{total_omitidos_aplicacion|number_format(0, '.', ',')}}</b><br>
                                            <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#DetalleOmitidosAplicacion" role="button" aria-expanded="false" aria-controls="DetalleOmitidosAplicacion">ver detalle</a>
                                        </div>

                                    </div>

                                    <div class="col-md-12 text-left">
                                        <div class="collapse alert alert-success row" id="DetalleAplicados" role="info">
                                            <ul class="list-group">
                                                {% for item in aplicados %}
                                                    <li class="list-group-item" style="overflow-wrap: break-word;">
                                                        Línea: <b>{{ item.linea|e }}</b>
                                                        <br>
                                                        Dato:<br><b>{{ item.datos|e }}</b>
                                                        {% if item.nota != "" %}
                                                            <br>
                                                            Nota:<br><b>{{ item.nota|e }}</b>
                                                        {% endif %}
                                                    </li>
                                                {% endfor %}
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-left">
                                        <div class="collapse alert alert-danger row" id="DetalleOmitidosAplicacion" role="info">
                                            <ul class="list-group">
                                                {% for item in omitidos_aplicacion %}
                                                    <li class="list-group-item" style="overflow-wrap: break-word;">
                                                        Línea: <b>{{ item.linea|e }}</b>
                                                        <br>
                                                        Dato:<br><b>{{ item.datos|e }}</b>
                                                        {% if item.nota != "" %}
                                                            <br>
                                                            Nota:<br><b>{{ item.nota|e }}</b>
                                                        {% endif %}
                                                    </li>
                                                {% endfor %}
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            {% endif %}
                        {% endif %} --}}


                    </div>

                    <div class="panel-footer text-center">
                        <button class="btn btn-primary" type="submit" id="btn_action_detalle_movimientos">
                            Cargar
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection
