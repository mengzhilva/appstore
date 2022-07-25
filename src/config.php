<?php

// +----------------------------------------------------------------------
// | 应用数据
// +----------------------------------------------------------------------

namespace ldgappstore;

class config {

	//所有国家代码
	function countryarr(){
		return  ['AE' => '143481',
		'AF' => '143610',
		'AG' => '143540',
		'AI' => '143538',
		'AL' => '143575',
		'AM' => '143524',
		'AO' => '143564',
		'AR' => '143505',
		'AT' => '143445',
		'AU' => '143460',
		'AZ' => '143568',
		'BA' => '143612',
		'BB' => '143541',
		'BD' => '143490',
		'BE' => '143446',
		'BF' => '143578',
		'BG' => '143526',
		'BH' => '143559',
		'BJ' => '143576',
		'BM' => '143542',
		'BN' => '143560',
		'BO' => '143556',
		'BR' => '143503',
		'BS' => '143539',
		'BT' => '143577',
		'BW' => '143525',
		'BY' => '143565',
		'BZ' => '143555',
		'CA' => '143455',
		'CD' => '143613',
		'CG' => '143582',
		'CH' => '143459',
		'CI' => '143527',
		'CL' => '143483',
		'CM' => '143574',
		'CN' => '143465',
		'CO' => '143501',
		'CR' => '143495',
		'CV' => '143580',
		'CY' => '143557',
		'CZ' => '143489',
		'DE' => '143443',
		'DK' => '143458',
		'DM' => '143545',
		'DO' => '143508',
		'DZ' => '143563',
		'EC' => '143509',
		'EE' => '143518',
		'EG' => '143516',
		'ES' => '143454',
		'FI' => '143447',
		'FJ' => '143583',
		'FM' => '143591',
		'FR' => '143442',
		'GA' => '143614',
		'GB' => '143444',
		'GD' => '143546',
		'GF' => '143615',
		'GH' => '143573',
		'GM' => '143584',
		'GR' => '143448',
		'GT' => '143504',
		'GW' => '143585',
		'GY' => '143553',
		'HK' => '143463',
		'HN' => '143510',
		'HR' => '143494',
		'HU' => '143482',
		'ID' => '143476',
		'IE' => '143449',
		'IL' => '143491',
		'IN' => '143467',
		'IQ' => '143617',
		'IS' => '143558',
		'IT' => '143450',
		'JM' => '143511',
		'JO' => '143528',
		'JP' => '143462',
		'KE' => '143529',
		'KG' => '143586',
		'KH' => '143579',
		'KN' => '143548',
		'KP' => '143466',
		'KR' => '143466',
		'KW' => '143493',
		'KY' => '143544',
		'KZ' => '143517',
		'LA' => '143587',
		'LB' => '143497',
		'LC' => '143549',
		'LI' => '143522',
		'LK' => '143486',
		'LR' => '143588',
		'LT' => '143520',
		'LU' => '143451',
		'LV' => '143519',
		'LY' => '143567',
		'MA' => '143620',
		'MD' => '143523',
		'ME' => '143619',
		'MG' => '143531',
		'MK' => '143530',
		'ML' => '143532',
		'MM' => '143570',
		'MN' => '143592',
		'MO' => '143515',
		'MR' => '143590',
		'MS' => '143547',
		'MT' => '143521',
		'MU' => '143533',
		'MV' => '143488',
		'MW' => '143589',
		'MX' => '143468',
		'MY' => '143473',
		'MZ' => '143593',
		'NA' => '143594',
		'NE' => '143534',
		'NG' => '143561',
		'NI' => '143512',
		'NL' => '143452',
		'NO' => '143457',
		'NP' => '143484',
		'NR' => '143606',
		'NZ' => '143461',
		'OM' => '143562',
		'PA' => '143485',
		'PE' => '143507',
		'PG' => '143597',
		'PH' => '143474',
		'PK' => '143477',
		'PL' => '143478',
		'PT' => '143453',
		'PW' => '143595',
		'PY' => '143513',
		'QA' => '143498',
		'RO' => '143487',
		'RS' => '143500',
		'RU' => '143469',
		'RW' => '143621',
		'SA' => '143479',
		'SB' => '143601',
		'SC' => '143599',
		'SE' => '143456',
		'SG' => '143464',
		'SI' => '143499',
		'SK' => '143496',
		'SL' => '143600',
		'SN' => '143535',
		'SR' => '143554',
		'ST' => '143598',
		'SV' => '143506',
		'SZ' => '143602',
		'TC' => '143552',
		'TD' => '143581',
		'TH' => '143475',
		'TJ' => '143603',
		'TM' => '143604',
		'TN' => '143536',
		'TO' => '143608',
		'TR' => '143480',
		'TT' => '143551',
		'TW' => '143470',
		'TZ' => '143572',
		'UA' => '143492',
		'UG' => '143537',
		'US' => '143441',
		'UY' => '143514',
		'UZ' => '143566',
		'VC' => '143550',
		'VE' => '143502',
		'VG' => '143543',
		'VN' => '143471',
		'VU' => '143609',
		'XK' => '143624',
		'YE' => '143571',
		'ZA' => '143472',
		'ZM' => '143622',
		'ZW' => '143605'];

	}
//苹果榜单分类
	public  function topclass(){
		$collection = ['topfreeapplications'=>'免费榜','toppaidapplications'=>'付费榜','topgrossingapplications'=>'畅销榜'];
		$category = ['5000'=>'应用','6000'=>'商务','6001'=>'天气','6002'=>'工具','6003'=>'旅游','6004'=>'体育','6005'=>'社交','6006'=>'参考','6007'=>'效率','6008'=>'摄影与录像','6009'=>'新闻','6010'=>'导航','6011'=>'音乐','6012'=>'生活','6013'=>'健康健美','6015'=>'财务','6016'=>'娱乐','6017'=>'教育','6018'=>'图书','6020'=>'医疗','6021'=>'报刊杂志','6023'=>'美食','6024'=>'购物','6026'=>'软件研发','6027'=>'图形设计','6061'=>'儿童','6014'=>'游戏','7001'=>'动作游戏','7002'=>'冒险游戏','7003'=>'休闲游戏','7004'=>'桌面游戏','7005'=>'卡牌游戏','7006'=>'娱乐游戏','7009'=>'家庭游戏','7011'=>'音乐游戏','7012'=>'益智游戏','7013'=>'竞速游戏','7014'=>'角色扮演','7015'=>'模拟游戏','7016'=>'体育游戏','7017'=>'策略游戏','7018'=>'问答游戏','7019'=>'字谜游戏','36'=>'总榜'];
		
	}

}