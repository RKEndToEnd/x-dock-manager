//Get asigned roles
$('#assigned-roles-all').DataTable({
    processing:true,
    info:true,
    ajax:getAsRolesUrl,
    columns:[
        {data:'DT_RowIndex', name:'DT_RowIndex'},
        {data:'user', name:'ruser.name'},
        {data:'role_id', name:'role_id'},
    ]
});
