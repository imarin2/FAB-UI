from threading import Thread
import time

class MyThread(Thread):
    def __init__(self):
        ''' Constructor. '''
 
        Thread.__init__(self)
        self.stop = False
 
 
    def run(self):
        while self.stop is False:
            print "Ciao"
        
    def stop(self):
        self.stop = True
        
        
krios = MyThread()

krios.start()
time.sleep(20)
print "Stopped"
krios.stop()
        