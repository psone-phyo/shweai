@extends ('backend.layouts.app')

@section ('title', __('merchantuser::labels.backend.merchantuser.management') . ' | ' . __('merchantuser::labels.backend.merchantuser.edit'))

@section('breadcrumb-links')
    @include('merchantuser::includes.breadcrumb-links')
@endsection

@push('after-styles')
{{ style('assets/plugins/select2/css/select2.min.css') }}
{{ style('assets/plugins/select2/css/select2-bootstrap.min.css') }}
@endpush

@section('content')
{{ html()->modelForm($merchantuser, 'PATCH', route('admin.merchantuser.update', $merchantuser->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('merchantuser::labels.backend.merchantuser.management') }}
                        <small class="text-muted">{{ __('merchantuser::labels.backend.merchantuser.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('merchantuser::labels.backend.merchantuser.table.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                ->class('form-control')
                                ->placeholder(__('merchantuser::labels.backend.merchantuser.table.description'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.merchantuser.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection

@push('after-scripts')
{{ script('assets/plugins/select2/js/select2.full.min.js')}}
{{ script("assets/plugins/select2/component/components-select2.js") }}
<script>


</script>
@endpush