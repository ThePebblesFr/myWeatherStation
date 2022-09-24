"""
    __________________________________________________________________________
   |                                                                          |
   |                 MY WHEATHER STATION - SCRIPT PYTHON                      |
   |                                                                          |
   |    Author            :   M. JALES, P. GARREAU                            |
   |    Status            :   Under Development                               |
   |    Last Modification :   20/09/2022                                      |
   |    Project           :   EMBEDDED LINUX PROJECT                          |
   |                                                                          |
   |__________________________________________________________________________|
   
*/

/* ----------------------------------------------------------------------------
                                     INIT
---------------------------------------------------------------------------- """

import schedule
import time

import urllib.request

def get_data():
    print("It's processing...")
    page = urllib.request.urlopen('http://localhost/myWeatherStation/backend/')
    print(page.read())
    print("It's done")

schedule.every(1).minutes.do(get_data)

while 1:
    schedule.run_pending()
    time.sleep(1)