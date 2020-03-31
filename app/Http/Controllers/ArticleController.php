<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\Article as MainRequest;

class ArticleController extends Controller
{
    private $pathViewController = 'admin.article.';
    private $controllerName = 'article';

    private $pathViewControllerWeb = 'news.article.';
    private $params = [];
    private $model;

    public function __construct()
    {
        $this->model = new Article();    
        $this->params['pagination']['totalItemsPerPage'] = 10;
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        
        $items = $this->model->listItems($this->params, ['task' => "admin-list-items"]);
        $itemsStatusCount = $this->model->CountItems($this->params, ['task' => "admin-count-items-group-by-status"]);

    	return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'items' => $items,
            'itemsStatusCount' => $itemsStatusCount
        ]);
    }

    public function form(Request $request)
    {
        $item = null;
        if($request->id !== null){
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        $CategoryModel = new Category;
        $listCategory = $CategoryModel->listItems(null, ['task' => 'list-category-in-selectbox']);
        return view($this->pathViewController . 'form', [
            'item' => $item,
            'listCategory' => $listCategory
        ]);
    }

    public function save(MainRequest $request)
    {
        if($request->method() == 'POST'){
            $params = $request->all();
            $task = 'add-item';
            $notify = 'Thêm phần tử thành công';

            if($params['id'] !== null){
                $task = 'edit-item';
                $notify = 'Chỉnh sửa phần tử thành công';
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with('zvn_notify', $notify);
        }
    }

    public function delete(Request $request)
    {
    	$params['id'] = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Xóa phẩn tử thành công');
    }

    public function status(Request $request)
    {
        $params['id'] = $request->id;
        $params['currentStatus'] = $request->status;
        $this->model->saveItem($params, ['task' => 'change-status']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Thay đổi trạng thái thành công');
    }

    public function type(Request $request)
    {
        $params['id'] = $request->id;
        $params['news_type'] = $request->type;
        $this->model->saveItem($params, ['task' => 'change-type']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Thay đổi kiểu bài viết thành công');
    }

    //====================== NEWS ======================
    public function news(Request $request)
    { 
        $categoryModel = new Category;

        $this->params['id'] = $request->articleId;
        $itemArticle = $this->model->getItem($this->params, ['task' => "get-item"]);

        $this->params['id'] = $itemArticle['category_id']; 
        $itemCategory = $categoryModel->getItem($this->params, ['task' => 'get-item']);
        $itemCategory['articles'] = $this->model->listItems($this->params, ['task' => "list-article-of-category"]);

        $lastestArticle = $this->model->listItems($this->params, ['task' => "lastest-article"]);
    	return view($this->pathViewControllerWeb . 'detail', [
            'params' => $this->params,
            'itemArticle' => $itemArticle,
            'lastestArticle' => $lastestArticle,
            'itemCategory' => $itemCategory
        ]);
    }
}
