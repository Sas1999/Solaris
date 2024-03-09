import requests
import random
import time

# Function to send random data to the PHP script
def send_random_data():
    url = 'http://localhost/solar.com/insert_data1.php'  # Replace with the correct path to your PHP script

    # Generate random data
    voltage = random.uniform(100, 500)
    current = random.uniform(1, 10)
    power = voltage * current
    frequency = random.uniform(50, 60)
    solar_intensity = random.uniform(0, 1000)
    meter_name = 'Meter123'  # Replace with an appropriate meter name

    # Prepare the data payload
    data = {
        'insert': True,
        'v': voltage,
        'c': current,
        'f': frequency,
        'p': power,
        'sr': solar_intensity,
        'm': meter_name
    }

    # Send a POST request to the PHP script
    response = requests.post(url, data=data)

    # Print the response from the server
    print(response.text)

# Send random data every 5 seconds (adjust as needed)
while True:
    send_random_data()
    time.sleep(5)


