<?php 
/**
 * API:open.discount.product.list.get
 * 
 * @author lsj
 *
 */
class DiscountProductListGetRequest
{
	/**
	 * ��ѯ�ֶΣ�DiscountProduct���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ҳ�루>0����Ȼ��):1�����1ҳ��2�����2ҳ���������ƣ�Ĭ��ֵΪ1�����ص������ǵ�1ҳ
	 */
	private $page_no;
	/**
	 * ÿҳ������>0��Ȼ��):ÿҳ�������100����Ĭ��ֵΪ40�� page_no��page_size��5000
	 */
	private $page_size;
	/**
	 * �Ź���Ʒ����id���ɶ�ֵ��ֵ֮���á�,���ָ���id����ͨ��open.tuan.category.get��ȡ��Ĭ��Ϊ�գ�����ȫ��������
	 */
	private  $catid;
    /**
	 *�̼ҵ�id����д���ֵ��ֵ֮���á�,���ָ���id����ͨ��open.tuan.merchant.get��ȡ��Ĭ��Ϊ�գ��򷵻������̼ҵ���Ʒ
	 */
	private  $web_id;
	/**
	 * ��Ʒ�ļ۸�����:��Price_range=��ͼ۸�,��߼۸񡱣�֮���á�,��������:Price_range=50,300���۸���Ϊ���������С�,��ǰ��ֵ�ܡ�,�����ֵ��Ĭ��Ϊ�գ��������м۸����Ʒ
	 */
	
	private  $price_range;

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

	/**
	 * @return the $page_no
	 */
	public function getPage_no() {
		return $this->page_no;
	}

	/**
	 * @return the $page_size
	 */
	public function getPage_size() {
		return $this->page_size;
	}

	/**
	 * @return the $catid
	 */
	public function getCatid() {
		return $this->catid;
	}
	/**
	 * @return the $web_id
	 */
	public function getWeb_id() {
		return $this->web_id;
	}

	/**
	 * @return the $price_range
	 */
	public function getPrice_range() {
		return $this->price_range;
	}

	/**
	 * @param field_type $page_no
	 */
	public function setPage_no($page_no) {
		$this->page_no = $page_no;
		$this->apiParams["page_no"] = $page_no;
	}

	/**
	 * @param field_type $page_size
	 */
	public function setPage_size($page_size) {
		$this->page_size = $page_size;
		$this->apiParams["page_size"] = $page_size;
	}

	/**
	 * @param field_type $catid
	 */
	public function setCatid($catid) {
		$this->catid = $catid;
		$this->apiParams["catid"] = $catid;
	}


	/**
	 * @param field_type $web_id
	 */
	public function setWeb_id($web_id) {
		$this->web_id = $web_id;
		$this->apiParams["web_id"] = $web_id;
	}

	/**
	 * @param field_type $price_range
	 */
	public function setPrice_range($price_range) {
		$this->price_range = $price_range;
		$this->apiParams["price_range"] = $price_range;
	}

	public function getApiMethodName()
	{
		return "open.discount.product.list.get";
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