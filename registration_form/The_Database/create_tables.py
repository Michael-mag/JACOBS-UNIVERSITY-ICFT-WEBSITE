#!/usr/bin/env python3
import mysql.connector
from mysql.connector import Error
from mysql.connector import errorcode

'''
    This is the script used to create and initialize Teams data such as
    : scores
    : fixtures
    : competition races, eg golden boot etc..
'''

try:
    icft = mysql.connector.connect(
        host = "localhost",
        user = "",
        passwd = "",
        database = "JUB_ICFT"
    )
    if icft.is_connected():
        print()
        print("Connection to database ICFT established!!!...")
        print()

        mycursor =  icft.cursor()

        #create the team table and schedule
        team_schedule = """
                            CREATE TABLE Players (

                                                Name VARCHAR(255),
                                                Surname VARCHAR(255),
                                                Nationality VARCHAR(255),
                                                Position VARCHAR(255),
                                                Email VARCHAR(255)

                                                 )
                        """
        mycursor.execute(team_schedule)
        mycursor.execute("use JUB_ICFT") #chose the database to use
        mycursor.execute("SHOW TABLES")#tell user something
        print()
        print("the table was created...")
        print("Below are all the tables found in the database \"ICFT\" : ")
        print()
        for x in mycursor:
            print(x)

        print()

except Error as err:
    print()
    print("An error occured...")
    print()
    print(err)
    print()

finally:#disconnect from the server and release resources
    if icft.is_connected():
        mycursor.close()
        icft.close()
        print()
        print("Disconnected successfully!...")
        print()
