<?php

$dir = '/vendor/elfinder-2.1.62';

?><!-- jQuery and jQuery UI (REQUIRED) -->
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<!-- elFinder CSS (REQUIRED) -->
<link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/elfinder.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/theme.css') }}">

<!-- elFinder JS (REQUIRED) -->
<script src="{{ asset($dir.'/js/elfinder.min.js') }}"></script>


@isset($locale)
    <!-- elFinder translation (OPTIONAL) -->
    <script src="{{ asset($dir."/js/i18n/elfinder.$locale.js") }}"></script>
@endisset

@pushonce('js')
    <script type="text/javascript" charset="utf-8">
        const toEditor = function () {
            this.exec = function (hashes, event) {
                const html = `<img src="` + "{{ asset('/storage/uploads') }}" + '/' + this.files(hashes)[0].name + `">`

                window.currentEditor.invoke('editor.pasteHTML', html.replace(new RegExp('//backend.', 'g'), '//'))
            }
            this.getstate = function () {
                var sel = this.files(sel)
                var cnt = sel ? sel.length : 0
                return cnt === 1 ? 0 : -1
            }
        }
    </script>
@endpushonce

<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
    // Documentation for client options:
    // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
    $().ready(function () {
        $('#elfinder').elfinder({
            // set your elFinder options here
            @isset($locale)
            lang: '{{ $locale }}', // locale
            @endisset
            customData: {
                _token: '{{ csrf_token() }}'
            },
            bootCallback: function (fm, extraObj) {
                (fm.commands.toeditor = toEditor).prototype = {forceLoad: true}// Force load this command
            },
            url: '{{ route('elfinder.connector') }}',  // connector URL
            soundPath: '{{ asset($dir.'/sounds') }}',
            contextmenu: {
                files: ['toeditor', '|', 'quicklook', '|', 'download', '|', 'rm', '|', 'info']
            }
        })
    })
</script>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

