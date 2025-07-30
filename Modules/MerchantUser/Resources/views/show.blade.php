@extends ('backend.layouts.app')

@section ('title', __('merchantuser::labels.backend.merchantuser.management'))

@section('breadcrumb-links')
    @include('merchantuser::includes.breadcrumb-links')
@endsection

@push('after-styles')

@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('merchantuser::labels.backend.merchantuser.management') }}
                    <small class="text-muted">{{ __('merchantuser::labels.backend.merchantuser.show') }}</small>
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
                    <strong>{{ __('merchantuser::labels.backend.merchantuser.table.created') }}:</strong> {{ $merchantuser->updated_at->timezone(get_user_timezone()) }} ({{ $merchantuser->created_at->diffForHumans() }}),
                    <strong>{{ __('merchantuser::labels.backend.merchantuser.table.last_updated') }}:</strong> {{ $merchantuser->created_at->timezone(get_user_timezone()) }} ({{ $merchantuser->updated_at->diffForHumans() }})
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