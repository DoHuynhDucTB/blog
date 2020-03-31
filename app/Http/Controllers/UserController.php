<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User as MainRequest;
use App\Http\Requests\Auth as AuthRequest;

class UserController extends Controller
{
    private $pathViewController = 'admin.user.';
    private $pathViewControllerWeb = 'news.user.';
    private $controllerName = 'user';
    private $params = [];
    private $model;

    public function __construct()
    {
        $this->model = new User();    
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
            'item' => $item,
            'id' => $request->id
        ]);
    }

    public function password(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi mật khẩu thành công!");
        }
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

    public function login(Request $request)
    {
        if($request->session()->has('userInfo'))  return redirect()->route('dashboard');
        return view($this->pathViewControllerWeb . 'login');
    }

    public function postLogin(AuthRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $userModel = new $this->model;
            $userInfo = $userModel->getItem($params, ['task' => 'auth-login']);

            if (!$userInfo)
                return redirect()->route($this->controllerName . '/login')->with('news_notify', 'Tài khoản hoặc mật khẩu không chính xác!');

            $request->session()->put('userInfo', $userInfo);
            return redirect()->route('dashboard');
        }
    }

    public function logout(Request $request)
    {
        if($request->session()->has('userInfo')) $request->session()->pull('userInfo');
        return redirect()->route($this->controllerName . '/login');
    }
}
