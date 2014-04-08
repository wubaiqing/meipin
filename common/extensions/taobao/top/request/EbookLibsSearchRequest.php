<?php
/**
 * TOP API: taobao.ebook.libs.search request
 * 
 * @author auto create
 * @since 1.0, 2013-11-15 16:58:31
 */
class EbookLibsSearchRequest
{
	/** 
	 * 当前页码，不可为空、0和负数。
	 **/
	private $pageNo;
	
	/** 
	 * 每页的大小，不可为空、0和负数。最大为30，如果超过30，则取默认的20。
	 **/
	private $pageSize;
	
	private $apiParas = array();
	
	public function setPageNo($pageNo)
	{
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo()
	{
		return $this->pageNo;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize()
	{
		return $this->pageSize;
	}

	public function getApiMethodName()
	{
		return "taobao.ebook.libs.search";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->pageNo,"pageNo");
		RequestCheckUtil::checkNotNull($this->pageSize,"pageSize");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
