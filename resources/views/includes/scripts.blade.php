<!-- CoreUI and necessary plugins-->
<script src="{{ asset('theme/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
{{-- <script src="{{ asset('theme/vendors/simplebar/js/simplebar.min.js') }}"></script> --}}
<!-- Plugins and scripts required by this view-->
<script src="{{ asset('theme/vendors/@coreui/utils/js/coreui-utils.js') }}"></script>

{{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

@livewireScripts
@stack('scripts')