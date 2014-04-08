<?php 
/**
 * API:open.tour.search
 * 
 * @author lsj
 *
 */
class TourSearchGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Tour���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ��������
	 */
	private $city_begin;
	/**
	 * �����ؼ��ʣ�������������·��Ŀ�ĵء�Ŀ�ĳ��С����ξ���ȷ���
	 */
	private  $keyword;
	/**
	 * ҳ�루>0����Ȼ������1�����1ҳ��2�����2ҳ���������ƣ�Ĭ��ֵΪ1�����ص������ǵ�1ҳ
	 */
	private  $page_no;
	/**
	 * ÿҳ������>0��Ȼ������ÿҳ�������100����Ĭ��ֵΪ40
	 */
	private  $page_size;
	/**
	 *����2��ֵ��[����,����ʽ]������ֻ��Price��days������ʽ�֣�1=�ӵ͵��ߣ�2=�Ӹߵ���
	 */
	private  $orderby;

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
	
	
	public function getCity_begin() {
		return $this->city_begin;
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
	
	public function getOrderby() {
		return $this->orderby;
	}

	
	public function setOrderby($orderby) {
		$this->orderby = $orderby;
		$this->apiParams["orderby"] = $orderby;
	}

	public function setPage_size($page_size) {
		$this->page_size = $page_size;
		$this->apiParams["page_size"] = $page_size;
	}

	
	public function setKeyword($keyword) {
		$this->keyword = $keyword;
		$this->apiParams["keyword"] = $keyword;
	}

    public function setPage_no($page_no) {
		$this->page_no = $page_no;
		$this->apiParams["page_no"] = $page_no;
	}

	public function setCity_begin($city_begin) {
		$this->city_begin = $city_begin;
		$this->apiParams["city_begin"] = $city_begin;
	}

	public function getApiMethodName()
	{
		return "open.tour.search";
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