<div class="form-group">
    <label for="title" class="control-label">Название <span class="field-required">*<span></label>
    <input class="form-control" name="title" type="text" id="title" value="{{ old('title', $page->title) }}">
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="alias" class="control-label">Псевдоним <span class="field-required">*<span></label>
    <input class="form-control" name="alias" type="text" id="alias" value="{{ old('alias', $page->alias) }}">
    {!! $errors->first('alias', '<p class="help-block">:message</p>') !!}
</div>


@include('components.editor', [
    'title' => 'text',
    'requestTitle' => 'text',
    'value' => old('text', $page->text ?? '') ,
    'label' => 'Текст',
    'required' => true,
])

<div class="form-group">

    <input type="hidden" value="0" checked="checked" name="active">
    <input type="checkbox" value="1"
           {{ old('active', $page->active) ? 'checked="checked"' : '' }} id="active"
           name="active">

    <label for="active">Опубликовано</label>
</div>
<hr>
<div class="form-group">
    <label for="seo_title" class="control-label">
        SEO title
    </label>
    <input
        class="form-control"
        name="seo_title"
        type="text"
        id="seo_title"
        value="{{ old('seo_title', $page?->seo_title) }}"
    />
    {!! $errors->first('seo_title', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <label for="seo_description" class="control-label">
        SEO description
    </label>
    <textarea
        class="form-control"
        name="seo_description"
        id="seo_description"
    >{{ old('seo_description', $page?->seo_description) }}</textarea>
    {!! $errors->first('seo_description', '<p class="help-block">:message</p>') !!}
</div>



