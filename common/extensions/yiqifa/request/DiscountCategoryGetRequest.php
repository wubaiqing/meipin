<?php
/**
 *api:open.discount.category.get
 *
 *@auther:lsj
 */

 class DiscountCategoryGetRequest{
	 /**
	 * ��ѯ�ֶΣ�DiscountCategory���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
	 */
	private $fields;

	private $apiParams = array();
	
	public function setFields($fields){
		$this->fields = $fields;
		$this->apiParams["fields"] = $fields;
	}

	public function getFields(){
		return $this->fields;
	}

	public function getApiMethodName(){
		return "open.discount.category.get";
	}

	public function getApiParams(){
		return $this->apiParams;
	}

	public function putOtherTextParam($key,$value){
		$this->apiParams[$key] = $value;
		$this->$key = $value;
	}

 }

?>