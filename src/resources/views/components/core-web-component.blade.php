<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <script>
        window.token = '{{csrf_token()}}'
        window.cwv_path = '{{route('store-cwv')}}'
    </script>
    <script src="{{asset('vendor/corewebvitals/core-web-vital/js/core-web-vital.js')}}"></script>
</div>
