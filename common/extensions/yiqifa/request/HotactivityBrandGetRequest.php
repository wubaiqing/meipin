<?php
	/**
	*api:open.hotactivity.brand.get
	*@auther:lsj
	**/

	class HotactivityBrandGetRequest
	{
		/**
		* ��ѯ�ֶΣ�HotactivityBrand���ݽṹ�Ĺ�����Ϣ�ֶ��б������ֵ�԰�Ƕ���(,)�ָ�
		*/
		private $fields;
		/**
	     *������ķ���:�ɶ�ֵ������ֶ��á�,���ָ���������дʱ������ȫ�������Ʒ��
		 */
		private $catid;
		/**
	     *��������̼�:�ɶ�ֵ������ֶ��á�,���ָ���������дʱ������ȫ���̼ҵ�Ʒ��
		 */
		private $webid;

		private $apiParams = array();

		public function setFields($fields){
			$this->fields = $fields;
			$this->apiParams[fields] = $fields;
		}

		public function getFields(){
			return $this->fields;
		}

		public function setCatid($catid){
			$this->catid = $catid;
			$this->apiParams[catid] = $catid;
		}
		public function getCatid(){
			return $this->catid;
		}

		public function setWebid($webid){
			$this->webid = $webid;
			$this->apiParams[webid] = $webid;
		}

		public function getApiParams(){
			return $this->apiParams;
		}

		public function getApiMethodName(){
			return "open.hotactivity.brand.get";
		}

		public function putOtherTextParam($key,$value)
		{
			$this->apiParams[$key] = $value;
			$this->$key = $value;
		}
	}
?>