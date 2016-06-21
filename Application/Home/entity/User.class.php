<?php

namespace Home\entity;
class User{
    public $uid;
    public $userName;
    public $userPass;
    public $rid;
    public $staid;
    public $trueName;
    public $phone;
    public $sexid;
    public $birthday;
    public $school;
    public $eid;
    public $workYear;
    public $regTime;
    public $pid;
    public $cid;
    public $address;
    
    
    public function getUid(){
        return $this->uid;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getUserPass(){
        return $this->userPass;
    }

    public function getRid(){
        return $this->rid;
    }

    public function getStaid(){
        return $this->staid;
    }

    public function getTrueName(){
        return $this->trueName;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getSexid(){
        return $this->sexid;
    }

    public function getBirthday(){
        return $this->birthday;
    }

    public function getSchool(){
        return $this->school;
    }

   
    public function getEid(){
        return $this->eid;
    }

    public function getWorkYear(){
        return $this->workYear;
    }

    public function getRegTime(){
        return $this->regTime;
    }

    public function getPid(){
        return $this->pid;
    }

    public function getCid(){
        return $this->cid;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setUid($uid){
        $this->uid = $uid;
    }

    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function setUserPass($userPass){
        $this->userPass = $userPass;
    }

    public function setRid($rid){
        $this->rid = $rid;
    }

    public function setStaid($staid){
        $this->staid = $staid;
    }

    public function setTrueName($trueName){
        $this->trueName = $trueName;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function setSexid($sexid){
        $this->sexid = $sexid;
    }

    public function setBirthday($birthday){
        $this->birthday = $birthday;
    }

    public function setSchool($school){
        $this->school = $school;
    }

    public function setEid($eid){
        $this->eid = $eid;
    }

    public function setWorkYear($workYear){
        $this->workYear = $workYear;
    }

    public function setRegTime($regTime){
        $this->regTime = $regTime;
    }

    public function setPid($pid){
        $this->pid = $pid;
    }

    public function setCid($cid){
        $this->cid = $cid;
    }

    public function setAddress($address){
        $this->address = $address;
    }


    
}

?>