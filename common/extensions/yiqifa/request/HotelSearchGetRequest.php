<?php 
/**
 * API:open.hotel.search
 * 
 * @author lsj
 *
 */
class HotelSearchGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Product���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * �����ؼ��ʣ��ӾƵ��������������
	 */
	private $keyword;
	/**
	 *ҳ�루>0����Ȼ������1�����1ҳ��2�����2ҳ���������ƣ�Ĭ��ֵΪ1�����ص������ǵ�1ҳ
	 */
	private  $page_no;
	/**
	 *ÿҳ������>0��Ȼ������ÿҳ�������100����Ĭ��ֵΪ40
	 */
	private  $page_size;
    /**
	 *������ʼ���ںͽ������ڣ����������á�,���ָ������˴���date��ʽ�������գ��磺2012-12-24��date[]�ĸ�ʽ�����磺date=2012-12-22,2012-12-24
	 */
	private  $tdate;
	/**
	 *�Ƶ����ڵĳ��У����Դ�open.hotel.city.get��ȡ
	 */
	private  $city;
     /**
	  *����2��ֵ��[����,����ʽ]������ֻ��Price������ʽ�֣�1=�ӵ͵��ߣ�2=�Ӹߵ��ͣ�Ĭ��Ϊ�գ���ʾ����ض�����
	  */
	private  $orderby;
     /**
	  *�Ƶ��Ǽ����ɶ�ֵ��ֵ֮���á�,���ָ�,ֵΪ��1������2������3������4������5������6��
	  */
	private  $star;
     /**
	  *�۸����䣬����ֶ��á�,���ָ���Ĭ��Ϊ�գ�����ȫ���۸�����ľƵ�
	  */
	private  $price_range;
     /**
	  *�ṩ�̵�id,�ɶ�ֵ������ֶ��á�,���ָ���Ĭ��Ϊ�գ���ʾ���������ṩ�̵Ĺ��ھƵ�
	  */
	private  $provider_id;

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

	public function getTdate() {
		return $this->tdate;
	}
	
	public function getCity() {
		return $this->city;
	}
	
	public function getOrderby() {
		return $this->orderby;
	}
	public function getStar() {
		return $this->star;
	}
	
	public function getPrice_range() {
		return $this->price_range;
	}
	
	public function getProvider_id() {
		return $this->provider_id;
	}

	
	public function setProvider_id($provider_id) {
		$this->provider_id = $provider_id;
		$this->apiParams["provider_id"] = $provider_id;
	}

	public function setPrice_range($price_range) {
		$this->price_range = $price_range;
		$this->apiParams["price_range"] = $price_range;
	}

	
	public function setStar($star) {
		$this->star = $star;
		$this->apiParams["star"] = $star;
	}

	public function setOrderby($orderby) {
		$this->orderby = $orderby;
		$this->apiParams["orderby"] = $orderby;
	}

	public function setCity($city) {
		$this->city = $city;
		$this->apiParams["city"] = $city;
	}

	
	public function setTdate($tdate) {
		$this->tdate = $tdate;
		$this->apiParams["date"] = $tdate;
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
		return "open.hotel.search";
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