import subprocess
import threading
import socket
import time
from http.server import HTTPServer, BaseHTTPRequestHandler

# Simple HTTP handler that just responds with 200 OK
class SimpleHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        self.send_response(200)
        self.send_header('Content-type', 'text/html')
        self.end_headers()
        self.wfile.write(b'PHP server is running on port 8080. Please access that port instead.')
    
    def log_message(self, format, *args):
        # Suppress log messages
        return

# Function to run a simple HTTP server on port 5000
def run_dummy_server():
    print("Starting dummy server on port 5000...")
    server = HTTPServer(('0.0.0.0', 5000), SimpleHandler)
    server.serve_forever()

# Start the dummy server in a separate thread
dummy_thread = threading.Thread(target=run_dummy_server, daemon=True)
dummy_thread.start()

# Start the PHP server
print("Starting PHP server on port 8080...")
php_process = subprocess.Popen(["php", "-S", "0.0.0.0:8080"])

try:
    # Keep the script running
    while True:
        time.sleep(1)
except KeyboardInterrupt:
    # Handle Ctrl+C gracefully
    print("Shutting down servers...")
    php_process.terminate()