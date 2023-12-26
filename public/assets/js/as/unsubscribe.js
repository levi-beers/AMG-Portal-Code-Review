document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const email = row.getAttribute('data-email');
            const osrc = row.getAttribute('data-osrc');

            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                showCancelButton: true,
                confirmButtonText: 'Save',
              }).then((result) => {
                if (result.isConfirmed) {
                    deleteRecord(email, row, osrc);
                }
              })            
        });
    });

    function deleteRecord(email, row, osrc) {
        fetch(`/unsubscribe/delete/${email}/${osrc}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => response.json())
            .then(data => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        window.location.reload()
                    }
                })

                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    })
                    
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    })
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});