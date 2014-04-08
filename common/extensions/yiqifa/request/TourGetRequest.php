<?php
/** API:open.tour.get
 * 
 * @author lsj
 * 
 */
class TourGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Tour���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ������·��id
	 */
	private $tour_id;
	/**
	 * ������·���̼���վ��ԭʼ����
	 */
	private  $tour_url;


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
	
	
	public function getTour_id() {
		return $this->tour_id;
	}
	
	public function getTour_url() {
		return $this->tour_url;
	}
	
	public function setTour_id($tour_id) {
		$this->tour_id = $tour_id;
		$this->apiParams["tour_id"] = $tour_id;
	}

	public function setTour_url($tour_url) {
		$this->tour_url = $tour_url;
		$this->apiParams["tour_url"] = $tour_url;
	}

	public function getApiMethodName()
	{
		return "open.tour.get";
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