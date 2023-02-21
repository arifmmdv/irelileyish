<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
            .ck-editor__editable {
                min-height: 300px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script src="/ckeditor/ckeditor.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script type="text/javascript">
            var textareas = document.getElementsByClassName("textarea");
            for (var i = 0; i < textareas.length; i++) {
                ClassicEditor.create( 
                    document.getElementById(textareas[i].id), {
                        mediaEmbed: { previewsInData: true }
                    }
                )
            }

            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            Swal.fire({
                title: 'Error!',
                text: '{{$error}}',
                icon: 'error',
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
                timer: 2000,
                showConfirmButton: false
            });
            @endforeach
            @endif

            @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{session('success')}}',
                icon: 'success',
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
                timer: 2000,
                showConfirmButton: false
            })
            @endif

            @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{session('error')}}',
                icon: 'error',
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
                timer: 2000,
                showConfirmButton: false
            })
            @endif


            $(document).ready(function(){
                $(".accordion-title").click(function(){
                    $(this).closest(".accordable").find('.accordion-content').slideToggle();
                    $(this).closest(".accordable").toggleClass('active');
                });
                $(".btn2").click(function(){
                    $("p").show();
                });
            });



        </script>
    </body>
</html>
