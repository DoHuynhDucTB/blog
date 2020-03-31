<?php
namespace App\Helpers;

class Template{
    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus)
    {
        $xhtml = null;

        $tmplStatus = Config('zvn.template.status');

        array_unshift($itemsStatusCount,[
            'status' => 'all', 
            'count' => array_sum(array_column($itemsStatusCount, 'count'))
            ]
        );

        if(count($itemsStatusCount) >= 0)
        {
            foreach($itemsStatusCount as $item){
                $itemStatus = $item['status'];
                $itemStatus = array_key_exists($itemStatus, $tmplStatus) ? $itemStatus : 'default';
                $currentStatus = $tmplStatus[$itemStatus];
                $class = ($currentFilterStatus == $itemStatus) ? 'btn-success' : $currentStatus['class'];
                $link = route($controllerName) . '?filter_status=' . $itemStatus;
                $xhtml .= sprintf(
                    '<a href=" %s " type="button" class="btn %s"> %s <span class="badge bg-white"> %s </span>
                    </a>', $link, $class, $currentStatus['name'], $item['count']
                );
            }
        }
        return $xhtml;
    }

    public static function showAreaSearch($controllerName, $paramsSearch)
    {
        $xhtml = null;

        $tmplFiled = Config('zvn.template.search');
        $fieldController = Config('zvn.config.search');

        $controllerName =  array_key_exists($controllerName, $fieldController) ? $controllerName : 'default';
        $xhtmlField = null;
        foreach($fieldController[$controllerName] as $field){
            $xhtmlField .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>', 
            $field, $tmplFiled[$field]['name']);
        }

        $searchField = (in_array($paramsSearch['field'], $fieldController[$controllerName])) ? $paramsSearch['field'] : 'all';
        $searchValue = $paramsSearch['value'];
        $xhtml = sprintf(
            '<div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle btn-active-field" data-toggle="dropdown" aria-expanded="false">
                       %s <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">%s</ul>
                </div>
                <input type="text" class="form-control" name="search_value" value="%s">
                <span class="input-group-btn">
                    <button id="btn-clear-search" type="button" class="btn btn-success" style="margin-right: 0px">Xóa tìm kiếm</button>
                    <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                </span>
                <input type="hidden" name="search_field" value="all">
            </div>', $tmplFiled[$searchField]['name'], $xhtmlField, $searchValue
        );
        return $xhtml;
    }

    public static function showItemHistory($by, $time)
    {
        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i> %s </p>
            <p><i class="fa fa-clock-o"></i> %s </p>', $by, date_format($time, config('zvn.format_time.short_time'))
        );
        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $status)
    {
        $tmpl = Config('zvn.template.status');

        $link = route("$controllerName/status", ['id' => $id, 'status' => $status]);
        $status = array_key_exists($status, $tmpl) ? $status : 'default';
        $xhtml = sprintf(
            '<a href=" %s " type="button" class="btn btn-round %s "> %s </a></td>', $link, $tmpl[$status]['class'], $tmpl[$status]['name']
        );
        return $xhtml;
    }

    public static function showCategoryHome($controllerName, $id, $isHome)
    {
        $tmpl = Config('zvn.template.isHome');
        $link = route("$controllerName/is_home", ['id' => $id, 'is_home' => $isHome]);
        $isHome = array_key_exists($isHome, $tmpl) ? $isHome : 'yes';
        $xhtml = sprintf('<a href="%s" type="button" class="btn btn-round %s">%s</a></td>', 
            $link, $tmpl[$isHome]['class'], $tmpl[$isHome]['name']
        );
        return $xhtml;
    }

    public static function showItemSelect($controllerName, $id, $value, $fieldName)
    {
        $tmpl = Config("zvn.template." . $fieldName);
        $xhtml = '';
        $link = route("$controllerName/$fieldName", ['id' => $id, $fieldName => 'value-new']);
        if(count($tmpl) > 0){
            $xhtml = sprintf('<select name="select_change_attr" class="form-control" data-url="%s">', $link);
            foreach($tmpl as $key => $item){
                $selected = '';
                ($value === $key) ? $selected = 'selected' : '';
                $xhtml .= sprintf('<option value="%s"%s>%s</option>', $key, $selected, $item['name']);
            }
            $xhtml .= '</select>';
        }
        return $xhtml;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt)
    {
        $urlImg = asset('images/' . $controllerName . '/' . $thumbName);
        $xhtml = sprintf(
            '<img src=" %s " alt=" %s " class="zvn-thumb">', $urlImg, $thumbAlt
        );
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        $tmplButton = Config('zvn.template.button');
        $buttonInArea = Config('zvn.config.button');

        $xhtml = '<div class="zvn-box-btn-filter">';
        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : "default";
        $listsButton = $buttonInArea[$controllerName];
        foreach($listsButton as $btn)
        {
            $currentButton = $tmplButton[$btn];
            $xhtml .= sprintf(
                        '<a href=" %s " type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
                            <i class="fa %s"></i>
                        </a>', route($controllerName . $currentButton['route-name'], ['id' => $id]), $currentButton['class'], $currentButton['title'], $currentButton['icon']);
        }
        $xhtml .= '</div>';
        return $xhtml;
    }

    public static function showDateTimeWeb($date){
        $typeFormat = Config('zvn.format_time.short_time');
        $dateFormat = date_format(date_create($date), $typeFormat);
        $xhtml = '<div class="post_date"><a href="#">'.$dateFormat.'</a></div>';
        return $xhtml;
    }

    public static function showContentSmall($content, $length){
        $content = str_replace(['<p>','</p>'], '', $content);
        $xhtml = preg_replace('/\s+?(\S+)?$/','', substr($content, 0, $length)) . '...';
        return $xhtml;
    }
}
?>
