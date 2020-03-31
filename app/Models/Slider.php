<?php

namespace App\Models;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class Slider extends Admin
{
    public function __construct()
    {
        $this->table = "slider";
        $this->folderUpload = 'slider';
        $this->fieldSearchAccepted = ['id', 'name', 'description', 'link'];
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if($options['task'] == "admin-list-items")
        {
            $query = $this->select('id','name', 'description', 'link', 'thumb','created', 'created_by', 'modified', 'modified_by', 'status');

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
            $query = $this->select('id','name', 'description', 'link', 'thumb');
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

        if($options['task'] == "add-item")
        {
            $model->name = $params['name'];
            $model->description = $params['description'];
            $model->link = $params['link'];
            $nameImage = $this->uploadThumb($params['thumb']);
            $model->thumb = $nameImage;
            $model->status = $params['status'];
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
            $edit->description = $params['description'];
            $edit->link = $params['link'];
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
            $result = self::select('id', 'name', 'description', 'status', 'link', 'thumb')->where('id', $params['id'])->first();
        }
        if($options['task'] == "get-thumb")
        {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }
        return $result;
    }
}
