<?php
/** API:open.website.get
 * 
 * @author lsj
 * 
 */
class WebsiteGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Website���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * �̼�����type��1->yqfWebSite(���𷢺����̼�), 2->pdtWebSite(ץȡ��Ʒ��Ϣ���̼�)
	 */
	private $type;
	
	/**
	 * �̼�id
	 */
	private $webid;
	
	
	private $apiParams = array();
	
	public function getWebid() {
		return $this->$webid;
	}
	public function setWebid($webid) {
		$this->webid = $webid;
		$this->apiParams["webid"] = $webid;
	}

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
		return "open.website.get";
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