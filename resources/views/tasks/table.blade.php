<div class="table-responsive">
    <table class="table" id="tasks-table">
        <thead>
        <tr>
        <th>Task Name</th>
        <th>Priority</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody id="sort_menu">
        @foreach($tasks as $task)
            <tr class="handle" data-id="{{ $task->id }}">
            <td> <i class="fa fa-arrows-alt" ></i>  {{ $task->task_name }}</td>
            <td>{{ $task->priority }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tasks.show', [$task->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tasks.edit', [$task->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@push('page_css')
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
@endpush

@push('page_scripts')
<script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
    $( document ).ready(function() {
        $('#project').on('change',function(){
            var project_id = $('#project').val();
            window.location.replace("{{ route('tasks.index') }}" + '/?project_id=' + project_id);
        });

        function updateToDatabase(idString){
    	   $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
    		
    	   $.ajax({
              url:'{{route('tasks.updateorder')}}',
              method:'POST',
              data:{ids:idString},
              success:function(){
                location.reload();
                //  alert('Successfully updated')
               	 //do whatever after success
              }
           })
    	}

        var target = $('#sort_menu');
        target.sortable({
            items: ".handle",
            cursor: 'row-resize',
            opacity: '0.55',
            placeholder: 'highlight',
            update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData.join(','))
            }
        })
    });
    
</script>

@endpush
