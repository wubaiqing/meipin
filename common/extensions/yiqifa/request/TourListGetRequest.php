<?php
/** API:open.tour.list.get
 * 
 * @author lsj
 * 
 */
class TourListGetRequest
{
	/**
	 * ��ѯ�ֶΣ�TourList���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ��·�����ڣ���ѡֵ������ֶ��á�,���ָ�
	 */
	private $days;
	/**
	 * ������·�ļ۸����䣬��ѡֵ���á�,���ָ�
	 */
	private  $price_range;
	/**
	 * ������·���ṩ�̵�id������ѡֵ������ֶ��á�,���ָ�
	 */
	private  $provider_id;
	/**
	 * �������ڣ������������ں��������ڣ�date[]����2��ֵ��date[��������,��������]
	 */
	private   $tdate;
	/**
	 * ҳ�루>0����Ȼ������1�����1ҳ��2�����2ҳ���������ƣ�Ĭ��ֵΪ1�����ص������ǵ�1ҳ
	 */
	private   $page_no;
	/**
	 * ÿҳ������>0��Ȼ������ÿҳ�������100����Ĭ��ֵΪ40
	 */
	private   $page_size;
	/**
	 * �������У�һ����಻����10������
	 */
	private    $city_begin;

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
	
	
	public function getDays() {
		return $this->days;
	}
	
	public function getPrice_range() {
		return $this->price_range;
	}
	
	public function getProvider_no() {
		return $this->provider_no;
	}
	public function getTdate() {
		return $this->tdate;
	}
	
	public function getPage_no() {
		return $this->page_no;
	}
	
	public function getPage_size() {
		return $this->page_size;
	}
	
	public function getCity_begin() {
		return $this->city_begin;
	}
	
	public function setDays($days) {
		$this->days = $days;
		$this->apiParams["days"] = $days;
	}

	public function setPrice_range($price_range) {
		$this->price_range = $price_range;
		$this->apiParams["price_range"] = $price_range;
	}

	
	public function setProvider_id($provider_id) {
		$this->provider_id = $provider_id;
		$this->apiParams["provider_id"] = $provider_id;
	}
	
	
	public function setTdate($tdate) {
		$this->tdate = $tdate;
		$this->apiParams["date"] = $tdate;
	}

	public function setPage_no($page_no) {
		$this->page_no = $page_no;
		$this->apiParams["page_no"] = $page_no;
	}

	
	public function setPage_size($page_size) {
		$this->page_size = $page_size;
		$this->apiParams["page_size"] = $page_size;
	}
	public function setCity_begin($city_begin) {
		$this->city_begin = $city_begin;
		$this->apiParams["city_begin"] = $city_begin;
	}

	public function getApiMethodName()
	{
		return "open.tour.list.get";
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