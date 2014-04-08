<?php
/**
 * API:open.comment.get
 * 
 * @author lsj
 *
 */
class CommentsGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Comments���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 *ץȡ��Ʒ��id:����ͨ��open.product.search��open.product.list.get��ȡ����id������ͬһ�̼ҵ���Ʒ��ֵ��1-1000��
	 */
	private $pdt_id;
	/**
	 *�̼ҵ�id
	 */
	private $webid;
	/**
	 *���۵�����:��ѡֵ������ֶ��á�,���ָ���ֵ������ good=������normal=������less=������Ĭ��Ϊ�գ�������ȫ�����͵�����
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
	public function setPdt_id($pdt_id)
	{
		$this->pdt_id = $pdt_id;
		$this->apiParams["pdt_id"] = $pdt_id;
	}
	public function getPdt_id()
	{
		return $this->pdt_id;
	}
	public function setWebid($webid)
	{
		$this->webid = $webid;
		$this->apiParams["webid"] = $webid;
	}
	public function getWebid()
	{
		return $this->webid;
	}
	public function setWtype($type)
	{
		$this->type = $type;
		$this->apiParams["type"] = $type;
	}
	public function getWtype()
	{
		return $this->type;
	}
	
	public function getApiMethodName()
	{
		return "open.comment.get";
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