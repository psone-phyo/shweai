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
        <h4 class="card-title mb-4">
            {{ __('merchant::labels.backend.merchant.management') }}
            <small class="text-muted">{{ __('merchant::labels.backend.merchant.show') }}</small>
        </h4>

        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
            <tbody>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.company_name') }}</th>
                    <td>{{ $merchant->company_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.mm_company_name') }}</th>
                    <td>{{ $merchant->mm_company_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.business_name') }}</th>
                    <td>{{ $merchant->business_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.mm_business_name') }}</th>
                    <td>{{ $merchant->mm_business_name }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.business_email') }}</th>
                    <td>{{ $merchant->business_email }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.business_mobile') }}</th>
                    <td>{{ $merchant->business_mobile }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.registration_number') }}</th>
                    <td>{{ $merchant->registration_number }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.website_url') }}</th>
                    <td>{{ $merchant->website_url }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.approximate_sale') }}</th>
                    <td>{{ $merchant->approximate_sale }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.address') }}</th>
                    <td>{!! nl2br(e($merchant->address)) !!}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.latitude') }}</th>
                    <td>{{ $merchant->latitude }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.longitude') }}</th>
                    <td>{{ $merchant->longitude }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.created_by') }}</th>
                    <td>{{ $merchant->createdUser->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.last_updated_by') }}</th>
                    <td>{{ $merchant->updatedUser->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.approved_at') }}</th>
                    <td>{{ optional($merchant->approved_at)->format('Y-m-d h:i A') }}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.status') }}</th>
                    <td>{!! $merchant->status_label !!}</td>
                </tr>
                <tr>
                    <th>{{ __('merchant::labels.backend.merchant.table.active') }}</th>
                    <td>
                        @if ($merchant->active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>


    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('merchant::labels.backend.merchant.table.created') }}:</strong> {{ $merchant->created_at->timezone(get_user_timezone())->format('Y-m-d H:i:s') }} ({{ $merchant->created_at->diffForHumans() }}),
                    <strong>{{ __('merchant::labels.backend.merchant.table.last_updated') }}:</strong> {{ $merchant->updated_at->timezone(get_user_timezone())->format('Y-m-d H:i:s') }} ({{ $merchant->updated_at->diffForHumans() }})
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
    // You can add JS here if needed
</script>
@endpush
