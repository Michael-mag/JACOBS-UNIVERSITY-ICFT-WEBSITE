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
        user = "root",
        passwd = "toor",
        database = "ICFT"
    )
    if icft.is_connected():
        print()
        print("Connection to database ICFT established!!!...")
        print()

        mycursor =  icft.cursor()

        #create the team table and schedule
        team_schedule = """
                            CREATE TABLE Teams (
                                                Position INT AUTO_INCREMENT PRIMARY KEY,
                                                Continent VARCHAR(255),
                                                P INT ,
                                                W INT,
                                                D INT,
                                                L INT ,
                                                GF INT ,
                                                GA INT ,
                                                GD INT ,
                                                Pts INT ,
                                                Form VARCHAR(255) )
                        """
        mycursor.execute(team_schedule)
        mycursor.execute("use ICFT") #chose the database to use
        mycursor.execute("SHOW TABLES")#tell user something
        print()
        print("the table was created...")
        print("Below are all the tables found in the database \"ICFT\" : ")
        print()
        for x in mycursor:
            print(x)

        print()
        #insert the data
        try:
            icft_teams = ''' INSERT INTO Teams
                             VALUES (%s , %s , %s , %s , %s , %s , %s , %s , %s, %s,%s)
                        '''
            #the variables to insert:
            data = [(1,'Africa',0,0,0,0,0,0,0,0,'None'),
                    (2,'America',0,0,0,0,0,0,0,0,'None'),
                    (3,'Asia Black',0,0,0,0,0,0,0,0,'None'),
                    (4,'Asia Pink',0,0,0,0,0,0,0,0,'None'),
                    (5,'Europe Green',0,0,0,0,0,0,0,0,'None'),
                    (6,'Europe Orange',0,0,0,0,0,0,0,0,'None')]

            mycursor.executemany(icft_teams,data)
            icft.commit()
            print(mycursor.rowcount , "Rows commited...")

        except Error as pr:
            print()
            print("an Error occured....")
            print()
            print(pr)
            print()
            icft.rollback()

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
