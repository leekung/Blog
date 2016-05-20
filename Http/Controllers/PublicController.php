<?php namespace Modules\Blog\Http\Controllers;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Status;
use Modules\Blog\Repositories\CategoryRepository;
use Modules\Blog\Repositories\PostRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Media\Repositories\FileRepository;

class PublicController extends BasePublicController
{
    /**
     * @var PostRepository
     */
    private $post;

    public function __construct(
        PostRepository $post,
        CategoryRepository $category,
        FileRepository $file,
        Status $status
    ) {
        parent::__construct();
        $this->post = $post;
        $this->file = $file;
        $this->status = $status;
        $this->category = $category;
    }

    public function index()
    {
        $posts = $this->post->allTranslatedIn(App::getLocale());

        return view('blog.index', compact('posts'));
    }

    public function show(Category $category, $slug)
    {
        $post = $this->post->findBySlug($slug);
        $galleryFiles = $this->file->findMultipleFilesByZoneForEntity('gallery', $post);
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $post);

        return view('blog.show', compact('post', 'galleryFiles', 'thumbnail'));
    }

    public function category($category)
    {
        $posts = $this->post->getByAttributes([
            'category_id' => $category->id
        ], 'id', 'DESC');

        return view('blog.category', compact('category', 'posts'));
    }

    public function favorite()
    {

        $user = $this->auth->check();
        if (!$user) {
            return response()->json([
                'result' => 0,
                'message' => trans('message.please login'),
            ]);
        }
        $item_type = Input::get('item_type');
        $collection_name = Input::get('collection_name');
        $item_id = Input::get('item_id');

        $valid_collections = [
           'favorites',
        ];

        if (class_exists($item_type) && in_array($collection_name, $valid_collections)) {
            $class = new $item_type;
            $model = $class->whereId($item_id)->first();
            if($model) {
                $user->collection($collection_name)->push($model);
                return response()->json([
                    'result' => 1,
                    'message' => trans('message.favorite saved'),
                ]);
            }
        }

        return response()->json([
            'result' => 0,
            'message' => trans('message.failed to save favorite'),
        ]);
    }
}
