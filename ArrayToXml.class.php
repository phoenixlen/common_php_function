<?php
class ArrayToXml{
    /*
     * 数组转xml格式的函数　用于ajax的响应
     * @param   integer $status  处理状态
     * @param   string  $message 提示信息　用于js的显示
     * @param   array   $data   传给浏览器的数据
     * return   string
     * author   singwa
     * modifier tinytoobad
     * 20160424
     * */
    public static function array2xml($status=400, $message='fail', $data = array()) {

        if(!is_numeric($status)) { return '@param status is not a integer'; }

        $result = array(
            'status' => $status,
            'message' => $message,
            'data' => $data,
        );

//        指定页面显示类型，因在页面上显示故加上，若用于ajax可能应该用掉
        header("Content-Type:text/xml");
//        xml版本
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<root>\n";

        $xml .= self::array2xml_body($result);

        $xml .= "</root>";
        echo $xml;
    }

    /*
     * 递归法，传入数组递归出xml的主体
     * @param   array   $data   要转成xml主体的数组
     * return   string  xml主体字符串
     * author   singwa
     * modifier tinytoobad
     * 20160424
     * */
    protected  static function array2xml_body($data) {

        $xml = $attr = "";

        foreach($data as $key => $value) {
            if(is_numeric($key)) {
                $attr = " id='{$key}'";
                $key = "item";
            }
            $xml .= "<{$key}{$attr}>";
            $xml .= is_array($value) ? self::array2xml_body($value) : $value;
//            换行号实际用时应去掉
            $xml .= "</{$key}>\n";
        }
        return $xml;
    }
}

$arr = array('xx'=>['one','two','three'],'yy'=>'kk');
ArrayToXml::array2xml(200,'success',$arr);

?>
