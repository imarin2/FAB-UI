import re
''' 
ncfile="/var/www/upload/gcode/Marvin_KeyChain_FABtotum.gcode"

z=""

for line in reversed(open(ncfile).readlines()):
    
    temp = line.strip()
    
    
    #m = re.search("Z[+-]?([0-9]+\.([0-9]+)?|\.[0-9]+)([eE][+-]?[0-9]+)?", temp)
    m = re.search("G[0-1] Z\d*\.?\d+", temp)
    if m:
        print m.group(0)
        break;
    
   
    if temp[0:4] == "G1 Z" or temp[0:4] == "G1 Z":
        z=temp
        break
    
z = z.split()

z = z[1]


print z.replace('Z', '');
'''



def getLayers(file):
    layers=0
    for line in reversed(open(file).readlines()):
        match = re.search("G[0-1] Z\d*\.?\d+", line.strip())
        if match:
            temp = match.group().split()
            layers=temp[1].replace("Z", "")
            break
    return float(layers)*10
            
            
ncfile="/var/www/upload/gcode/Marvin_KeyChain_FABtotum.gcode"
print getLayers(ncfile)    