<div class="box box-primary">
    <div class="box-header">
        <a class="uppercase" href="{{ URL::route('admin.blog.post.index') }}">
            <h3 class="box-title">
                <i class="fa fa-copy"></i> {{ trans('blog::post.latest posts') }}
            </h3>
        </a>
    </div><!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-striped">
            <tbody><tr>
                <th style="width: 10px">#</th>
                <th>{{ trans('blog::post.table.title') }}</th>
                <th>{{ trans('blog::post.table.slug') }}</th>
                <th>{{ trans('core::core.table.created at') }}</th>
            </tr>
            <?php if (isset($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td>
                            <a href="{{ route('admin.blog.post.edit', [$post->id]) }}">
                                {{ $post->id }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.post.edit', [$post->id]) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.post.edit', [$post->id]) }}">
                                {{ $post->slug }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.post.edit', [$post->id]) }}">
                                {{ $post->created_at }}
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div>
