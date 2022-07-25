<?php

/**
 * Created by ldg
 * Date: 2022/7/14
 */


/*
 * 使用方法

*
* */ 
 
namespace ldgappstore;

use Curl\Curl;
class appstore {
   	private $country = '';
   	private $lang = '';

    public function __construct($country,$lang='')
    {
    	
    	$this->country = $country;
    	$this->lang = $lang;
    	
    }
    //获取关键词搜索结果
    public function search($keyword=''){
    	
    	$url = 'https://search.itunes.apple.com/WebObjects/MZStore.woa/wa/search?clientApplication=Software&media=software&term=';
    	
    	$curl = new Curl();
    	$country = strtoupper($this->country);
    	$countrym = new config();
    	$lang = $this->lang;
    	$countryarr = $countrym->countryarr();
    	$countryid = $countryarr[$country];
    	$curl->setHeader('X-Apple-Store-Front',$countryid.',24 t:native');
    	$curl->setHeader('Accept-Language',strtolower($lang));
    	
    	
    	$curl->setOpt(CURLOPT_TIMEOUT,6);
    	$curl->setopt(CURLOPT_PROXY, '');
    	$res = $curl->get($url.urlencode($keyword));
    	
    	$lists = [];
    	if($res->curl_error_code !=0){
    		return false;
    	}
    	if($res->http_status_code == 200){
    		$result = json_decode($res->response,true);
    	
    		$search = $result['bubbles'][0]['results'];
    		$APPIDS = [];
    		
    		if($search){
    			//获取详情
    			$selfinfo = $result['storePlatformData']['results'];
    			if($result['storePlatformData']['native-search-lockup-search']['results']){
    				$selfinfo = $result['storePlatformData']['native-search-lockup-search']['results'];
    			}
    			$listno = [];
				foreach ($search as $k=>$v){
					$list= [];
					$list['rank'] = $k+1;
					$list['appid'] = $v['id'];

					$lists[] = $list;
	
				}
    		
    	}
    	}else{
    		return false;
    	}
    	return $lists;
    }
	//获取app详情
    public function appinfo($appId){
    	$country = $this->country;
    	$curl = new Curl();
    	$res = $curl->get('https://itunes.apple.com/lookup?country='.$country.'&id='.$appId);
    	
    	$dar = json_decode($res->response,true);
    	
    	if($dar){
    		if($dar['resultCount'] == 0){
    			return [];
    		}
    		//抓取附加数据
    		$rant = $dar['results'][0]['userRatingCount'];
    		$p = dirname(__FILE__);
    		$path = $p.' appinfo.py ';
    		$res = exec($path.$appId.'" "'.strtolower($country).'"',$out,$ress);
    	
    		$res = str_replace("'", '"', $res);
    		$res = json_decode($res,true);
    		$dar['results'][0]['currentVersionReleaseDate'] = str_replace('Z', '', $dar['results'][0]['currentVersionReleaseDate']);
    		$dar['results'][0]['currentVersionReleaseDate'] = str_replace('T', ' ', $dar['results'][0]['currentVersionReleaseDate']);
    		$dar['results'][0]['updated'] = $dar['results'][0]['currentVersionReleaseDate'];
    		$dar['results'][0]['ratings'] = $dar['results'][0]['userRatingCount'];
    		$dar['results'][0]['developer'] = $dar['results'][0]['artistName'];
    		$dar['results'][0]['releaseDate'] = str_replace('Z', '', $dar['results'][0]['releaseDate']);
    		$dar['results'][0]['releaseDate'] = str_replace('T', ' ', $dar['results'][0]['releaseDate']);
    		if($res){
    			$dar['results'][0]['released'] = $dar['results'][0]['releaseDate'];
    			$dar['results'][0]['summary'] = $res['subtitle'];
    			$histogram= [];
    			if($res['pflist']){
    				foreach ($res['pflist'] as $k=>$v){
    					$bfb = str_replace('width: ', '', $v);
    					$bfb = str_replace('%', '', $bfb);
    					$pf = round($rant*$bfb/100);
    					if($k==0){
    						$kk = 5;
    					}
    					if($k==1){
    						$kk = 4;
    					}
    					if($k==2){
    						$kk = 3;
    					}
    					if($k==3){
    						$kk = 2;
    					}
    					if($k==4){
    						$kk = 1;
    					}
    					$histogram[$kk] = $pf;
    				}
    			}
    			$dar['results'][0]['histogram'] = $histogram;
    		}
    		 
    	}
    	
    	return $dar;
    }

