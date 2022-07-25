# appstore
苹果appstore搜索排名，榜单等

安装：

composer require ldg/ldgappstore

实例化

$store = new appstore('cn','zh');

获取排名列表

$store->search('abc');

获取app详情

$store->appinfo(appid);

获取榜单

$store->top();

获取评论

$store->reviews(appid);
