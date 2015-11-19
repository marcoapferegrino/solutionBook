@extends('app')
@section('styles')
    <link href="{{ asset('/css/jquery.keypad.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h3>Agregar Problema</h3></div>

                    <div class="panel-body">
                        @include('partials.messages')
                        {!! Form::model(Request::all(),[
                        'route' => 'problem.addProblem',
                        'method' => 'post',
                        'class'=>'form-horizontal',
                        'id'=>'',
                        'files'=>true]) !!}
                        <div class="form-group">
                            <h4><label for="titulo" class="col-sm-2 control-label"><strong>Título *</strong></label></h4>
                            <div class="col-sm-6">
                                {!!Form::text('title','',['class'=>'form-control','id'=>'title'])!!}
                                <!-- {!!Form::text('titulo', '',['class'=>'form-control titulo','id'=>'buscar'])!!} -->
                                <div id="similarTitle"></div>
                            </div>

                        </div>

                        <div class="form-group">
                            <h4><label for="titulo" class="col-sm-2 control-label"><strong>Institución</strong></label></h4>
                            <div class="col-sm-6">
                                {!!Form::text('institucion','',['class'=>'form-control'])!!}
                                <!-- {!!Form::text('titulo', '',['class'=>'form-control titulo','id'=>'buscar'])!!} -->
                            </div>

                        </div>

                        <div class="form-group">
                            <h4><label for="descripcion" class="col-sm-2 control-label"><strong>Descripción *</strong></label></h4>
                            <div class="col-sm-8">
                                {!!Form::textArea('descripcion', '',['class'=>'form-control keypad','id'=>'description','placeholder'=>'Descripción del problema'])!!}
                            </div>

                        </div>

                        <div class="form-group">
                            <h4><label for="limitTime" class="col-sm-2 control-label"><strong>Limite de tiempo </strong></label></h4>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    {!!Form::text('limitTime','0',['class'=>'form-control','placeholder'=>'segundos (Dejar este campo vacio significará: sin límite de tiempo)'])!!}
                                    <div class="input-group-addon">segs</div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <h4><label for="limitMemory" class="col-sm-2 control-label"><strong>Limite de Memoria *</strong></label></h4>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    {!!Form::text('limitMemory','',['class'=>'form-control','placeholder'=>'kilo bytes'])!!}
                                    <div class="input-group-addon">kb</div>
                                </div>
                            </div>

                        </div>


                        <div class="form-group">
                            <h4><label for="judgeList" class="col-sm-2 control-label"><strong>Juez en Línea</strong></label></h4>
                            <div class="col-sm-6">
                                <select class="form-control" name="judgeList" id="judges">
                                    <option value='#'></option>
                                    @foreach($judgeList as $j)
                                        <option value="{{$j->id}}">{{$j->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="col-sm-1 ">
                                    <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addJudge">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button>
                                </div>
                        </div>
                        <div class="form-group" >
                            <div class="row">
                                <h3><label for="input" class="col-sm-10 col-sm-offset-1 label label-info"><strong><center>Ejemplos</center></strong></label></h3>
                            </div>
                            <h4><label for="EjemploEntrada" class="col-sm-2 control-label"><strong>Ejemplo entrada *</strong></label></h4>
                            <div class="col-sm-4">
                                <textarea rows=8  name="ejemploen" class="form-control" ></textarea>
                            </div>
                            <h4><label for="output" class="col-sm-1 control-label"><strong>Ejemplo salida *</strong></label></h4>
                            <div class="col-sm-4">
                                <textarea rows=8 name="ejemplosa" class="form-control" ></textarea>
                            </div>
                            {{--<div class="col-sm-1 ">
                                <button type="button" class="btn btn-primary btn-lg ">
                                    <a href="#" onclick="agregar();">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                </button>
                            </div>--}}
                        </div>
                        <div id="emails">
                            <div class="form-group" >
                                <div class="row">
                                    <h3><label for="input" class="col-sm-10 col-sm-offset-1 label label-info"><strong><center>Casos de prueba</center></strong></label></h3>
                                </div>
                                <h4><label for="input" class="col-sm-2 control-label"><strong>Entrada *</strong></label></h4>
                                <div class="col-sm-4">
                                    <textarea rows=8 id='textarea'  name="inputs" class="form-control" ></textarea>
                                </div>
                                <h4><label for="output" class="col-sm-1 control-label"><strong>Salida *</strong></label></h4>
                                <div class="col-sm-4">
                                    <textarea rows=8 name="outputs" class="form-control" ></textarea>
                                </div>
                                {{--<div class="col-sm-1 ">
                                    <button type="button" class="btn btn-primary btn-lg ">
                                        <a href="#" onclick="agregar();">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </a>
                                    </button>
                                </div>--}}
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="tags" class="col-sm-7 control-label" ><strong>Permitir a usuarios descargar archivos de casos de prueba</strong></label>
                            <div class="col-sm-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="share" value="yes"> Aceptar
                                </label>
                            </div>
                        </div>
                        <br>

                        <div class="form-group" >
                            <h4><label for="tags" class="col-sm-2 control-label" ><strong>Palabras clave *</strong></label></h4>
                            <div class="col-sm-6">
                                {!!Form::text('tags','',['class'=>'form-control','id'=>'tags','placeholder'=>'Etiquetas (p. ej.: arboles binarios, estructuras de datos, recursividad)'])!!}
                                <div id="similarTags"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h4><label for="youtube" class="col-sm-2 control-label"><strong>Youtube</strong></label></h4>
                            <div class="col-sm-6">
                                {!!Form::text('youtube','',['class'=>'form-control'])!!}
                            </div>

                        </div>

                        <div class="form-group">
                            <h4><label for="github" class="col-sm-2 control-label"><strong>Github</strong></label></h4>
                            <div class="col-sm-6">
                                {!!Form::text('github','',['class'=>'form-control'])!!}
                            </div>

                        </div>


                        <div class="form-group">
                            <h4><label for="images" class="col-sm-2 control-label"><strong>Archivos de apoyo</strong></label></h4>
                            <div class="col-sm-6">
                                <input type="file"  name="images[]" class="btn btn-info" id="images" multiple>
                            </div>

                        </div>

                        <div class="form-group">
                            <h4><label for="submit" class="col-sm-5 control-label"><strong></strong></label></h4>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info btn-lg btn-block" id="submit-all">Guardar</button>
                            </div>

                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(['route' => ['problem.similarProblems',':TEXT'],'method' => 'post','id'=>'form-titulo']) !!}
    {!! Form::close() !!}
    {!! Form::open(['route' => ['problem.similarTags',':TEXT'],'method' => 'post','id'=>'form-tag']) !!}
    {!! Form::close() !!}

    @include('problem.formJudge')

@endsection
@section('scripts')

    <script src="{{ asset('/js/similarTitle.js') }}"></script>
    <script src="{{ asset('/js/similarTags.js') }}"></script>

    <script src="{{ asset('/js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('/js/jquery.keypad.js') }}"></script>
    <script src="{{ asset('/js/keyMapOurs.js') }}"></script>

    <script type="text/javascript">
        function agregar() {
            campo = '<div class="form-group"><div class="col-sm-1"></div>                                <label for="descripcion" class="col-sm-1 control-label"><strong>Ejemplo entrada</strong></label>                                <div class="col-sm-4">                                     <textarea rows=8 name="inputs[]"  class="form-control" ></textarea>                         </div>   <label for="descripcion" class="col-sm-1 control-label"><strong>Ejemplo salida</strong></label>                                <div class="col-sm-4">                                     <textarea rows=8  name="outputs[]" class="form-control" ></textarea>        </div></div>';
            $("#emails").append(campo);
        }
    </script>
    <script type="text/javascript">

        $("#textarea")
                .bind("dragover", false)
                .bind("dragenter", false)
                .bind("drop", function(e) {
                    this.value = e.originalEvent.dataTransfer.getData("text") ||
                    e.originalEvent.dataTransfer.getData("text/plain");

                    $("#textarea").append("dropped!");

                    return false;
                });

    </script>
    <script type="text/javascript">

        var form =  $( "#judgesForm" );
        form.bind('submit',function () {
            var url = form.attr('action');
            var data = form.serialize();
            $.post(url,data,function(result){

                $("#judges").append(result.message);

            });
        });


    </script>

@endsection
