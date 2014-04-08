<?php
/**
 * API:open.tuan.city.get
 * 
 * @author lsj
 *
 */
class TuanCityGetRequest
{
	/**
	 * ��ѯ�ֶΣ�TuanCity���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * �̼�����type��1->yqfWebSite(���𷢺����̼�), 2->pdtWebSite(ץȡ��Ʒ��Ϣ���̼�)
	 */
	private $type;
	
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
	public function setWtype($type)
	{
		$this->type = $type;
		$this->apiParams[type] = $type;
	}
	public function getWtype()
	{
		return $this->type;
	}
	public function getApiMethodName()
	{
		return "open.tuan.city.get";
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