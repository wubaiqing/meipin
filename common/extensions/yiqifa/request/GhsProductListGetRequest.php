<?php
/** API:open.ghs.product.list.get
 * 
 * @author lsj
 * 
 */
class GhsProductListGetRequest
{
	/**
	 * ��ѯ�ֶΣ�GhsProduc���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 *��������Ʒ���࣬��ѡֵ������ֶ��á�,���ָ�
	 */
	private $category;
	/**
	 * ҳ�루>0����Ȼ������1�����1ҳ��2�����2ҳ���������ƣ�Ĭ��ֵΪ1�����ص������ǵ�1ҳ��
	 */
	private  $page_no;
	/**
	 * ÿҳ������>0��Ȼ������ÿҳ�������100����Ĭ��ֵΪ40
	 */
	private  $page_size;

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
	
	
	public function getCategory() {
		return $this->category;
	}
	
	public function getPage_no() {
		return $this->page_no;
	}
	
	public function getPage_size() {
		return $this->page_size;
	}

	
	public function setCategory($category) {
		$this->category = $category;
		$this->apiParams["category"] = $category;
	}

	public function setPage_no($page_no) {
		$this->page_no = $page_no;
		$this->apiParams["page_no"] = $page_no;
	}

	
	public function setPage_size($page_size) {
		$this->page_size = $page_size;
		$this->apiParams["page_size"] = $page_size;
	}

	public function getApiMethodName()
	{
		return "open.ghs.product.list.get";
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