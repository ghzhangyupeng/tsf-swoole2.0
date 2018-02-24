<?php
/**
 * Created by PhpStorm.
 * User: zhangyupeng
 * Date: 18/1/26
 * Time: 14:12
 */
class HttpModel {

    public function getOfHttp($url, array $data)
    {
        $url='http://rmshellback.com/hat/?';
        $data='_t=i&type=imp&hat_id=NTA2JjQwNyY1MDc5JjQyMjYxJjc4MzIxMCZSCA&p_appname=qqtv&_z=m&os=1&imei=__IMEI__&mac=__MAC__&mac1=__MAC1__&idfa=42DCFACD-CDBC-4B35-9616-B3647F0FCF0E&openudid=__OPENUDID__&androidid=__ANDROIDID__&androidid1=__ANDROIDID1__&aaid=__AAID__&duid=__DUID__&udid=__UDID__&ip=101.87.40.46&useragent=__UA__&ts=1516604483&p_tx_f2035=1&p_tx_m03=0';
        yield new Swoole\Client\HTTP($url, 'GET', $data);
        $header = array(
            'Content-Length' => 12345,
        );
    }

    public function postOfHttp($url, array $data)
    {
        
    }

    public function getTest()
    {
        
    }
}