    //榜单
	public function top($collection='topfreeapplications',$category='5000'){
		//$collection与$category 见config->topclass();
		
		$countryh = $this->country;
		$url = 'http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/ws/RSS/'.$collection.'/limit=200/genre='.$category.'/json?cc='.$countryh;
		$curl = new curl();
		$ress =     $curl->get($url);
	
	
		if($ress->response){
			$res = json_decode($ress->response,true);
		}
		 
		$dar = $res;
		$rank = 0;
		$app = [];
		if($dar){
			 
			if($dar['feed']['entry']){
				foreach ($dar['feed']['entry'] as $key => $value) {
					$apps = [];
					$rank = (intval($key)+1);
					$apps['rank'] = $rank;
					$apps['url'] = $value['link'][0]['attributes']['href'];
					$apps['name'] = $value['im:name']['label'];
					$apps['appid'] = $value['id']['attributes']['im:id'];
					$apps['country'] = $this->country;
					$apps['lang'] = $this->lang;
					$apps['developer'] = $value['im:artist']['label'];
					$apps['releaseDate'] = $value['im:releaseDate']['label'];
					
					$apps['category'] = $value['category']['attributes'];
					$apps['icon'] = $value['im:image'][1]['label'];
					$apps['description'] = $value['summary']['label'];
					$apps['price'] = $value['im:price']['attributes']['amount'];
					$apps['priceText'] = $value['im:price']['attributes']['amount'];
					$apps['free'] = 0;
					if($apps['priceText']==0.00000){
						$apps['free'] = 1;
					}
					 
					$app[] = $apps;
				}
			}
		}
		return $app;
		 
	}

	private function xml_parser($str){
		$xml_parser = xml_parser_create();
		if(!xml_parse($xml_parser,$str,true)){
			xml_parser_free($xml_parser);
			return false;
		}else {
			return (json_decode(json_encode(simplexml_load_string($str)),true));
		}
	}
	
	// 获取评论 评论只能获取500条
	public function reviews($appid='1044283059',$next='1',$sort=1){
	
			
		if($sort == 1){
			$sor = 'mostrecent';
		}
		if($sort == 2){
			$sor = 'mostHelpful';
	
		}
		$this->country = 'cn';
		$url = 'https://itunes.apple.com/rss/customerreviews/page='.$next.'/id='.$appid.'/sortby='.$sor.'/xml?cc='.$this->country;
		$curl = new curl();
		$res =     $curl->get($url);

		if($this->xml_parser($res->response))
			$XML = simplexml_load_string($res->response);
	
		// 知道XML标签内容可以直接使用标签名
		$url = 'https://itunes.apple.com/rss/customerreviews/page='.$next.'/id='.$appid.'/sortby='.$sor.'/json?cc='.$this->country;
		$curl = new curl();
		$resjson =     $curl->get($url);
	
			
		$resjson = json_decode($resjson->response,true);
		$list = [];
		$flg = true;
		if($XML->entry){
			$ss = json_encode($XML);
			$entry = json_decode($ss,true);
			if($entry['entry']){
				if(!isset($entry['entry'][0]['title'])){
					$entry['entry'][0] = $entry['entry'];
				}
				foreach ($entry['entry'] as $k=>$v){
					if(isset($v['title'])){
						$d = [];
	
						$d['title'] = $v['title'];
						$d['text'] = $v['content'][0];
						$d['appid'] = $appid;
						$d['username'] = $v['author']['name'];
						$d['userimg'] = '';
						$d['date'] = date('Y-m-d H:i:s',strtotime($v['updated']));
						$d['score'] = $resjson['feed']['entry'][$k]['im:rating']['label'];
						$d['replytext'] = '';
						$d['apptype'] = 2;
						$d['version'] = $resjson['feed']['entry'][$k]['im:version']['label'];
						$d['revid'] = $v['id'];
						$d['adddate'] = date('Y-m-d',strtotime($v['updated']));
						$list[] = $d;
					}else{
						//$flg = false;
					}
				}
			}
		}else{
			$flg = false;
		}
		$this->rlist = array_merge($this->rlist,$list);
		$next++;
		if($flg&&$next<50){ //取下一页数据
			$ycm = rand(10000, 50000);
			usleep($ycm);
			$this->reviews($appid,$next,$sort);
		
		}
		return $this->rlist;
	}
	
}