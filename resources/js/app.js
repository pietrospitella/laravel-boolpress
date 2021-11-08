require('./bootstrap');

const deleteForm = document.querySelectorAll('.delete-post');

deleteForm.forEach(item => {
    item.addEventListener('submit', function(e){
        const resp = confirm('Are you sure you want to delete this post?');
        if(!resp){
            e.preventDefault();
        }
    })
})

const alertTimeOut = document.querySelectorAll('.alert');


if (alertTimeOut) {
    setTimeout(function() {
        alertTimeOut[0].remove()
    }, 2000);
}