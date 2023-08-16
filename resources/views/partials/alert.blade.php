@if (session()->get('alert'))
    <div class="alert alert-{{ session()->get('alert')['type'] ?? 'success' }} alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>{{ session()->get('alert')['title'] ?? '' }}</strong> {{ session()->get('alert')['message'] ?? '' }}
    </div>
@endif
