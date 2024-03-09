import streamlit as st
import pandas as pd
import mysql.connector
import time

# Create a connection to the MySQL database
connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="solart"
)

# Create a function to fetch data from the database
def fetch_data():
    query = "SELECT * FROM sensordata1"
    df = pd.read_sql_query(query, connection)
    return df

# Fetch data from the database initially
data = fetch_data()

# Create a Streamlit app to display the data
st.title("Solar Database")
st.write("Displaying all columns from the sensordata1 table:")
data_display = st.empty()

# Define a callback function to update the dataframe periodically
def update_data():
    global data
    new_data = fetch_data()
    data = pd.concat([new_data, data], ignore_index=True)
    data = data.sort_index(ascending=False)  # Sort by default index in reverse order
    data_display.dataframe(data)

# Run the callback function every 5 seconds
while True:
    time.sleep(5)
    update_data()
