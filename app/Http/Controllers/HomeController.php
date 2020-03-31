<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Article;

class HomeController extends Controller
{
    private $pathViewController = 'news.home.';
    private $controllerName = 'home';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $sliderModel = new Slider;  
        $categoryModel = new Category;
        $articleModel = new Article;

        $itemSlider = $sliderModel->listItems($this->params, ['task' => "news-list-items"]);
        $itemCategory = $categoryModel->listItems($this->params, ['task' => "list-category-is-home"]);
        $featuredArticle = $articleModel->listItems($this->params, ['task' => "list-featured-article"]);
        $lastestArticle = $articleModel->listItems($this->params, ['task' => "lastest-article"]);

        foreach($itemCategory as $key => $itemCat){
            $this->params['id'] = $itemCat['id'];
            $itemCategory[$key]['articles'] = $articleModel->listItems($this->params, ['task' => "list-article-of-category"]);
        }

    	return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'itemSlider' => $itemSlider,
            'itemCategory' => $itemCategory,
            'featuredArticle' => $featuredArticle,
            'lastestArticle' => $lastestArticle
        ]);
    }
}
