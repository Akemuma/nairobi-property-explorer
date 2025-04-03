import threading
import time
import subprocess
from main import app

def start_php_server():
    print("Starting PHP server on port 8080...")
    php_process = subprocess.Popen(["php", "-S", "0.0.0.0:8080"], stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    time.sleep(3)  # Give it more time to start up
    print("PHP server started with PID:", php_process.pid)

# Start PHP server in a separate thread
threading.Thread(target=start_php_server, daemon=True).start()

# Entry point for gunicorn
application = app