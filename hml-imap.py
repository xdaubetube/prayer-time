import smtplib
import sys
import datetime
import socket
from email.utils import COMMASPACE, formatdate, make_msgid
from multiprocessing import Pool
import traceback
import os
import base64
import json
import random
import string
import re
from bs4 import BeautifulSoup as bs
from essential_generators import DocumentGenerator
import quopri
import time
import string
import random
import uuid
import re

emails_sent = 1
docgentd  = DocumentGenerator()

def spin_document_manager():
    global emails_sent, docgentd
    if emails_sent % 100 == 0:
        docgentd = DocumentGenerator()
    os.system(f'title "Emails: {emails_sent}"')
    return docgentd

def get_random_string(length):
    return ''.join(random.choice(string.ascii_lowercase) for i in range(length))
    
    
def generatehtml():
    attributes = json.load(open("./resources/attributes.json"))
    elements = open("./resources/elements.txt","r").read().splitlines()
    styleslist = open("./resources/styles-and-values.txt","r").read().splitlines()
    elementsnumber = random.randint(50, 100)
    html = ''
    for i in range(elementsnumber):
     stylesnumber = random.randint(6, 20)
     elementtmp = random.choice(elements)
     atts = attributes[f"{elementtmp}"]
     style=""
     if not atts:
      attr = "class"
     else:
      attr = random.choice(atts)
     for i in range(stylesnumber):
      style = style+random.choice(styleslist)
      style = style.replace("[randomnum]",str(random.randint(0,100)))
     if elementtmp == "p" or elementtmp=="span":
        if random.choice([True, False]) is True:
         elementtmp = f'<{elementtmp} style="{style}" {attr}="``">{spin_document_manager().sentence()}</{elementtmp}>\n'
        else: 
         elementtmp = f'<{elementtmp} style="{style}" {attr}="``">{spin_document_manager().sentence()}\n'
     elif elementtmp == "img":
        if random.choice([True, False]) is True:
         elementtmp = f'<{elementtmp} style="{style}" {attr}="``"></{elementtmp}>\n'
        else:
         elementtmp = f'<{elementtmp} style="{style}" {attr}="``">\n'
     elif elementtmp == "img":
        if random.choice([True, False]) is True:
         elementtmp = f'<{elementtmp} style="{style}" {attr}="``"></{elementtmp}>\n'
        else:
         elementtmp = f'<{elementtmp} style="{style}" {attr}="``">\n'
     elif elementtmp == "head" or elementtmp == "body" or elementtmp == "html":
        if random.choice([True, False]) is True:
         elementtmp = f'<{elementtmp} {attr}="``"></{elementtmp}>\n'
        else:
         elementtmp = f'<{elementtmp} {attr}="``">\n'
     else:
      if random.choice([True, False]) is True:
       elementtmp = f'<{elementtmp} style="{style}" {attr}="``"></{elementtmp}>\n'
      else:
       elementtmp = f'<{elementtmp} style="{style}" {attr}="``"></{elementtmp}>\n'
     elementtmp = re.sub(r'`', lambda m: get_random_string(random.randint(2, 5)), elementtmp)
     html+=elementtmp
    return html
    
    
    
def domainadder():
    enabled = True
    html = generatehtml()
    if enabled == True:
        html_to_be_added = """<a href="https://0az4f8sq5f48za.de/bry/hx"><img src="https://0az4f8sq5f48za.de/bry"></a>"""
        # closing_tags = re.findall(r'</\w+>', html)
        # random_closing_tag = random.choice(closing_tags)
        # random_index = html.index(random_closing_tag)
        # html = html[:random_index + len(random_closing_tag)] + html_to_be_added + html[random_index + len(random_closing_tag):]
        html = html_to_be_added + html
        return html
    else:
        return html
        
        
        
def work(user,to, pos):
    global emails_sent
    emails_sent += 1
    print("SENT => "+pos+" - "+to+"")
    f = open("SENT.txt", "a+")
    f.write("SENT => "+pos+" - "+to+"\n")
    
    
def bad(user,to, pos):
    print("FAILED => "+pos+" - "+to+"")
    f = open("FAILED.txt", "a+")
    f.write("FAILED => "+pos+" - "+to+"\n")
    traceback.print_exc()


def checker(data):
    try:
     data = data.split(":")
     pos = data[0]
     to = data[1]
     user = data[2]
     muser = to[::-1]
     mainsender = "system@caloak.de"
     pwd =  "jVp8jyC4vY2KidY"
     MID = make_msgid(domain="[randomnum][a5][randomnum][a5][randomnum][randomnum][a5][randomnum]")
     uuidstr = str(uuid.uuid4())
     dtm = formatdate()
     tcrea = open("crea.txt")
     tmsg = tcrea.read()
     if "[html]" in tmsg:
      genhtml = domainadder()
      tmsg = tmsg.replace("[html]",str(quopri.encodestring(genhtml.encode('utf-8')).decode("utf-8")))
     tmsg1 = tmsg.replace("[sender]", mainsender).replace("[MID]", MID).replace("[UID]",uuidstr)
     tmsg2 = tmsg1.replace("[email]", to)
     tmsg3 = tmsg2.replace("[muser]", muser)
     tmsg4 = tmsg3.replace("[mail_date]", dtm).replace("[randomnum]",str(random.randint(00000,99999))).replace("[a5]", get_random_string(5))
     tmsg4 = re.sub(r'`', lambda m: get_random_string(random.randint(8, 17)), tmsg4)
     msg = tmsg4
     socket.setdefaulttimeout(60)
     mailserver = smtplib.SMTP('smtp.office365.com', 587)
     mailserver.ehlo()
     mailserver.starttls()
     mailserver.login(user, pwd)
     mailserver.sendmail(mainsender, to, msg)
     mailserver.quit()
     work(user,to, pos)
     # time.sleep(0.6)
     pass
    except:
        bad(user,to, pos)
        pass


if __name__ =="__main__":
  file_name = sys.argv[1] 
  try:
    TEXTList = open(file_name, 'r').read().splitlines()
    with Pool(3) as p:
     for result in p.imap(checker, TEXTList):
      pass
  except:
    traceback.print_exc()
    pass
