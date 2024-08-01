
// new Show password
$('.showPassword').on('change', (event) => {
    if (event.target.checked) {
        $('.password').attr('type', 'text')
    } else {
        $('.password').attr('type', 'password')
    }
})

// User Edit Modal data insertion
$('.edit-user').on('click', (element) => {
    let tr = element.target.parentElement.parentElement;
    let username = tr.getElementsByTagName('a')[0].innerText;
    let id = tr.firstElementChild.innerText;
    $('#currUserId').val(id);
    $('#editUserId').val(id);
    $('#editUsername').val(username);
    let currentUrl = window.location.toString();
    $('#euUrl').val(currentUrl);
});


// Thread Edit Modal data insertion
$('.edit-thread').on('click', (element) => {
    let tr = element.target.parentElement.parentElement;
    let id = tr.firstElementChild.innerText;
    let title = tr.getElementsByTagName('td')[0].innerText;
    let desc = tr.getElementsByTagName('td')[1].innerText;
    $('#currThreadId').val(id);
    $('#editThreadId').val(id);
    $('#editThreadTitle').val(title);
    $('#editThreadDescription').val(desc);
    let currentUrl = window.location.toString();
    $('#etUrl').val(currentUrl)
    
});


    // Thread Edit Modal data insertion
$('.edit-comment').on('click', (element) => {
    let tr = element.target.parentElement.parentElement;
    let id = tr.firstElementChild.innerText;
    let content = tr.getElementsByTagName('td')[0].innerText;
    $('#editCommentId').val(id);
    $('#currCommentId').val(id);
    $('#editCommentContent').val(content);
    let currentUrl = window.location.toString();
    $('#ecUrl').val(currentUrl)

});


// Delete User Modal data insertion
$('.delete-user').on('click', (element) => {
    let tr = element.target.parentElement.parentElement;
    let id = tr.firstElementChild.innerText;
    let type = 'user';
    $("#deleteType").val(type);
    $("#deleteId").val(id);
    let currentUrl = window.location.toString();
    $('#dUrl').val(currentUrl)
    
});


// Delete Thread Modal data insertion
$('.delete-thread').on('click', (element) => {
    let tr = element.target.parentElement.parentElement;
    let id = tr.firstElementChild.innerText;
    let type = 'thread';
    $("#deleteType").val(type);
    $("#deleteId").val(id);
    let currentUrl = window.location.toString();
    $('#dUrl').val(currentUrl)
});


// Delete Comment Modal data insertion
$('.delete-comment').on('click', (element) => {
    let tr = element.target.parentElement.parentElement;
    let id = tr.firstElementChild.innerText;
    let type = 'comment';
    $("#deleteType").val(type);
    $("#deleteId").val(id);
    let currentUrl = window.location.toString();
    $('#dUrl').val(currentUrl)
    
})