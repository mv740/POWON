
$(document).ready(function(){
    $(document.body).bind('hidden.bs.modal', function () {
        $('#myModal').removeData('bs.modal')
    });
});

