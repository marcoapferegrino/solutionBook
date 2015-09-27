@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">Todos los Problemas</div>

                    <div class="panel-body">
                        @for($i=0;$i<count($result);$i++)
                            @if (($i+1)%3==0) <div class="row"> @endif
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{{$result[$i]->path}}}" alt="{{{$result[$i]->name}}}">
                                        <div class="caption">
                                            <h3>{{{$result[$i]->title}}}</h3>
                                            <p>Límite de tiempo: {{{$result[$i]->limitTime}}}</p>
                                            <p><a href="#" class="btn btn-primary" role="button">Button</a>
                                                <a href="#" class="btn btn-default" role="button">Button</a></p>

                                        </div>
                                    </div>
                                </div>
                                @if (($i+1)%3==0) </div> @endif

                        @endfor

                            {!!$result->render()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
