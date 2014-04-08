<?php
/** API:open.website.list.get
 * 
 * @author lsj
 * 
 */
class WebsiteListGetRequest
{
	/**
	 * ��ѯ�ֶΣ�WebsiteList���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * �̼�����type��1->yqfWebSite(���𷢺����̼�), 2->pdtWebSite(ץȡ��Ʒ��Ϣ���̼�)
	 */
	private $type;
	
	/**
	 * �̼ҷ����id:�ɴ���ֵ�������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $catid;
	
	
	private $apiParams = array();
	
	public function getCatid() {
		return $this->catid;
	}
	public function setCatid($catid) {
		$this->catid = $catid;
		$this->apiParams["catid"] = $catid;
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
		$this->apiParams['type'] = $type;
	}
	public function getWtype()
	{
		return $this->type;
	}
	public function getApiMethodName()
	{
		return "open.website.list.get";
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
