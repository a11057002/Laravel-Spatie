$(function () {
    $('#groupTable').on('click', '.btn', function () {
        let id = $(this).data('id');
        let group = $(this).data('group');
        $('#editGroupName').val(group);
        $('#editGroupbtn').one('click', function () {
            editGroup(id, group);
        })
    });
})

let editGroup = (id, oldGroup) => {
    $.ajax({
        type: 'PUT',
        url: '/groups/' + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify({
            "name": $('#editGroupName').val(),
        }),
        contentType: "application/json",
        dataType: 'json'
    }).done(function (data) {
        $('#messageModal .modal-body').html('成功更新');
        $('#messageModal').modal('toggle');
        $('#' + oldGroup).html(data["groupName"]);
        $('#' + id).attr('data-group', data["groupName"])
    });
}
