<?php

namespace App\Models;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class Article extends Admin
{
    public function __construct()
    {
        $this->table = "article";
        $this->folderUpload = 'article';
        $this->fieldSearchAccepted = ['id', 'name', 'link'];
    }

    public function category()
    {
        return $this->belongsto(Category::class, 'category');
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if($options['task'] == "admin-list-items")
        {
            $query = $this->select('id','name', 'created', 'created_by', 'modified', 'modified_by', 'status', 'thumb', 'category_id', 'type');

            if($params['filter']['status'] !== 'all')
            {
                $query->where('status', $params['filter']);
            }

            $result = $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if($options['task'] == "list-featured-article")
        {
            $query = $this->select('id','name', 'content', 'created', 'created_by', 'modified', 'modified_by', 'status', 'thumb', 'category_id', 'type')
                          ->where([['status','active'],['type','featured']])
                          ->orderBy('id', 'desc')
                          ->take(3);
                          
            $result = $query->get()->toArray();
        }

        if($options['task'] == "lastest-article")
        {
            $query = $this->select('id','name', 'content', 'created', 'created_by', 'modified', 'modified_by', 'status', 'thumb', 'category_id', 'type')
                          ->where('status','active')
                          ->orderBy('id', 'desc')
                          ->take(4);
                          
            $result = $query->get()->toArray();
        }

        if($options['task'] == "list-article-of-category")
        {
            $query = $this->select('id','name', 'content', 'created', 'created_by', 'thumb', 'category_id')
                          ->where([['status','active'], ['category_id',$params['id']]])
                          ->orderBy('id', 'desc')
                          ->take(4);
                          
            $result = $query->get()->toArray();
        }

        if($options['task'] == "news-list-items")
        {
            $query = $this->select('id','name');
            $result = $query->where('status','active')->get()->toArray();
        }

        if($options['task'] == "list-category-is-home")
        {
            $query = $this->select('id','name','display');
            $result = $query->where([['status','active']])->get()->toArray();
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

        if($options['task'] == "change-type")
        {
            $type = $params['news_type'];
            self::where('id', $params['id'])
                ->update(['type' => $type]);
        }

        if($options['task'] == "add-item")
        {
            $model->name = $params['name'];
            $model->status = $params['status'];
            $model->category_id = $params['category_id'];
            $nameImage = $this->uploadThumb($params['thumb']);
            $model->thumb = $nameImage;
            $model->content = $params['content'];
            $model->type = $params['type'];
            $model->created_by = 'do huynh duc';
            $model->modified_by = 'do huynh duc';
            $model->save();
        }

        if($options['task'] == "edit-item")
        {
            $edit = $model::find($params['id']);
            if(!empty($params['thumb'])){
                $this->deleteThumb($params['thumb_current']);
                $nameImage = $this->uploadThumb($params['thumb']);
                $edit->thumb = $nameImage;
            }else{
                $edit->thumb = $params['thumb_current'];
            }
            
            $edit->name = $params['name'];
            $edit->status = $params['status'];
            $edit->category_id = $params['category_id'];
            $edit->content = $params['content'];
            $edit->type = $params['type'];
            $edit->created_by = 'do huynh duc';
            $edit->modified_by = 'do huynh duc';
            $edit->save();
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == "delete-item")
        {
            $item = self::getItem($params, ['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if($options['task'] == "get-item")
        {
            $result = self::select('id','name','status','content','thumb','category_id','type', 'created')->where('id', $params['id'])->first();
        }

        if($options['task'] == "get-thumb")
        {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }
        return $result;
    }
}
