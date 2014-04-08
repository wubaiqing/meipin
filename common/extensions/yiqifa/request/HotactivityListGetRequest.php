<?php
	/**
	*api:open.hotactivity.list.get
	*@auther:lsj
	**/

	class HotactivityListGetRequest
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
		/**
	     *ҳ�루>0����Ȼ������1�����1ҳ��2�����2ҳ���������ƣ�Ĭ��ֵΪ1�����ص������ǵ�1ҳ
		 */
		private $page_no;
		/**
	     *ÿҳ������>0��Ȼ������ÿҳ�������100����Ĭ��ֵΪ40
		 */
		private $page_size;

		private $apiParams = array();

		public function setFields($fields){
			$this->fields = $fields;
			$this->apiParams["fields"] = $fields;
		}

		public function getFields(){
			return $this->fields;
		}

		public function setCatid($catid){
			$this->catid = $catid;
			$this->apiParams["catid"] = $catid;
		}
		public function getCatid(){
			return $this->catid;
		}

		public function setWebid($webid){
			$this->webid = $webid;
			$this->apiParams["webid"] = $webid;
		}

		public function getApiParams(){
			return $this->apiParams;
		}

	    public function setPage_no($page_no){
			$this->page_no = $page_no;
			$this->apiParams["page_no"] = $page_no;
		}
		public function getPage_no(){
			return $this->page_no;
		}
		 public function setPage_size($page_size){
			$this->page_size = $page_size;
			$this->apiParams["page_size"] = $page_size;
		}
		public function getPage_size(){
			return $this->page_size;
		}

		public function getApiMethodName(){
			return "open.hotactivity.list.get";
		}

		public function putOtherTextParam($key,$value){
			$this->apiParams[$key]=$value;
			$this->$key=$value;
		}
	}
?>