<div class="card widget">
    <div class="card-body">
        <div class="row">
            <div class="text-primary flex-1">
                <i class="fa fa-globe fa-3x"></i>
            </div>

            <div class="pr-3">
                <h4 class="text-right text-wrap"> {{ ' (' . number_format($count) . ')' }}</h4>
                <h2 class="text-right text-wrap">{{ number_format($countyesterday) }}</h2>
                <p class="text-muted">@lang('Outbound Yesterday (w/ Delta)')</p>
            </div>
        </div>
    </div>
</div>
