<?php

class TreeDropdownList
{
    public static $icon = '|-';

    protected $items = array();

    protected $model;

    protected $attributeName;

    protected $selected;

    protected $idKey;

    protected $parentKey;

    protected $valueKey;

    public function __construct($model, $attributeName, $selected = 0, $root = 0, $idKey = 'id', $parentKey = 'parent_id', $valueKey = 'name')
    {
        $models = $model->findAll(array(
            'index' => $idKey,
            'order' => $parentKey . ' ASC',
        ));

        foreach ($models as $key => $item) {
            $this->items[$key] = $item->attributes;
        }

        $this->model = $model;
        $this->attributeName = $attributeName;
        $this->selected = $selected;

        $this->idKey = $idKey;
        $this->parentKey = $parentKey;
        $this->valueKey = $valueKey;
    }

    public function dropDownList()
    {
        $list = Tree::toTree($this->items, 0, $this->parentKey);
        $html = '<select name="' . $this->attributeName . '">';
        $html .= '<option value="">无</option>';
        $html .= self::renderOption($list);
        $html .= '</select>';
        return $html;
    }

    protected function renderOption($list, $level = 0)
    {
        $html = '';
        foreach ($list as $item) {
            $append = str_repeat(self::$icon, $level);
            $name = $append . $item[$this->valueKey];
            $selected = $item[$this->idKey] == $this->selected ? 'selected' : '';
            $html .= '<option value="' . $item[$this->idKey] . '" ' . $selected . '>' . $name . '</option>';
            if (isset($item['_child'])) {
                $html .= self::renderOption($item['_child'], $level + 1);
            }
        }

        return $html;
    }

    public function __toString()
    {
        return $this->dropDownList();
    }

}
