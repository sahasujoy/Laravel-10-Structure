{{-- Vendor Scripts --}}
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>
@yield('vendor-script')
{{-- Theme Scripts --}}
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/components/components-popovers.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/ui/ui-feather.js')) }}"></script>


{{-- Data table Scripts --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>

{{-- Toaster Scripts --}}
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
{{-- pickadate Scripts --}}
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

<!-- sweetalert2 Scripts -->
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>

<!-- Validation Scripts -->
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function buttonLoaderShow(buttonSubmitClassName = "button-submit", buttonLoaderClassName = "button-loader"){
        $('.' + buttonSubmitClassName).attr('disabled', true);
        $('.' + buttonLoaderClassName).css('display', 'inline-block');
    }
    function buttonLoaderHide(buttonSubmitClassName = "button-submit", buttonLoaderClassName = "button-loader"){
        $('.' + buttonSubmitClassName).attr('disabled', false);
        $('.' + buttonLoaderClassName).css('display', 'none');
    }

</script>

<script src="{{ asset('js/scripts/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/global/global.js') }}"></script>
<script src="{{ asset('js/global/response.js') }}"></script>

<script>

    $('#app_list').on('select2:select', function (e) {
        let app_id = $('#app_list').val()
        document.cookie = "app_id="+app_id;

        window.location.href = route('user.app-dashboard-view', app_id);
    });

    let x = getCookie('app_id');

    function getCookie(cookieName) {
        let name = cookieName + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    if(x !== null && x !==undefined && x !== ""){
        console.log(x,'x')
        $('#app_list [value='+x+']').attr('selected', 'true');
    }
    $("#help-modal").on("click", function(e) {
        $("#notification-video").attr("src", ""); // Remove the video source.
        $("#help-circle").modal('hide')
    });

    $("#segment-help-modal").on("click", function(e) {
        $("#segment-help-modal").attr("src", ""); // Remove the video source.
        $("#segment-help").modal('hide')
    });

</script>
{{-- page script --}}
@yield('page-script')
{{-- page script --}}
