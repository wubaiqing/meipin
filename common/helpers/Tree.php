<?php

class Tree
{
    public $items;

    protected $idKey;

    protected $parentKey;

    public function __construct($items, $idKey = 'id', $parentKey = 'parent_id')
    {
        $this->list = $items;
        $this->items = Tree::toTree($items);
        $this->idKey = $idKey;
        $this->parentKey = $parentKey;
    }

    public function getChild($parentId, $items = array())
    {
        $child = array();
        foreach ($this->list as $item) {
            if ($item['parent_id'] == $parentId) {
                $child[$item[$this->idKey]] = $item;
            }
        }

        return $child;
    }

    public function getAllChild($root)
    {
        static $child = array();

        $nodes = $this->getChild($root);
        foreach ($nodes as $node) {
            $child[$node[$this->idKey]] = $node;
            $this->getAllChild($node[$this->idKey]);
        }

        return $child;
    }

    public static function toArray($models)
    {
        $items = array();
        foreach ($models as $id => $model) {
            $items[$id] = $model->attributes;
        }

        return $items;
    }

    public static function toTree($items, $root = 0, $parentKey = 'parent_id')
    {
        static $list;

        if ($list !== null) {
            return $list;
        }

        $list = array();

        foreach ($items as $key => &$val ) {
            $parentId = $val[$parentKey];
            if ($root == $parentId) {
                $list[] = &$val;
            } else {
                if (isset($items[$parentId])) {
                    $parent = &$items[$parentId];
                    $parent['_child'][] = &$val;
                }
            }
        }

        return $list;
    }
}
