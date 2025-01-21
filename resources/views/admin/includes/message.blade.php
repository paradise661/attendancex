@if (Session::has('message'))
    <div class="alert alert-primary mt-4" role="alert">
        {{ Session::get('message') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success mt-4" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger mt-4" role="alert">
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-danger mt-4" role="alert">
        {{ Session::get('warning') }}
    </div>
@endif
