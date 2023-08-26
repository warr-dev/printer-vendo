<!DOCTYPE html>
<html>

@include('public.partials.head')

<body style="max-height:100vh">

    @yield('content')
    
    @include('public.partials.upload-docs-modal')

    @include('public.partials.print-modal-container')

    @include('public.partials.transaction-summary-modal')

    @include('public.partials.add-coins-modal')

    @include('public.partials.printing-modal')


    @include('public.partials.scripts')

</body>

</html>
