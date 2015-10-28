@extends('app')

@section('content')
    <div class="container">


        @include('partials.messages')

    </div>
<div class="container">

    <div class="col-lg-9 col-md-push-2 " >

        {!! Form::open(['route' => 'notices.addNotice','method' => 'POST','class'=>'form-inline','files'=>true]) !!}

        <div class="panel-body ">


            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Agregar noticia</h3>
                </div>

                <div class="panel-body col-md-8"> <!-- magia -->



                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('title', 'Título*') !!} <br>
                                {!! Form::text('title',null, array('class' => 'form-control ','size' => '86','id'=>'title','placeholder'=>'Título de la Noticia ','required'))!!}
                            </div>


                    </div>
                    <br> <br><br> <br>

                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Descripcion*') !!} <br>
                                {!! Form::textarea('description',null, array('class' => 'field', 'size' => '90x5','id'=>'description','placeholder'=>'Texto','required'))!!}
                            </div>
                        </div>
                    <br> <br><br> <br>

                    <br> <br><br> <br>
                    <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('finishDate', 'Fecha de Expiración*') !!} <br>
                        <input type="date" class="form-control" size="86" id="finishDate"  name="finishDate" placeholder="Fecha de expiración de noticia" required min={{\Carbon\Carbon::now()->subYears(1)}} max={{\Carbon\Carbon::now()->addYears(18)}} >
                    </div>
                    </div>
                    <br> <br><br> <br>
                    <div class="form-group">
                        <label for="file" class="col-sm-4 control-label">Imagen representativa:</label> <br><br>
                        <div class="col-sm-6">
                            {!! Form::file('file',array('id'=>'file', 'class'=>'btn btn-info','style'=>'')) !!}
                        </div>

                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="file" class="col-sm-4 control-label">Archivos de apoyo:</label> <br><br><br>
                        <div class="col-sm-6">

                            <input type="file"  name="apoyo[]" class="btn btn-info" id="apoyo" multiple>
                        </div>

                    </div>

                </div>


            </div>





            </div>

            <div class="form-group navbar-default nav-justified  " >
                {!! Form::submit('Registrar',array('class'=>'btn btn-success btn-block')) !!}
                {!! Form::close() !!}
            </div>
        </div>

    </div>   </div>
    <br><br> <br>

</div>

@endsection

