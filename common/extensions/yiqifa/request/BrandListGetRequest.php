<?php
/**
 * API:open.brand.list.get
 * 
 * @author lsj
 *
 */
class BrandListGetRequest
{
	/**
	 * ��ѯ�ֶΣ�BrandList���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;

	/**
	 *Ʒ�Ʒ���id���ɶ�ֵ��ֵ֮���á�,����Ƕ��ŷָ�
	 */
	private $catid;
	
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

	public function setCatid($catid)
	{
		$this->catid = $catid;
		$this->apiParams["catid"] = $catid;
	}
	public function getCatid()
	{
		return $this->catid;
	}
	
	public function getApiMethodName()
	{
		return "open.brand.list.get";
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