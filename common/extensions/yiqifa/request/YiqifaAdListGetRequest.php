<?php
/** API:open.yiqifa.ad.list.get
 * 
 * @author lsj
 */
class YiqifaAdListGetRequest
{
	/**
	 * ��ѯ�ֶΣ�Website���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;
	/**
	 * ���𷢻�ļƷ�����:Ŀǰֻ֧��cps
	 */
	private $charge_type;
	/**
	 * ����ķ���:�ɶ�ֵ������ֶ��á�,���ָ�
	 */
	private $ad_catid;
	/**
	 * ��˷�ʽ:�ɶ�ֵ������ֶ��á�,���ָ���������������ˣ��Զ���ˣ��˹����
	 */
	private $audit_mode;
	/**
	 * �������:�ɶ�ֵ������ֶ��á�,���ָ���ֵ����3����web��app��wap
	 */
	private $ad_type;
	
	private $apiParams = array();
	
	public function getCharge_type() {
		return $this->charge_type;
	}

	public function getAd_catid() {
		return $this->ad_catid;
	}

	public function getAudit_mode() {
		return $this->audit_mode;
	}

	public function getAd_type() {
		return $this->ad_type;
	}

	public function setCharge_type($charge_type) {
		$this->charge_type = $charge_type;
		$this->apiParams["charge_type"] = $charge_type;
	}

	public function setAd_catid($ad_catid) {
		$this->ad_catid = $ad_catid;
		$this->apiParams["ad_catid"] = $ad_catid;
	}

	
	public function setAudit_mode($audit_mode) {
		$this->audit_mode = $audit_mode;
		$this->apiParams["audit_mode"] = $audit_mode;
	}

	/**
	 * @param field_type $ad_type
	 */
	public function setAd_type($ad_type) {
		$this->ad_type = $ad_type;
		$this->apiParams["ad_type"] = $ad_type;
	}

	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParams["fields"] = $fields;
	}
	public function getFields()
	{
		return $this->fields;
	}
	public function getApiMethodName()
	{
		return "open.yiqifa.ad.list.get";
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