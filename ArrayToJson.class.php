<?php
class ArrayToJson{
    /*
     * 数组转Json格式的函数　用于ajax的响应
     * @param   integer $status  处理状态
     * @param   string  $message 提示信息　用于js的显示
     * @param   array   $data   传给浏览器的数据
     * return   string
     * author   singwa
     * Modifier	tinytoobad
     * 20160424
     * */
    public static function array2Json($status=400, $message = 'fail', $data = array()) {

        if(!is_numeric($status)) { return '@param status is not a integer'; }

        $result = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );

        echo json_encode($result);
        exit;
    }
}
ArrayToJson::array2Json(200,'试一下',['xx'=>'yy','hh'=>'ii']);

?>
