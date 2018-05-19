<?php
/**
 * Created by PhpStorm.
 * User: guofeng.io
 * Date: 2018/5/18
 * Time: 22:38
 */
class Kdware{
    private $username = NULL;
    private $password = NULL;

    public function __construct(){
        $this->username = '';
        $this->password = '';
    }

    /*会话管理--------------------------------------------------------------*/


    /**会话管理(V1.1) 会话登录
     * @param string $name 	    必须	登录的用户名
     * @param string $password  必须	登录的密码
     * @return mixed
     */
    public function login($name='',$password=''){
        $name = $name?:$this->username;
        $password = $password?:$this->password;
        $url = 'https://clb.kdware.cn:5000/v1.1/login';
        $data = array(
            'name'=>$name,
            'passwd'=>$password,
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }

    /**会话管理(V1.1) 会话保持
     * @param string $sessionid 必须	会话凭证
     * @return mixed
     */
    public function keep($sessionid = ''){
        $url = 'https://clb.kdware.cn:5000/v1.1/keep';
        $data = array(
            'sessionid' => $sessionid
        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;

    }

    /**会话管理(V1.1) 会话注销
     * @param string $sessionid 必须	会话凭证
     * @return mixed
     */
    public function logout($sessionid = ''){
        $url = 'https://clb.kdware.cn:5000/v1.1/logout';
        $data = array(
            'sessionid' => $sessionid
        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;

    }

    /*常规数据加载--------------------------------------------------------------*/

    /**常规数据加载(V1.1) 查询项目数据
     * @param string $sessionid 必须	会话凭证
     * @param number $offset    可选	指定返回记录行的偏移量
     * @param number $count     可选	指定返回记录行的最大数目
     * @param string $byID      可选	按ID查询
     * @param string $byName    可选	按名称查询
     * @return mixed
     */
    public function loadProjects($sessionid='',$offset='',$count ='',$byID = '',$byName=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/loadProjects';
        $data = array(
            'sessionid' => $sessionid,
            'offset' => (int)$offset,
            'count' => (int)$count,
            'byID' => $byID,
            'byName' => $byName,
        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }


    /**常规数据加载(V1.1) 加载阔道桥数据
     * @param string $sessionid 	    必须	会话凭证
     * @param number $offset            可选	按ID查询
     * @param number $count             可选	指定返回记录行的最大数目
     * @param string $byID
     * @param string $byName            可选	按名称查询
     * @param string $byState 	        可选	按连接状态查询，0为离线，1为在线
     * @param string $byProjectID       可选	按所属项目ID查询
     * @return mixed
     */
    public function loadRTUs($sessionid='',$offset='',$count='',$byID='',$byName='',$byState='',$byProjectID=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/loadRTUs';
        $data = array(
            'sessionid' => $sessionid,
            'offset' => (int)$offset,
            'count' => (int)$count,
            'byID' => $byID,
            'byName' => $byName,
            'byState' => $byState,
            'byProjectID' => $byProjectID,
        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }

    /**常规数据加载(V1.1) 加载设备数据
     * @param string $sessionid 	必须	会话凭证
     * @param number $offset 		可选	指定返回记录行的偏移量
     * @param number $count 		可选	指定返回记录行的最大数目
     * @param string $byID 		    可选	按ID查询
     * @param string $byName 		可选	按名称查询
     * @param string $byProjectID 	可选	按所属项目ID查询
     * @return mixed
     */

    public function loadDevices($sessionid='',$offset='',$count='',$byID='',$byName='',$byProjectID=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/loadDevices';
        $data = array(
            'sessionid' => $sessionid,
            'offset' => (int)$offset,
            'count' => (int)$count,
            'byID' => $byID,
            'byName' => $byName,
            'byProjectID' => $byProjectID,
        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }


    /**加载事件数据
     * @param string $sessionid		必须	会话凭证
     * @param number $offset		可选	指定返回记录行的偏移量
     * @param number $count		    可选	指定返回记录行的最大数目
     * @param string $byOwner		可选	按持有人查询
     * @param string $byDevice		可选	按所属设备名称查询
     * @param string $byProjectID	可选	按所属项目ID查询
     * @return mixed
     */

    public function loadDoorEvents($sessionid='',$offset='',$count='',$byOwner='',$byDevice='',$byProjectID=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/loadDoorEvents';
        $data = array(
            'sessionid' => $sessionid,
            'offset' => (int)$offset,
            'count' => (int)$count,
            'byOwner' => $byOwner,
            'byDevice' => $byDevice,
            'byProjectID' => $byProjectID,
        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }

    /*钥匙管理--------------------------------------------------------------*/

    /**钥匙管理(V1.1) 加载钥匙数据
     * @param string $sessionid  	必须	会话凭证
     * @param number $offset 	    可选	指定返回记录行的偏移量
     * @param number $count 	    可选	指定返回记录行的最大数目
     * @param string $byOwner 	    可选	按持有人名称查询
     * @param string $byOwnerID 	可选	按持有人证件号码查询
     * @param string $byMaker 	    可选	按授权人名称查询
     * @param string $byDevice 	    可选	按所属设备的名称查询
     * @param number $byState       可选	按钥匙状态查询
     * 1为查询所有状态为全部有效、部份有效、部份过期、部份撤销。
     * 2为查询所有状态为全部过期、全部撤销。
     * 3为查询所有状态为全部有效、全部过期、全部撤销。
     * 4为查询所有状态为部份有效、部份过期、部份撤销。
     * 注意：当进行钥匙操作时，有时会由于通信原因，部份设备的操作
     * 没有成功，调用者可使用redoKey调用对未成功的设备进行自动二
     * 次修复（未完成状态包括：部分有效、部分过期和部份撤销）
     * @param string $byProjectID 	可选	按所属项目ID查询
     * @param string $byCardID 	    可选	按钥匙卡号查询，格式需为16进制格式的数据，如：1a2b3c4d
     * @param string $byPasswd 	    可选	按钥匙密码查询
     * @param string $byID 	        可选	按ID查询
     * @param string $byType 	    可选	按类型查询
     * 1为卡片
     * 2为密码
     * @return mixed
     */
    public function loadKey($sessionid = '',$offset='',$count='',$byOwner='', $byOwnerID='', $byMaker='',$byDevice='', $byState='' ,$byProjectID='',$byCardID='', $byPasswd='', $byID='',$byType=''){
        $data = array(
            'sessionid' => $sessionid,
            'offset' => (int)$offset,
            'count' => (int)$count,
            'byOwner' => $byOwner,
            'byOwnerID' => $byOwnerID,
            'byMaker' => $byMaker,
            'byDevice' => $byDevice,
            'byState' => (int)$byState,
            'byProjectID' => $byProjectID,
            'byCardID' => $byCardID,
            'byPasswd' => $byPasswd,
            'byID' => $byID,
            'byType' => $byType,
        );

        $url = 'https://clb.kdware.cn:5000/v1.1/loadKeys';

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;

    }


    /**钥匙管理(V1.1) 设置钥匙
     * @param string $sessionid     会话凭证
     * @param string $projectID     目标钥匙的所属项目ID
     * @param number $keyType	    钥匙类型 0为卡片 1为密码
     * @param string $keyValue      当该钥匙类型为卡片时，该值为十六进制的物理卡号。 当该要是类型为密码时，该值为 4～8位数字密码。
     * @param string $owner         持有人名称
     * @param string $ownerID       持有人证件号码
     * @param string $beginDate     当前时间。 格式请使用ISO时间格式。如：2018-01-01T01:02:03
     * @param string $endDate 	    钥匙失效时间。 格式请使用ISO时间格式。如：2018-01-01T01:02:03
     * @param string $devices       该钥匙需要关联的设备ID，请只添加与当前钥匙所属项目相同的设备ID号，数组子项为string类型
     * @return mixed
     */
    public function setKey($sessionid='',$projectID='',$keyType='',$keyValue='',$owner='',$ownerID='',$beginDate='',$endDate='',$devices=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/setKey';
        $data = array(
            'sessionid' => $sessionid,
            "projectID"=> $projectID, //"344",
            "keyType"=> (int)$keyType, //1,
            "keyValue"=> $keyValue, //"888125",
            "owner" => $owner, //"kdware",
            "ownerID" => $ownerID, //"kdware",
            "beginDate" => $beginDate, // "2017-11-29T13:29:00.000",
            "endDate" => $endDate, //"2017-11-29T13:35:00.000",
            "devices" => $devices,// ["347","5301"],
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }

    /**钥匙管理(V1.1) 撤销钥匙
     * @param string $sessionid 	必须	会话凭证
     * @param string $keyID         必须	当前要撤销的钥匙ID
     * @return mixed
     */
    public function unsetKey($sessionid = '',$keyID=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/unsetKey';
        $data = array(
            'sessionid' => $sessionid,
            'keyID' => $keyID,

        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }
    /**钥匙管理(V1.1) 重做一次当前操作
     * @param string $sessionid     必须	会话凭证
     * @param string $keyID         必须	当前要撤销的钥匙ID
     * @return mixed
     */
    public function redoKey($sessionid = '',$keyID=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/redoKey';
        $data = array(
            'sessionid' => $sessionid,
            'keyID' => $keyID,

        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }


    /*项目管理--------------------------------------------------------------*/

    /**项目管理(V1.1) 添加项目
     * @param string $sessionid
     * @param string $name      项目名称
     * @param string $desc      项目描述
     * @return mixed
     */
    public function addProject($sessionid='',$name='',$desc=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/addProject';
        $data = array(
            'sessionid' => $sessionid,
            "name"=> $name, //"344",
            "desc"=> $desc, //1,
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;

    }

    /**项目管理(V1.1) 更新项目
     * @param string $sessionid
     * @param string $id
     * @param string $name
     * @param string $desc
     * @return mixed
     */
    public function updateProject($sessionid='',$id='',$name='',$desc=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/updateProject';
        $data = array(
            'sessionid' => $sessionid,
            "id"=> $id,
            "name"=> $name,
            "desc"=> $desc,
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;

    }


    /**项目管理(V1.1) 删除项目数据
     * @param string $sessionid 必须	会话凭证
     * @param string $id        项目ID
     * @return mixed
     */

    public function removeProject($sessionid='',$id=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/removeProject';
        $data = array(
            'sessionid' => $sessionid,
            'id' => $id,
        );
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }


    /*执行动作--------------------------------------------------------------*/

    /**执行动作(V1.1) 远程开门
     * @param string $sessionid     会话凭证
     * @param string $projectID     目标设备的项目ID
     * @param string $deviceID      目标设备的ID
     * @param string $lockState     操作模式，1为开门并保持常开，2为开门后关闭，0xff为测试设备连接（测试电池电量才会更新）
     * @return mixed
     */
    public function execute_unlock($sessionid='',$projectID='',$deviceID='',$lockState=''){
        $data = array(
            'sessionid' => $sessionid
        );

        $url = 'https://clb.kdware.cn:5000/v1.1/loadKeys';

        $params = array(
            'projectID' => $projectID,
            'deviceID' => $deviceID,
            'lockState' => (int)$lockState,
        );

        $data = array_merge($data,$params);
        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }


    /*子账号管理--------------------------------------------------------------*/

    /**子账号管理(V1.1) 加载子账号数据
     * @param string $sessionid     会话凭证
     * @param number $offset
     * @param number $count
     * @return mixed
     */
    public function loadLogins($sessionid='',$offset='',$count=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/loadLogins';
        $data = array(
            'sessionid' => $sessionid,
            'offset' => (int)$offset,
            'count' => (int)$count,
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }


    /**子账号管理(V1.1) 添加子账号
     * @param string $sessionid
     * @param string $name
     * @param string $passwd
     * @param string $desc
     * @param number $type 	0=mirror, 1=independent
     * @return mixed
     */
    public function addLogin($sessionid='',$name='',$passwd='',$desc='',$type=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/addLogin';
        $data = array(
            'sessionid' => $sessionid,
            'name' => $name,
            'passwd' => $passwd,
            'desc' => $desc,
            'type' => (int)$type,
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }

    /**子账号管理(V1.1) 更新子账号
     * @param string $sessionid
     * @param string $id
     * @param string $passwd
     * @param string $desc
     * @return mixed
     */
    public function updateLogin($sessionid='',$id='',$passwd='',$desc=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/updateLogin';
        $data = array(
            'sessionid' => $sessionid,
            'id' => $id,
            'passwd' => $passwd,
            'desc' => $desc,
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }

    /**子账号管理(V1.1) 删除子账号
     * @param string $sessionid
     * @param string $id
     * @return mixed
     */
    public function removeLogin($sessionid='',$id=''){
        $url = 'https://clb.kdware.cn:5000/v1.1/removeLogin';
        $data = array(
            'sessionid' => $sessionid,
            'id' => $id,
        );

        $res = $this->curl_post_https($url,json_encode($data));
        $res_data = json_decode($res,TRUE);
        return $res_data;
    }


    /*自定义--------------------------------------------------------------*/

    /*随机数字密码*/
    public function randPass(){
        do{
            $code = mt_rand(100000,999999);
            $arr = str_split($code);
            for($i=1;$i<count($arr);$i++){
                if(abs($arr[$i] - $arr[$i-1])<=1){
                    $code = 0;
                }
            }
        }while($code == 0);
        return $code;
    }

    /* PHP CURL HTTPS POST */
    function curl_post_https($url,$data){ // 模拟提交数据函数
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8'
        ));
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据，json格式
    }
}