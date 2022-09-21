import schedule
import time

import urllib.request

ip_raspberryPi = "192.168.137.116"
api_token = "ba4f6697d9783551479be9ec2c3fce15fe495fa52ef65666c50914f96a50d2f7"

def get_data():
    print("It's processing...")
    page = urllib.request.urlopen('http://' + ip_raspberryPi + 'data.php?token=' + api_token)
    print(page.read())
    print("It's done")

schedule.every(1).minutes.do(get_data)

while 1:
    schedule.run_pending()
    time.sleep(1)