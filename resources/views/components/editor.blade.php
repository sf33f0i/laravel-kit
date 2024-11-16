<?php
/**
 * @var Illuminate\Support\MessageBag $errors
 * @var string $editorId
 * @var string $title
 * @var string $label
 * @var string|int|float|null $value
 * @var int $height
 * @var bool $required
 * @var string $requestTitle
 */

$editorId = $editorId ?? str_replace(['[', ']'], '-', $title);

?>

@section('plugins.Summernote', true)

<label for="{{ $editorId }}">{{ $label }}  @if($required===true) <span class="field-required">*<span> @endif</label>
<div class="row">
    <div class="col-12">
        <textarea
            id="{{ $editorId }}"
            name="{{ $title }}"
            class="editor new-editor"
        >{{ old($title, $value ?? '') }}</textarea>
    </div>
</div>

{!! $errors->first($requestTitle ?? false, '<p class="help-block">:message</p>') !!}


<div class="modal fade" id="file-dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Загрузка файлов</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-bottom: 100px">
                @include('components.elfinder')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('/vendor/elfinder-2.1.62/js/elfinder.full.js') }}"></script>

    <script type="text/javascript">
        $('#file-dialog').on('hidden.bs.modal', function () {
            let editor = $('#{{ $editorId }}');
            let text = editor.val();
            editor.val(text.replace(new RegExp('//backend.', 'g'), '//'));
        })

        let ElFinder = function (context) {
            let layoutInfo = context.layoutInfo
            let $editor = layoutInfo.editor
            let $editable = layoutInfo.editable
            let $toolbar = layoutInfo.toolbar

            let ui = $.summernote.ui

            this.initialize = function () {
                let elfinderButton = ui.button({
                    contents: '<i class="fas fa-list-alt"></i>',
                    click: () => {
                        window.currentEditor = context

                        $('#file-dialog').modal()
                    },
                })

                let buttonGroup = ui.buttonGroup(
                    {
                        className: 'note-btn-group btn-group note-font',
                        contents: [
                            elfinderButton.render(),
                        ]
                    })

                $toolbar.append(buttonGroup.render())
            }
        }
    </script>
@endpush


@push('js')
    <script>
        $(() => {
            $('#{{ $editorId }}').summernote({
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36'],
                renderer: 'summernote',
                height: {{ $height ?? 500 }},
                lang: 'ru-RU',
                toolbar: [
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'video']],
                    ['genixcms', ['readmore', 'elfinder']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onPaste: function (e) {
                        let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html')

                        if (bufferText === '') {
                            bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text')
                        }

                        e.preventDefault();
                        let div = $('<div />')
                        div.append(bufferText)

                        div.find('*')
                            .removeAttr('style')
                            .removeAttr('class')
                            .removeAttr('id')

                        for (let element of div.find('*')) {
                            Object.keys(element.dataset).forEach(dataKey => {
                                $(element).removeAttr('data-' + dataKey)
                            })
                        }

                        div.find('span').replaceWith(function () {
                            return '<p>' + $(this).html() + '</p>'
                        })

                        setTimeout(function () {
                            document.execCommand('insertHtml', false, div.html())
                        }, 10)
                    },
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'alignCenter', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                },
                modules: $.extend($.summernote.options.modules, {
                    'elfinder': ElFinder,
                }),
                codeviewIframeWhitelistSrcBase: ['www.youtube.com', 'www.youtube-nocookie.com', 'www.facebook.com', 'vine.co', 'instagram.com', 'player.vimeo.com', 'www.dailymotion.com', 'player.youku.com', 'jumpingbean.tv', 'v.qq.com', 'yandex.ru'],

            })
        })
    </script>
@endpush

@once
    @push('css')
        <style type="text/css">

            {{-- SM size setup --}}
    .input-group-sm .note-editor {
                font-size: .875rem;
                line-height: 1;
            }

            {{-- LG size setup --}}
    .input-group-lg .note-editor {
                font-size: 1.25rem;
                line-height: 1.5;
            }

            {{-- Setup custom invalid style  --}}

    .adminlte-invalid-itegroup .note-editor {
                box-shadow: 0 .25rem 0.5rem rgba(0, 0, 0, .25);
                border-color: #dc3545 !important;
            }
        </style>
    @endpush
@endonce
