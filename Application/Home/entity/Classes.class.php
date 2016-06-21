<?php
namespace entity;

class Classes{
    public $cid;
    public $name;
    public $tid;
    public $staid;
    public $headid;
    public $managerid;
    public $stucount;
    public $createTime;
    public $openTime;
    public $endTime;
    public $remark;
    
    public function getCid(){
        return $this->cid;
    }

    public function getName(){
        return $this->name;
    }

    public function getTid(){
        return $this->tid;
    }

    public function getStaid(){
        return $this->staid;
    }

    public function getHeadid(){
        return $this->headid;
    }

    public function getManagerid(){
        return $this->managerid;
    }

    public function getStucount(){
        return $this->stucount;
    }

    public function getCreateTime(){
        return $this->createTime;
    }

    public function getOpenTime(){
        return $this->openTime;
    }

    /**
     * @return $endTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return $remark
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setCid($cid)
    {
        $this->cid = $cid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setTid($tid)
    {
        $this->tid = $tid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setStaid($staid)
    {
        $this->staid = $staid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setHeadid($headid)
    {
        $this->headid = $headid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setManagerid($managerid)
    {
        $this->managerid = $managerid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setStucount($stucount)
    {
        $this->stucount = $stucount;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setOpenTime($openTime)
    {
        $this->openTime = $openTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    
    
    
    
    
    
    
    
    
}

?>