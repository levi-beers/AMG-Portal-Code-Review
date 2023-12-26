<script>
    var datasource3users = ['10','20','15','35'];
    var datasource3months = ['Nov 20','Nov 21','Nov 22','Nov 23'];
    var datasource3trans = {
        chartLabel: "{{ __('SuCo Solar Data History')  }}",
        new: "{{ __('new') }}",
        user: "{{ __('user') }}",
        users: "{{ __('users') }}"
    };
</script>
{!! HTML::script('assets/js/as/datasource3.js') !!}
