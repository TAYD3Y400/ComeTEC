<?php
    function showInfoAlert ($message, $redirect) {
        echo "<script>Swal.fire({
            icon: 'info',
            title: '¡Atención!',
            text: '$message',
        }).then(function () {
            window.location.href = '$redirect';
        }); </script>";
    }
?>