from mailjet_rest import Client
#pip install mysql-connector
from mysql import connector

mydb = connector.connect(
    host="localhost",
    user="phpmyadmin",
    passwd="root",
    database="musicApp"
)

mycursor = mydb.cursor()

mycursor.execute("SELECT distinct email FROM music_campaigns")

myresult = mycursor.fetchall()

api_key = "dc3744f8fcb891dd653a3c76b0d35aca"
api_secret = "03d23bc27998d3f2f5257fe49fff7d23"
mailjet = Client(auth=(api_key, api_secret), version='v3')
data = {
    'ContactsLists': [
        {
            "Action": "addnoforce",
            "ListID": "3982"
        }
    ]
}


for x in myresult:
    result = mailjet.contact_managecontactslists.create(id=x[0], data=data)

