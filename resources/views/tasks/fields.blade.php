<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Select Project') !!}
    {!! Form::select('project_id', $projects ,null, ['class' => 'form-control']) !!}
</div>

<!-- Task Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('task_name', 'Task Name:') !!}
    {!! Form::text('task_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Priority Field -->
<div class="form-group col-sm-6">
    {!! Form::label('priority', 'Priority:') !!}
    {!! Form::number('priority', null, ['class' => 'form-control']) !!}
</div>