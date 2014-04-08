<?php 
/**
 * API:open.product.search
 * 
 * @author lsj
 *
 */
class ProductSearchGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Product���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ���������Ĺؼ���:�����38�����֣���76���ַ�����Ʒurl����
	 */
	private $keyword;
	/**
	 * ҳ�루>0����Ȼ��):1�����1ҳ��2�����2ҳ���������ƣ�Ĭ��ֵΪ1�����ص������ǵ�1ҳ
	 */
	private $page_no;
	/**
	 * ÿҳ������>0��Ȼ��):ÿҳ�������100����Ĭ��ֵΪ40�� page_no��page_size��5000
	 */
	private $page_size;
	/**
	 * ����id:����һ����ָ���������id��ʵ���ڴ�ֱ�г���������Ĭ��ֵΪ�գ�����ʵ���ۺ�����
	 */
	private  $catid;
	/**
	 * ץȡ�̼ҵ�id:��д���ֵ��ֵ֮���á�,���ָ���Ĭ��Ϊ�գ����������̼ҵ���Ʒ
	 */
	private  $webid;
	/**
	 * ��Ʒ�ļ۸�����:��Price_range=��ͼ۸�,��߼۸񡱣�֮���á�,��������:Price_range=50,300���۸���Ϊ���������С�,��ǰ��ֵ�ܡ�,�����ֵ��Ĭ��Ϊ�գ��������м۸����Ʒ
	 */
	
	private  $price_range;
	/**
	 * ��������: �����ʶ1Ϊ����ض�����2Ϊ�۸�ӵ͵�������3Ϊ�۸�Ӹߵ�������,Ĭ��ֵΪ1
	 */
	
	private $orderby;
	
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
	 * @return the $keyword
	 */
	public function getKeyword() {
		return $this->keyword;
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
	public function getWebid() {
		return $this->webid;
	}

	/**
	 * @return the $price_range
	 */
	public function getPrice_range() {
		return $this->price_range;
	}

	/**
	 * @return the $oderby
	 */
	public function getOrderby() {
		return $this->oderby;
	}

	/**
	 * @param field_type $keyword
	 */
	public function setKeyword($keyword) {
		$this->keyword = $keyword;
		$this->apiParams["keyword"] = $keyword;
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
	public function setWebid($webid) {
		$this->webid = $webid;
		$this->apiParams["webid"] = $webid;
	}

	/**
	 * @param field_type $price_range
	 */
	public function setPrice_range($price_range) {
		$this->price_range = $price_range;
		$this->apiParams["price_range"] = $price_range;
	}

	/**
	 * @param field_type $oderby
	 */
	public function setOrderby($orderby) {
		$this->orderby = $orderby;
		$this->apiParams["orderby"] = $orderby;
	}

	public function getApiMethodName()
	{
		return "open.product.search";
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