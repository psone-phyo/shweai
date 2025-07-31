@extends ('backend.layouts.app')

@section ('title', __('merchantuser::labels.backend.merchantuser.management'))

@section('breadcrumb-links')
    @include('merchantuser::includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('merchantuser::labels.backend.merchantuser.management') }}
                    <small class="text-muted">{{ __('merchantuser::labels.backend.merchantuser.show') }}</small>
                </h4>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>{{ __('merchantuser::labels.backend.merchantuser.table.merchant') }}</th>
                        <td>{{ $merchantUser->merchant->business_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('merchantuser::labels.backend.merchantuser.table.name') }}</th>
                        <td>{{ $merchantUser->user->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('merchantuser::labels.backend.merchantuser.table.email') }}</th>
                        <td>{{ $merchantUser->user->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('merchantuser::labels.backend.merchantuser.table.mobile') }}</th>
                        <td>{{ $merchantUser->user->mobile }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('merchantuser::labels.backend.merchantuser.table.nrc') }}</th>
                        <td>{{ $merchantUser->nrc }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('merchantuser::labels.backend.merchantuser.table.active') }}</th>
                        <td>
                            @if ($merchantUser->active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!--card-body-->


    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('merchant::labels.backend.merchant.table.created') }}:</strong> {{ $merchantUser->created_at->timezone(get_user_timezone())->format('Y-m-d H:i:s') }} ({{ $merchantUser->created_at->diffForHumans() }}),
                    <strong>{{ __('merchant::labels.backend.merchant.table.last_updated') }}:</strong> {{ $merchantUser->updated_at->timezone(get_user_timezone())->format('Y-m-d H:i:s') }} ({{ $merchantUser->updated_at->diffForHumans() }})
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
