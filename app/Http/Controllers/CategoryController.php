<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Http\Requests\Category as MainRequest;

class CategoryController extends Controller
{
    private $pathViewController = 'admin.category.';
    private $controllerName = 'category';

    private $pathViewControllerWeb = 'news.category.';
    private $params = [];
    private $model;

    public function __construct()
    {
        $this->model = new Category();    
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
        return view($this->pathViewController . 'form', [
            'item' => $item
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

    public function is_home(Request $request)
    {
        $params['id'] = $request->id;
        $params['current_isHome'] = $request->is_home;
        $this->model->saveItem($params, ['task' => 'change-is-home']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Thay đổi trạng thái thành công');
    }

    public function display(Request $request)
    {
        $params['id'] = $request->id;
        $params['news_display'] = $request->display;
        $this->model->saveItem($params, ['task' => 'change-display']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Thay đổi trạng thái hiển thị thành công');
    }

    //====================== NEWS ======================
    public function news(Request $request)
    { 
        $articleModel = new Article;
        $lastestArticle = $articleModel->listItems($this->params, ['task' => "lastest-article"]);

        $this->params['id'] = $request->categoryId; 
        $itemCategory = $this->model->getItem($this->params, ['task' => 'get-item']);
        $itemCategory['articles'] = $articleModel->listItems($this->params, ['task' => "list-article-of-category"]);

    	return view($this->pathViewControllerWeb . 'category', [
            'params' => $this->params,
            'itemCategory' => $itemCategory,
            'lastestArticle' => $lastestArticle
        ]);
    }
}
