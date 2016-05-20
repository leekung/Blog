<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        <?php $oldTitle = isset($post->translate($lang)->title) ? $post->translate($lang)->title : ''; ?>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title", $oldTitle), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.sub_title") ? ' has-error' : '' }}'>
        <?php $oldTitle = isset($post->translate($lang)->sub_title) ? $post->translate($lang)->sub_title : ''; ?>
        {!! Form::label("{$lang}[sub_title]", trans('blog::post.form.sub_title')) !!}
        {!! Form::text("{$lang}[sub_title]", old("$lang.sub_title", $oldTitle), ['class' => 'form-control', 'placeholder' => trans('blog::post.form.sub_title')]) !!}
        {!! $errors->first("$lang.sub_title", '<span class="help-block">:message</span>') !!}
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

    <?php if (config('asgard.blog.config.post.partials.translatable.edit') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.edit') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="box-group" id="accordion-{{$lang}}">
        @foreach (config('meta.available_metas') as $meta_group_name => $meta_group)
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a class="collapsed" data-toggle="collapse" href="#collapsePanel-{{ $meta_group_name }}-{{ $lang }}">
                            <i class="fa fa-{{ $meta_group_name }}" aria-hidden="true"></i>
                            {{ ucwords($meta_group_name) }} {{ trans('page::pages.form.meta_data') }}
                        </a>
                    </h4>
                </div>
                <div id="collapsePanel-{{ $meta_group_name }}-{{ $lang }}" class="panel-collapse collapse">
                    <div class="box-body">
                        <?php
                        $meta = $post->setLocale($lang)->getAllMeta();
                        ?>
                        @foreach($meta_group as $key => $val)
                            @if ($val['edit'] != false)
                                <div class='form-group{{ $errors->has("{$lang}[metable][{$meta_group_name}][{$key}]") ? ' has-error' : '' }}'>
                                    {!! Form::label("{$lang}[metable][{$meta_group_name}][{$key}]", $key) !!}
                                    {!! Form::text("{$lang}[metable][{$meta_group_name}][{$key}]", old("{$lang}.metable.{$meta_group_name}.{$key}", $meta->get($key)), ['class' => "form-control", 'maxlength' => $val['maxlength']]) !!}
                                    {!! $errors->first("{$lang}[metable][{$meta_group_name}][{$key}]", '<span class="help-block">:message</span>') !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
