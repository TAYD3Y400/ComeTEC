<?php
    // Function to show success alert
    // When click ok, redirect to the given page with then function
    function showSuccessAlert($message, $redirect) {
        echo "<script>Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '$message',
        }).then(function () {
            window.location.href = '$redirect';
        }); </script>";
    }

    function showSuccessAlertNoRedirect($message) {
        echo "<script>Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '$message',
        }); </script>";
    }

?>