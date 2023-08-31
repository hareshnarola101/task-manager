
<li class="nav-item">
    <a href="{{ route('projects.index') }}"
       class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
        <p>Projects</p>
    </a>
</li>


@php
 
$project = App\Models\Project::first();
if(!empty($project)){
    $project_id = $project->id;
}
else{
    $project_id = 1;
}

//dd($project);

@endphp


<li class="nav-item">
    <a href="{{ route('tasks.index', ['project_id' => $project_id ]) }}"
       class="nav-link {{ Request::is('tasks*') ? 'active' : '' }}">
        <p>Tasks</p>
    </a>
</li>


