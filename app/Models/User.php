<?php

namespace App\Models;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class User extends Admin
{
    public function __construct()
    {
        $this->table = "user";
        $this->folderUpload = 'user';
        $this->fieldSearchAccepted = ['id', 'username'];
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if($options['task'] == "admin-list-items")
        {
            $query = $this->select('id', 'username', 'fullname', 'email', 'avatar', 'created', 'created_by', 'modified', 'modified_by', 'status', 'level');

            if($params['filter']['status'] !== 'all')
            {
                $query->where('status', $params['filter']);
            }

            if($params['search']['value'] !== '')
            {
                if($params['search']['field'] == 'all')
                {

                }else if(in_array($params['search']['field'], $this->fieldSearchAccepted))
                {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if($options['task'] == "news-list-items")
        {
            $query = $this->select('id','username', 'description', 'avatar');
            $result = $query->where('status','active')->get();
        }
        return $result;
    }

    public function CountItems($params = null, $options = null)
    {
        $result = null;

        if($options['task'] == "admin-count-items-group-by-status")
        {
            $result = self::select(DB::raw('count(id) as count, status'))
                ->groupBy('status')
                ->get()
                ->toArray();
        }
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {  
        $model = new self;

        if($options['task'] == "change-status")
        {
            $newStatus = ($params['currentStatus'] =="active") ? "inactive" : "active";
            self::where('id', $params['id'])
                ->update(['status' => $newStatus]);
        }

        if($options['task'] == 'change-password') 
        {
            $password       = md5($params['password']);
            self::where('id', $params['id'])
                ->update(['password' => $password]);
        }

        if($options['task'] == "add-item")
        {
            $model->username = $params['username'];
            $model->fullname = $params['fullname'];
            $model->email = $params['email'];
            $model->password = md5($params['password']);
            $nameImage = $this->uploadThumb($params['avatar']);
            $model->avatar = $nameImage;
            $model->status = $params['status'];
            $model->level = $params['level'];
            $model->created_by = 'do huynh duc';
            $model->modified_by = 'do huynh duc';
            $model->save();
        }

        if($options['task'] == "edit-item")
        {
            $edit = $model::find($params['id']);
            if(!empty($params['avatar'])){
                $this->deleteThumb($params['avatar_current']);
                $nameImage = $this->uploadThumb($params['avatar']);
                $edit->avatar = $nameImage;
            }else{
                $edit->avatar = $params['avatar_current'];
            }
            $edit->username = $params['username'];
            $edit->fullname = $params['fullname'];
            $edit->email = $params['email'];
            $edit->status = $params['status'];
            $edit->level = $params['level'];
            $edit->created_by = 'do huynh duc';
            $edit->modified_by = 'do huynh duc';
            $edit->save();
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == "delete-item")
        {
            $item = self::getItem($params, ['task' => 'get-avatar']);
            $this->deleteThumb($item['avatar']);
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if($options['task'] == "get-item")
        {
            $result = self::select('id', 'username', 'fullname', 'email', 'avatar', 'status', 'level')->where('id', $params['id'])->first();
        }

        if($options['task'] == "get-avatar")
        {
            $result = self::select('id', 'avatar')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'auth-login') {
            $result = self::select('id', 'username', 'fullname', 'email', 'level', 'avatar', 'status')
                    ->where('status', 'active')
                    ->where('email', $params['email'])
                    ->where('password', md5($params['password']) )->first();

            if($result) $result = $result->toArray();
        }

        return $result;
    }
}
