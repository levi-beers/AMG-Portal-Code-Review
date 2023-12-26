<script>
    var datasource4users = ['100','2000','150','3500'];
    var datasource4months = ['Nov 20','Nov 21','Nov 22','Nov 23'];
    var datasource4trans = {
        chartLabel: "{{ __('datajetbenefits')  }}",
        new: "{{ __('new') }}",
        user: "{{ __('user') }}",
        users: "{{ __('users') }}"
    };
</script>
{!! HTML::script('assets/js/chart.min.js') !!}
{!! HTML::script('assets/js/chartjs-plugin-datasource.min.js') !!}
{!! HTML::script('assets/js/as/datasource4.js') !!}
