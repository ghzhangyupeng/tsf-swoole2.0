<?php
/**
 * Tencent is pleased to support the open source community by making TSF Solution available.
 * Copyright (C) 2017 THL A29 Limited, a Tencent company. All rights reserved.
 * Licensed under the BSD 3-Clause License (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * https://opensource.org/licenses/BSD-3-Clause
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */


class TestModel {

	public function test(){

		yield array('r' => 0, 'data' => 'yield test');
	}

	public function udpTest(){

		// send data to back server 
		$ip = '127.0.0.1';
		$port = '9905';
		$data = 'test';
		$timeout = 0.5; //second
		yield new Swoole\Client\UDP($ip, $port, $data, $timeout);
	}

	public function httpTest(){

	    $url='http://rmshellback.com/hat?';
		$data='_t=i&type=imp&hat_id=NTA2JjQwNyY1MDc5JjQyMjYxJjc4MzIxMCZSCA&p_appname=qqtv&_z=m&os=1&imei=__IMEI__&mac=__MAC__&mac1=__MAC1__&idfa=42DCFACD-CDBC-4B35-9616-B3647F0FCF0E&openudid=__OPENUDID__&androidid=__ANDROIDID__&androidid1=__ANDROIDID1__&aaid=__AAID__&duid=__DUID__&udid=__UDID__&ip=101.87.40.46&useragent=__UA__&ts=1516604483&p_tx_f2035=1&p_tx_m03=0';
		yield new Swoole\Client\HTTP($url, 'GET', $data);
	    $header = array(
	      'Content-Length' => 12345,
	    );
//	    yield $httpRequest->get('/hat/', $data);
	    //yield $httpRequest->post($path, $data, $header);
	  }
	  
	public function muticallTest(){
	    $ip = '127.0.0.1';
	    $data = 'test';
	    $timeout = 0.5; //second

	    $calls=new Swoole\Client\Multi();

	    $firstReq=new Swoole\Client\TCP($ip, '9905', $data, $timeout);
	    $secondReq=new Swoole\Client\UDP($ip, '9904', $data, $timeout);

	    $calls ->request($firstReq,'first');             //first request
	    $calls ->request($secondReq,'second');             //second request

	    yield $calls;
	  }


	public function HttpmuticallTest(){
	  
	      $calls=new Swoole\Client\Multi();
	      $qq = new Swoole\Client\HTTP("http://www.qq.com/");
	      $calls ->request($qq,"qq");             
	  
	      yield $calls;
	}

	public function tcpTest(){
	    $ip = '127.0.0.1';
	    $port = '9905';
	    $data = 'test';
	    $timeout = 0.5; //second
	    yield new Swoole\Client\TCP($ip, $port, $data, $timeout);
	 }

	 public function mysqlTest(){
	 	$sql = new Swoole\Client\MYSQL(array('host' => '127.0.0.1', 'port' => 3345, 'user' => 'root', 'password' => 'root', 'database' => 'test', 'charset' => 'utf-8',));
		$ret = (yield $sql ->query('show tables'));
		var_dump($ret);
		$ret = (yield $sql ->query('desc test'));
		var_dump($ret);
	 }
}