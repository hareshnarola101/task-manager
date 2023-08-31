<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project Name:') !!}
    <p>{{ $task->project->name }}</p>
</div>

<!-- Task Name Field -->
<div class="col-sm-12">
    {!! Form::label('task_name', 'Task Name:') !!}
    <p>{{ $task->task_name }}</p>
</div>

<!-- Priority Field -->
<div class="col-sm-12">
    {!! Form::label('priority', 'Priority:') !!}
    <p>{{ $task->priority }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $task->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $task->updated_at }}</p>
</div>

