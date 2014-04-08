<?php 
/**
 * API:open.product.link.convert
 * 
 * @author lsj
 *
 */
class ProductLinkGetRequest
{
	/**
	 * ��ѯ�ֶΣ�ProductLink���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ��Ʒ�����̼���վ��ԭʼurl��������д���ֵ��֮���á�,���ָ���ֵ������1~1000��url�����ԡ�http://����ͷ
	 */
	private $pdt_url;
	/**
	 * �̼ҵ����ͣ���2�֣�1=���𷢺����̼ң�2=ץȡ��Ʒ��Ϣ���̼�
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
	
	
	public function getWtype() {
		return $this->type;
	}	
	public function getPdt_url() {
		return $this->pdt_url;
	}

	
	public function setWtype($type) {
		$this->type = $type;
		$this->apiParams["type"] = $type;
	}

	public function setPdt_url($pdt_url) {
		$this->pdt_url = $pdt_url;
		$this->apiParams["pdt_url"] = $pdt_url;
	}
	public function getApiMethodName()
	{
		return "open.product.link.convert";
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