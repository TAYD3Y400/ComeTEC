<?php
    // When click ok, redirect to the given page
    function showErrorAlert($message, $redirect) {
        echo "<script>Swal.fire({
            icon: 'error',
            title: '¡Ha ocurrido un error!',
            text: '$message',
        }).then(function () {
            window.location.href = $redirect;
        }); </script>";
    }

    function showErrorAlertNoRedirect($message) {
        echo "<script>Swal.fire({
            icon: 'error',
            title: '¡Ha ocurrido un error!',
            text: '$message',
        }); </script>";
    }

?>