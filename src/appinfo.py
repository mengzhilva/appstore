# coding=utf-8
import sys
#reload(sys)
#sys.setdefaultencoding('gb2312')
import re
import requests
#from myradis import *
from lxml import etree
import time, datetime
import math
import random
import json

appid = sys.argv[1]
c = sys.argv[2]
headers = {
    'User-Agent': 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6'
}

#获取所有分页和总条数
respose = requests.get('https://apps.apple.com/'+c+'/app/id'+appid)

#respose = requests.get('https://www.chandashi.com/home/ranking/index/genre/7011/country/cn.html?view=more')
respose.encoding = 'utf-8';
content = respose.text
html = etree.HTML(content)
result = etree.tostring(html, encoding='utf-8')  # 解析对象输出代码

pfnum = html.xpath('//div[@class="we-customer-ratings__count small-hide medium-show"]/text()')
pflist = html.xpath('//div[@class="we-star-bar-graph__row"]//div[@class="we-star-bar-graph__bar__foreground-bar"]/@style')
subtitle = html.xpath('//h2[@class="product-header__subtitle app-header__subtitle"]/text()')


lastuptime = html.xpath('//div[@class="l-column small-12 medium-3 large-4 small-valign-top whats-new__latest"]//time/text()')

lastupversion = html.xpath('//div[@class="l-column small-12 medium-3 large-4 small-valign-top whats-new__latest"]//p/text()')
item = dict()
item['pfnum'] = ''
if pfnum:
	item['pfnum'] = pfnum[0]
item['pflist'] = pflist
item['subtitle'] = ''
if subtitle:
	item['subtitle'] = subtitle[0]
item['lastuptime'] = ''
if lastuptime:
	item['lastuptime'] = lastuptime[0]
item['lastupversion'] = ''
if lastupversion:
	item['lastupversion'] = lastupversion[0]
print(item)
exit()
i=0
for val in cateall:
    print(val.encode('utf-8'))
exit()
   