<?php 
/**
 * API:open.hotel.get
 * 
 * @author lsj
 *
 */
class HotelGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Product���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * �Ƶ��id
	 */
	private $hotel_id;
	/**
	 * �����ھƵ��ṩ�̵��̼һ�ȡ��url
	 */
	private  $hotel_url;
	

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
	
	
	public function getHotel_id() {
		return $this->hotel_id;
	}
	
	public function getHotel_url() {
		return $this->hotel_url;
	}
	
	public function setHotel_id($hotel_id) {
		$this->hotel_id = $hotel_id;
		$this->apiParams["hotel_id"] = $hotel_id;
	}

	public function setHotel_url($hotel_url) {
		$this->hotel_url = $hotel_url;
		$this->apiParams["hotel_url"] = $hotel_url;
	}

	public function getApiMethodName()
	{
		return "open.hotel.get";
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