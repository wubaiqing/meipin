<?php

/**
 * Description of DataResult
 *
 * @author liukui<liujickson@gmail.com>
 */
class DataResult implements \IteratorAggregate, \ArrayAccess
{

    /**
     * 数据返回状态
     * @var boolean 
     */
    public $status = true;

    /**
     * 数据返回状态码
     * @var string 
     */
    public $code = 0;

    /**
     * 数据返回结果
     * @var fixed 
     */
    public $data;

    /**
     * 数据返回描述
     * @var string 
     */
    public $message = "";
    /**
     * 数据返回错误提示
     * @var string 
     */
    public $errorMsg = "";

    /**
     * 强制将对象转换为数组
     * @return type
     */
    public function getArray()
    {
        return get_object_vars($this);
    }

    /**
     * Returns an iterator for traversing the attributes in the model.
     * This method is required by the interface IteratorAggregate.
     * @return CMapIterator an iterator for traversing the items in the list.
     */
    public function getIterator()
    {
        $attributes = $this->getArray();
        return new \ArrayIterator($attributes);
    }

    /**
     * Returns whether there is an element at the specified offset.
     * This method is required by the interface ArrayAccess.
     * @param mixed $offset the offset to check on
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    /**
     * Returns the element at the specified offset.
     * This method is required by the interface ArrayAccess.
     * @param integer $offset the offset to retrieve element.
     * @return mixed the element at the offset, null if no element is found at the offset
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Sets the element at the specified offset.
     * This method is required by the interface ArrayAccess.
     * @param integer $offset the offset to set element
     * @param mixed $item the element value
     */
    public function offsetSet($offset, $item)
    {
        $this->$offset = $item;
    }

    /**
     * Unsets the element at the specified offset.
     * This method is required by the interface ArrayAccess.
     * @param mixed $offset the offset to unset element
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

}
