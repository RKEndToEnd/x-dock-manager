//Get all tracks
$('#tracks-departed').DataTable({
    processing:true,
    info:true,
    ajax: departedTrackGetUrl,
    columns:[
        {data:'DT_RowIndex', name:'DT_RowIndex'},
        {data:'vehicle_id', name:'vehicle_id'},
        {data:'track_id', name:'track_id'},
        {data:'track_type', name:'track_type'},
        {data:'freight', name:'freight'},
        {data:'eta', name:'eta'},
        {data:'docking_plan', name:'docking_plan'},
        {data:'docked_at', name:'docked_at'},
        {data:'ramp', name:'ramp'},
        {data:'worker_id', name:'worker_id'},
        {data:'task_start', name:'task_start'},
        {data:'task_end_exp', name:'task_end_exp'},
        {data:'doc_return_exp', name:'doc_return_exp'},
        {data:'task_end', name:'task_end'},
        {data:'doc_ready', name:'doc_ready'},
        {data:'comment', name:'comment'},
        {data:'departure',name:'departure'},
        {data:'actions',name:'actions',orderable:false, searchable:false},
    ]
});
