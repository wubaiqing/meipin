<?php
/**
 * API:open.tuan.city.region.get
 * 
 * @author lsj
 *
 */
class TuanCityRegionGetRequest
{
	/**
	 * ��ѯ�ֶΣ�TuanCityRegion���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * �̼�����type��1->yqfWebSite(���𷢺����̼�), 2->pdtWebSite(ץȡ��Ʒ��Ϣ���̼�)
	 */
	private $type;
    /**
	 *����id�����Ի�ȡ��������µ��������򣬿���һ����д�������id��֮���á�,���ָ�������city_id=0ʱ������type������ȫ�����е���������.
	 */
	private $city_id;
	
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
	public function setCity_id($city_id)
	{
		$this->city_id = $city_id;
		$this->apiParams["city_id"] = $city_id;
	}
	public function getCity_id()
	{
		return $this->city_id;
	}
	public function setWtype($type)
	{
		$this->type = $type;
		$this->apiParams[type] = $type;
	}
	public function getWtype()
	{
		return $this->type;
	}
	public function getApiMethodName()
	{
		return "open.tuan.city.region.get";
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