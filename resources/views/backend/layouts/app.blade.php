<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    {{ style('assets/plugins/summernote/summernote.css') }}
    {{ style('assets/plugins/select2/css/select2.min.css') }}
    {{ style('assets/plugins/select2/css/select2-bootstrap.min.css') }}
    {{ style('assets/plugins/waitme/waitMe.min.css') }}
    <livewire:styles />
    @stack('after-styles')
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@3.4.0/dist/css/coreui.min.css" rel="stylesheet">

</head>
<body class="c-app">
    @include('backend.includes.sidebar')

    <div class="c-wrapper c-fixed-components">
        @include('backend.includes.header')
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        @include('includes.partials.announcements')

        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        @include('includes.partials.messages')
                        @yield('content')
                    </div><!--fade-in-->
                </div><!--container-fluid-->
            </main>
        </div><!--c-body-->

        @include('backend.includes.footer')
    </div><!--c-wrapper-->

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>

    @stack('after-scripts')
    {{ script('assets/plugins/summernote/summernote.js')}}
    {{ script('assets/plugins/jquery.blockui.min.js')}}
    {{ script('assets/plugins/waitme/waitMe.min.js')}}
    <script>
    function load_plugins() {
        $('[data-toggle="tooltip"]').tooltip();
    }
    </script>
    <script type="text/javascript">
        $('.editor').summernote({
            height: 300,
            popover: {
                image: [],
                link: [],
                air: []
            },
        });

        function run_waitMe() {
            $('body').waitMe({
                effect: 'win8',
                text: 'Please Wait..',
                bg: 'rgba(255,255,255,0.7)',
                color: '#000',
                sizeW: '',
                sizeH: ''
            });
        }
        function stop_waitMe() {
            $('body').waitMe('hide');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
    $(document).on('click', 'a[data-method="delete"]', function (e) {
        e.preventDefault();
        let that = $(this);
        let title = that.data('trans-title');
        let confirmButton = that.data('trans-button-confirm');
        let cancelButton = that.data('trans-button-cancel');
        let href = that.attr('href');

        Swal.fire({
            title: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmButton,
            cancelButtonText: cancelButton,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let form = $('<form>', {
                    'method': 'POST',
                    'action': href
                });
                let token = $('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': $('meta[name="csrf-token"]').attr('content')
                });
                let hiddenInput = $('<input>', {
                    'name': '_method',
                    'type': 'hidden',
                    'value': 'DELETE'
                });
                form.append(token, hiddenInput).appendTo('body').submit();
            }
        });
    });

    </script>

    <livewire:scripts />
</body>
</html>
