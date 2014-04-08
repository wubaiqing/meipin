<?php
/**
 * API:open.category.get
 * 
 * @author lsj
 *
 */
class ProductCategoryGetRequest
{
	/**
	 * ��ѯ�ֶΣ�ProductCategory���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ��Ʒ����ĸ���id:Ĭ��Ϊ�գ����ظ�id�µ�ȫ������
	 */
	private $parent_id;
	
	private $apiParams = array();
	
	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParams["fields"] = $fields;
	}
	public function getFields()
	{
		return $this->fields;
	}
	public function setParent_id($parent_id)
	{
		$this->parent_id = $parent_id;
		$this->apiParams[parent_id] = $parent_id;
	}
	public function getParent_id()
	{
		return $this->parent_id;
	}
	public function getApiMethodName()
	{
		return "open.category.get";
	}
	public function getApiParams()
	{
		
		return $this->apiParams;
	}
	public function putOtherTextParam($key,$value)
	{
		$this->apiParams[$key] = $value;
		$this->$key = $value;
	}
	
}
?>