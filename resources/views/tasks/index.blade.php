@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tasks</h1>
                </div>
                
                <div class="col-sm-2 offset-sm-2">
                    
                {!! Form::select('project', $projects ,app('request')->input('project_id'), ['class' => 'form-select form-control float-right', 'id' => 'project' ]) !!}
                
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary float-right"
                       href="{{ route('tasks.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('tasks.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection



