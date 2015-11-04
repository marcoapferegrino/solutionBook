@extends('app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h4>Agregar Problema</h4></div>

                    <div class="panel-body">
                        @include('partials.messages')
                        {!! Form::open([
                        'route' => 'problem.updateProblem',
                        'method' => 'post',
                        'class'=>'form-horizontal',
                        'id'=>'',
                        'files'=>true]) !!}
                        <input type="text" value="{{$dataProblem->id}}" hidden name="idProblem">
                        <div class="form-group">
                            <label for="titulo" class="col-sm-2 control-label"><strong>Título</strong></label>
                            <div class="col-sm-6">
                                {!!Form::text('title',$dataProblem->title,['class'=>'form-control','id'=>'title'])!!}
                                <!-- {!!Form::text('titulo', '',['class'=>'form-control titulo','id'=>'buscar'])!!} -->
                                <div id="similarTitle"></div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="titulo" class="col-sm-2 control-label"><strong>Institución</strong></label>
                            <div class="col-sm-6">
                                {!!Form::text('institucion',$dataProblem->institution,['class'=>'form-control'])!!}
                                <!-- {!!Form::text('titulo', '',['class'=>'form-control titulo','id'=>'buscar'])!!} -->
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label"><strong>Descripción</strong></label>
                            <div class="col-sm-8">
                                {!!Form::textArea('descripcion',$dataProblem->description,['class'=>'form-control','placeholder'=>'Descripción del problema'])!!}
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="limitTime" class="col-sm-2 control-label"><strong>Limite de tiempo *</strong></label>
                            <div class="col-sm-6">
                                {!!Form::text('limitTime',$dataProblem->limitTime,['class'=>'form-control','placeholder'=>'segundos'])!!}
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="limitMemory" class="col-sm-2 control-label"><strong>Limite de Memoria *</strong></label>
                            <div class="col-sm-6">
                                {!!Form::text('limitMemory',$dataProblem->limitMemory,['class'=>'form-control','placeholder'=>'bytes'])!!}
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="judgeList" class="col-sm-2 control-label"><strong>Juez en Línea</strong></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="judgeList">
                                    <option value='#'></option>
                                    @foreach($judgeList as $j)
                                        @if($j->id==$dataProblem->judgeList_id)
                                            <option value="{{$j->id}}" selected>{{$j->name}}</option>
                                        @else
                                            <option value="{{$j->id}}">{{$j->name}}</option>
                                        @endif
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
                            <label for="EjemploEntrada" class="col-sm-2 control-label"><strong>Ejemplo entrada *</strong></label>
                            <div class="col-sm-4">
                                <textarea rows=8  name="ejemploen" class="form-control" >{{$entrada}}</textarea>
                            </div>
                            <label for="output" class="col-sm-1 control-label"><strong>Ejemplo salida *</strong></label>
                            <div class="col-sm-4">
                                <textarea rows=8 name="ejemplosa" class="form-control" >{{$salida}}</textarea>
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
                                <label for="input" class="col-sm-2 control-label"><strong>Entrada *</strong></label>
                                <div class="col-sm-4">
                                    <textarea rows=8 id='textarea'  name="inputs[]" class="form-control" >{{$inputs}}</textarea>
                                </div>
                                <label for="output" class="col-sm-1 control-label"><strong>Salida *</strong></label>
                                <div class="col-sm-4">
                                    <textarea rows=8 name="outputs[]" class="form-control" >{{$outputs}}</textarea>
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

                        <div class="form-group">
                            <label for="tags" class="col-sm-2 control-label"><strong>Palabras clave</strong></label>
                            <div class="col-sm-6">
                                {!!Form::text('tags','',['class'=>'form-control','id'=>'tags','placeholder'=>'Etiquetas (p. ej.: arboles binarios, estructuras de datos, recursividad)'])!!}
                                <div id="similarTags"></div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="youtube" class="col-sm-2 control-label"><strong>Youtube</strong></label>
                            <div class="col-sm-6">
                                @if($youtube!=null)
                                    {!!Form::text('youtube',$youtube->link,['class'=>'form-control'])!!}
                                @else
                                    {!!Form::text('youtube','',['class'=>'form-control'])!!}
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="github" class="col-sm-2 control-label"><strong>Github</strong></label>
                            <div class="col-sm-6">
                                @if($youtube!=null)
                                    {!!Form::text('github',$github->link,['class'=>'form-control'])!!}
                                @else
                                    {!!Form::text('github','',['class'=>'form-control'])!!}
                                @endif
                            </div>

                        </div>

                        <div class="row">
                            @foreach($files as $i=>$f)
                                <div class="col-sm-4 col-md-2">
                                    <div class="thumbnail">
                                        <img src="{{$f->url}}" alt="{{$f->name}}">
                                        <div class="caption">
                                            <p><a href="#" onclick="borrar({{$f->id}});" class="btn btn-primary" role="button">Borrar</a> </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="form-group">
                            <label for="images" class="col-sm-2 control-label"><strong>Archivos de apoyo</strong></label>
                            <div class="col-sm-6">
                                <input type="file"  name="images[]" class="btn btn-info" id="images" multiple>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="submit" class="col-sm-5 control-label"><strong></strong></label>
                            <div class="col-sm-4">
                                {!!Form::submit('Agregar',['class'=>'form-control btn-info'])!!}
                            </div>

                        </div>
                        <div id="idBorrados"></div>

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

    <script type="text/javascript">
        function agregar() {
            campo = '<div class="form-group"><div class="col-sm-1"></div>                                <label for="descripcion" class="col-sm-1 control-label"><strong>Ejemplo entrada</strong></label>                                <div class="col-sm-4">                                     <textarea rows=8 name="inputs[]"  class="form-control" ></textarea>                         </div>   <label for="descripcion" class="col-sm-1 control-label"><strong>Ejemplo salida</strong></label>                                <div class="col-sm-4">                                     <textarea rows=8  name="outputs[]" class="form-control" ></textarea>        </div></div>';
            $("#emails").append(campo);
        }
        function borrar(id){
            idsBorrar='<input type="text" value="'+id+'" name="idBorrados"  hidden>';
            $('#idBorrados').append(idsBorrar);

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

@endsection
