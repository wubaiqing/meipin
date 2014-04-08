<?php 
/**
 * API:open.product.p.crumbs.get
 * 
 * @author lsj
 *
 */
class ProductPCrumbsGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Product���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ��Ʒid
	 */
	private $pdt_id;
	/**
	 * ��Ʒurl���ӣ�ͨ���̼�ҳ���ȡ
	 */
	private  $pdt_url;

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
	
	
	public function getPdt_id() {
		return $this->pdt_id;
	}
	
	public function getPdt_url() {
		return $this->pdt_url;
	}
	
	public function setPdt_id($pdt_id) {
		$this->pdt_id = $pdt_id;
		$this->apiParams["pdt_id"] = $pdt_id;
	}

	public function setPdt_url($pdt_url) {
		$this->pdt_url = $pdt_url;
		$this->apiParams["pdt_url"] = $pdt_url;
	}

	public function getApiMethodName()
	{
		return "open.product.p.crumbs.get";
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