<?php

namespace App\Models;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class Category extends Admin
{
    public function __construct()
    {
        $this->table = "category";
        $this->folderUpload = 'category';
        $this->fieldSearchAccepted = ['id', 'name', 'description', 'link'];
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'article');
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if($options['task'] == "admin-list-items")
        {
            $query = $this->select('id','name', 'created', 'created_by', 'modified', 'modified_by', 'status','is_home','display');

            if($params['filter']['status'] !== 'all')
            {
                $query->where('status', $params['filter']);
            }

            if($params['search']['value'] !== '')
            {
                if($params['search']['field'] == 'all'){

                }else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if($options['task'] == "news-list-items")
        {
            $query = $this->select('id','name');
            $result = $query->where('status','active')->get()->toArray();
        }

        if($options['task'] == "list-category-is-home")
        {
            $query = $this->select('id','name','display');
            $result = $query->where([['is_home','yes'], ['status','active']])->get()->toArray();
        }

        if($options['task'] == "list-category-in-selectbox")
        {
            $query = $this->select('id','name');
            $result = $query->where('status','active')->get()->pluck('name','id')->toArray();
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
            $newStatus = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])
                ->update(['status' => $newStatus]);
        }

        if($options['task'] == "change-is-home")
        {
            $newIsHome = ($params['current_isHome'] == "yes") ? "no" : "yes";
            self::where('id', $params['id'])
                ->update(['is_home' => $newIsHome]);
        }

        if($options['task'] == "change-display")
        {
            $display = $params['news_display'];
            self::where('id', $params['id'])
                ->update(['display' => $display]);
        }

        if($options['task'] == "add-item")
        {
            $model->name = $params['name'];
            $model->status = $params['status'];
            $model->created_by = 'do huynh duc';
            $model->modified_by = 'do huynh duc';
            $model->save();
        }

        if($options['task'] == "edit-item")
        {
            $edit = $model::find($params['id']);
            $edit->name = $params['name'];
            $edit->status = $params['status'];
            $edit->created_by = 'do huynh duc';
            $edit->modified_by = 'do huynh duc';
            $edit->save();
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == "delete-item")
        {
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == "get-item")
        {
            $result = self::select('id', 'name', 'status')->where('id', $params['id'])->first();
        }
        return $result;
    }
}
