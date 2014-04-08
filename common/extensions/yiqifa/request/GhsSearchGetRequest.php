<?php
/** API:open.ghs.search
 * 
 * @author lsj
 * 
 */
class GhsSearchGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Ghs���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 *��������Ʒ���࣬��ѡֵ������ֶ��á�,���ָ�
	 */
	private $keyword;
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
	
	
	public function getKeyword() {
		return $this->keyword;
	}
	
	public function getPage_no() {
		return $this->page_no;
	}
	
	public function getPage_size() {
		return $this->page_size;
	}

	
	public function setKeyword($keyword) {
		$this->keyword = $keyword;
		$this->apiParams["keyword"] = $keyword;
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
		return "open.ghs.search";
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