@extends ('backend.layouts.app')

@section ('title', __('merchant::labels.backend.merchant.management'))

@section('breadcrumb-links')
    @include('merchant::includes.breadcrumb-links')
@endsection

@push('after-styles')

@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('merchant::labels.backend.merchant.management') }}
                    <small class="text-muted">{{ __('merchant::labels.backend.merchant.show') }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('merchant::labels.backend.merchant.table.created') }}:</strong> {{ $merchant->updated_at->timezone(get_user_timezone()) }} ({{ $merchant->created_at->diffForHumans() }}),
                    <strong>{{ __('merchant::labels.backend.merchant.table.last_updated') }}:</strong> {{ $merchant->created_at->timezone(get_user_timezone()) }} ({{ $merchant->updated_at->diffForHumans() }})
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection

@push('after-scripts')

<script>


</script>
@endpush