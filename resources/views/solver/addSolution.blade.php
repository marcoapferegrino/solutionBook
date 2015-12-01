@extends('app')
@section('styles')
    <link href="{{ asset('/css/jquery.keypad.css') }}" rel="stylesheet">
@endsection
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3>Agregar solución para el problema: #{{$idProblem}}</h3>
                    </div>

                    <div class="panel-body">
                        @include('partials.messages')

                        {!! Form::open([
                        'route' => 'solution.addSolution',
                        'method' => 'post',
                        'files'=>true]) !!}


                        {!! Form::hidden('idProblem',$idProblem,array('id' => 'idProblem')) !!}

                        <div class="form-group col-md-10 col-lg-offset-1">
                            <h4><label for="language"><strong>Lenguaje*</strong></label></h4>
                            {!!Form::select('optionsLanguages', config('optionsLanguages.lenguages'),old('optionsLanguages'),['class'=>'form-control'])!!}
                        </div>

                        <div class="form-group col-md-10 col-lg-offset-1 ">
                            <h4><label for="explanation"><strong>Explicación*</strong></label></h4>
                            @include('forEverybody.partials.tagToEdit')
                            {!! Form::textarea('explanation',old('explanation'),array('id' => 'explanation','class'=>'form-control keypad','placeholder'=>'Tu explicación debe ser clara y detallada...:D ')) !!}

                        </div>

                        <div class="form-group col-md-10 col-lg-offset-1 ">
                            <div class="alert alert-warning" role="alert"><h3><strong>Así se verá tu explicación :D </strong></h3></div>

                            <div id="contenido">

                            </div>

                        </div>

                        <div class="form-group col-md-10 col-lg-offset-1 ">
                            <h4><label class="control-label" for="youtube"><strong>Youtube</strong></label></h4>
                            <input type="url"  class="form-control" value="{{old('youtube')}}" name ="youtube" id="youtube" placeholder="¿Tienes un video con explicación?" >
                        </div>
                        <div class="form-group col-md-10 col-lg-offset-1">
                            <h4> <label class="control-label" for="repositorio"><strong>Repositorio</strong></label></h4>
                            <input type="url"  class="form-control" value="{{old('repositorio')}}" name ="repositorio" id="repositorio" placeholder="¿Tienes un repositorio con el código?" >
                        </div>
                        <div class="form-group col-md-10 col-lg-offset-1">
                            <h4> <label class="control-label" for="web"><strong>Página web</strong></label></h4>
                            <input type="url"  class="form-control" value="{{old('web')}}" name ="web" id="web" placeholder="¿Tienes una página web con la explicación?" >
                        </div>

                        <div class="form-group col-md-10 col-lg-offset-1">
                            <label for="fileCode" ><strong>Sube tu Código*</strong></label>
                            {!! Form::file('fileCode',array('id'=>'fileCode', 'class'=>'btn btn-info','style'=>'')) !!}
                        </div>

                        <div class="form-group col-md-10 col-lg-offset-1">
                            <label for="images"><strong>Sube tus Imágenes</strong></label>
                            <input type="file"  name="images[]" class="btn btn-info" id="images" multiple>
                        </div>

                        <div class="form-group col-md-10 col-lg-offset-1">
                            <label for="audioFile" ><strong>Sube un audio con la explicación</strong></label>
                            {!! Form::file('audioFile',array('id'=>'audioFile', 'class'=>'btn btn-info','style'=>'')) !!}
                        </div>

                        <button type="submit" class="btn btn-success btn-lg btn-block" id="submit-all">Guardar</button>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('/js/jquery.keypad.js') }}"></script>
    <script src="{{ asset('/js/keyMapOurs.js') }}"></script>
    {{--<script src="{{ asset('/js/highlight.pack.js') }}"></script>--}}
    {{--<script>--}}
        {{--hljs.initHighlightingOnLoad();--}}
    {{--</script>--}}
    <script src="{{ asset('/js/previewExplanation.js') }}"></script>
@endsection

