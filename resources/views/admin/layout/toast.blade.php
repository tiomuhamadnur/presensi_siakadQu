{{-- TOAST --}}
@if (session()->get('success'))
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-primary top-0 start-50 translate-middle-x show"
        role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold"></div>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session()->get('success')['message'] }}
        </div>
    </div>
@endif

@if (session()->get('message'))
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-primary top-0 start-50 translate-middle-x show"
        role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold"></div>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session()->get('message')['message'] }}
        </div>
    </div>
@endif

@if (session()->get('deleted'))
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-primary top-0 start-50 translate-middle-x show"
        role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold"></div>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session()->get('deleted')['message'] }}
        </div>
    </div>
@endif

@if (session()->get('404'))
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show"
        role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold"></div>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session()->get('404')['message'] }}
        </div>
    </div>
@endif
{{-- END TOAST --}}
