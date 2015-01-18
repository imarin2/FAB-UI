

import sys, os
import termios
import tty
import time, datetime
import serial
import json
from subprocess import call
import requests  #run   sudo pip install requests if needed 









port = '/dev/ttyAMA0'
baud = 115200
serial = serial.Serial(port, baud, timeout=0.6)
serial.flushInput()


print "Temperature Sensors Pre-test:"
serial.flushInput()
serial.write("M105\r\n")
time.sleep(1)
serial_reply=serial.readline().rstrip()
if len(serial_reply)>5:
    ext_temp=serial_reply.split( )[1]
    ext_temp=ext_temp.split(":")[1]
    bed_temp=serial_reply.split( )[3]
    bed_temp=bed_temp.split(":")[1]
else:
    ext_temp=-1
    bed_temp=-1
    print "FAILURE : Extruder Sensor unresponsive"
    

if float(ext_temp)>0:
    print "OK : Extruder sensor (" + ext_temp +" ) responding correctly"
else:
    print "FAILED : Extruder sensor disconnected (" + ext_temp + ") "
    
if float(bed_temp)>0: 
    print "OK : Bed sensor("+ str(bed_temp) +") reponding correctly"
else:
    print "FAILED : Bed not positioned or sensor not responding " + str(bed_temp)+")"
    
#t0 = time.time()
#time.sleep(10)
#print time.time() - t0, "seconds process time"

serial.write("M104 S200\r\n") #set ext temp
serial.write("M140 S100\r\n") #set bed temp

ext_temp=0
bed_temp=0
temperature_timeout=120
print "HEATING TEST (temperature in "+str(temperature_timeout)+" seconds): "


time_started = time.time()
time_elapsed = 0

while ((ext_temp <= 200) and (time_elapsed < temperature_timeout)):
    
    serial.flushInput()
    serial.write("M105\r\n")
    time.sleep(1)
    serial_reply=serial.readline().rstrip()
    
    #print serial_reply
    
    if len(serial_reply)>5:
        ext_temp=serial_reply.split( )[1]
        ext_temp=float(ext_temp.split(":")[1])
    else:
        ext_temp=0
        #print "FAILURE : Extruder Sensor not responding after "+str(time_elapsed)+" seconds )"
    
    time_elapsed = time.time() - time_started
    
    #print str(ext_temp) + " in " + str(time_elapsed) + " seconds "


if ext_temp>=190:
    print "OK : Extruder heating(" + str(ext_temp) + chr(176) + "C in "+str(int(time_elapsed))+" seconds )"
else:
    print "FAILED : Extruder heating (" + str(ext_temp) + ") took more than "+str(time_elapsed)+" seconds"
    
    
while ((bed_temp <= 60) and (time_elapsed < temperature_timeout)):
    
    serial.flushInput()
    serial.write("M105\r\n")
    time.sleep(1)
    serial_reply=serial.readline().rstrip()
    
    #print serial_reply
    
    if len(serial_reply)>5:
        bed_temp=serial_reply.split( )[3]
        bed_temp=float(bed_temp.split(":")[1])
    else:
        bed_temp=0
        #print "FAILURE : Extruder Sensor not responding after "+str(time_elapsed)+" seconds )"
    
    time_elapsed = time.time() - time_started
    
    #print str(ext_temp) + " in " + str(time_elapsed) + " seconds "

if bed_temp>=190:
    print "OK : Bed heating(" + str(bed_temp) +" in "+str(int(time_elapsed))+" seconds )"
else:
    print "FAILED : Bed heating (" + str(bed_temp) + ") took more than "+str(time_elapsed)+" seconds"


   