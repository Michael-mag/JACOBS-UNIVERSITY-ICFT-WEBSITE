#!/usr/bin/env python3

''' This script is used toupdate the contents of the Teams table'''

import mysql.connector
from mysql.connector import Error

try:
    updates = mysql.connector.connect(
        host = "localhost",
        user = "root",
        passwd = "toor",
        database = "ICFT"
    )

    mycursor = updates.cursor()

    if updates.is_connected():
        print("\nConnected successfully...\n")
        mycursor.execute("SELECT * FROM Teams")
        print("Here is a preview of the existing data : \n")
        for team in mycursor:
            print(team)

        print()
        print("If you do not need to update any data, type \"Q\" to quit")
        count  = 0
        while True:
            if count == 0:
                who = input("Which Team  would you like to update their data? : ") #ask usert who they want to update and get input
                if who == "Q":
                    break
                else:
                    get_input = '''SELECT * FROM Teams WHERE Continent = '%s' '''%(who) #use user's input in the query
                    mycursor.execute(get_input) #perfom the query
                    record = mycursor.fetchone()
                    print()
                    print("Below is the current data of the selected team :")
                    print(record)
                    print()
                    count +=1

                    #start  update operations
                    print("Please type Done when finished uptading all the relevant data columns for team ",who)
                    td = 0 #counter for team data columns
                    while True:
                        if td ==0 :
                            finished = input("\nWhich column would you like to update? : \n")
                            if finished == "Done":
                                print("\nNo changes made...")
                                break
                            else:
                                try:
                                    column_value = input("What do you want to update it to? \n")
                                    set_to = (finished, column_value,who)
                                    edit_column = '''UPDATE Teams set %s = '%s' WHERE Continent = '%s' '''%((finished),(column_value),(who))
                                    mycursor.execute(edit_column)
                                    updates.commit()
                                    #td +=1
                                except Error as err:
                                    print("An error occured...")
                                    print("\n",err,"\n")
                                    updates.rollback()


                        else:
                            finished = input(td , " columns done so far, ", 10-td, " columns still unedited...Who is next? :")

                            ###################################
                            #REPEAT THE ABOVE LINE 49 TO 63 INCLUSIVE
                            #Then paste the code to the other team segments i.e the else from line 77 below
                            ##################################




            else:
                who = input("Any other Team you  would like to update their data? : ") #ask usert who they want to update and get input
                if who == "Q":
                    break
                else:
                    get_input = '''SELECT * FROM Teams WHERE Continent = '%s' '''%(who) #use user's input in the query
                    mycursor.execute(get_input) #perfom the query
                    record = mycursor.fetchone()
                    print()
                    print("Below is the current data of the selected team :")
                    print(record)
                    print()
                    count +=1

except Error as err:
    print("\nERROR...Please read the message below...\n")
    print(err)
    print()

finally:
    if updates.is_connected():
        mycursor.close()
        updates.close()
        print("\nConnection terminated successfully \nGood Bye...\n")
