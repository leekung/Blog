<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        <?php $oldTitle = isset($post->translate($lang)->title) ? $post->translate($lang)->title : ''; ?>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title", $oldTitle), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
        <?php $oldSlug = isset($post->translate($lang)->slug) ? $post->translate($lang)->slug : ''; ?>
       {!! Form::label("{$lang}[slug]", trans('blog::post.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("$lang.slug", $oldSlug), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::post.form.slug')]) !!}
       {!! $errors->first("$lang.slug", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.content") ? ' has-error' : '' }}'>
        <?php $oldContent = isset($post->translate($lang)->content) ? $post->translate($lang)->content : ''; ?>
        {!! Form::label("{$lang}[content]", trans('blog::post.form.content')) !!}
        {!! Form::textarea("{$lang}[content]", old("$lang.content", $oldContent), ['class' => 'form-control ckeditor']) !!}
        {!! $errors->first("$lang.content", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group'>
        @include('media::admin.fields.file-link-multiple', [
            'entityClass' => 'Modules\\\\Blog\\\\Entities\\\\Post',
            'entityId' => $post->id,
            'zone' => 'gallery'
        ])
    </div>

    <?php if (config('asgard.blog.config.post.partials.translatable.edit') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.edit') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
