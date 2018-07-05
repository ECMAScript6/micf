import requests
import os
import time

# 服务器状态检测
website = "http://192.168.1.149:8081/T28%E5%B1%95%E4%BD%8D%E5%9B%BE/%E5%86%85%E9%83%A8%E5%9B%BE/14.1-01.jpg"
wait = 3 #等待时间
def ping():
	response = requests.get(website)

	if int(response.status_code) == 200: # OK
		file = open('F:/www/micf/status.txt','w')
		file.write('online')
		print('******************【online】********************')
	elif int(response.status_code) == 403: # Internal server error
		file = open('F:/www/micf/status.txt','w')
		file.write('online')
		print("文件不存在");
	else:
		file = open('F:/www/micf/status.txt','w')
		file.write('offline')
		print("*******************【off】*******************");
	time.sleep(wait)
ping()