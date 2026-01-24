@php
    // Redirect to login page since both forms are now on the same page
    header('Location: ' . route('login'));
    exit();
@endphp
