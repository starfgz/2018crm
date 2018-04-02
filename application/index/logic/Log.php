<?php
namespace app\index\logic;

use think\Model;
use think\Session;
use think\Db;
class Log extends Model{

    protected  $table = "jckk_logs";
    protected  $ip = "jckk_logs";

    protected  $auto = ["ip","model","action","uid","create_time"];

    protected  function setIpAttr(){

        return request()->ip();

    }


    protected  function setModelAttr(){

        return request()->controller();

    }


    protected  function setActionAttr(){

        return request()->action();

    }


    protected  function setUidAttr(){

        return Session::get("uid");

    }
   protected  function setCreateTimeAttr(){

        return date("Y-m-d H:i:s",time());

    }




    public function  write_log($data,$is_all = false){

        if($is_all){
              $this->saveAll($data);

        }
        else{
            $this->save($data);

        }

    }


    public function get_logs(){
        $logs=  Db::table("jckk_logs")
                ->order( "id desc")
                ->field(["jckk_logs.*","jckk_user.chinese_name"])
                ->join("jckk_user","jckk_user.uid = jckk_logs.uid",'LEFT')
                ->paginate();

        return $logs;
    }


    public function get_log($id){
        $log=  Db::table("jckk_logs")
            ->field(["jckk_logs.*","jckk_user.chinese_name"])
            ->join("jckk_user","jckk_user.uid = jckk_logs.uid",'LEFT')
            ->find();
       // $log->create_time = date("Y-m-d H:i:s",$log->create_time);
        return $log;
    }




}