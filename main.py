from flask import Flask, request, Response
import urllib.request
import os
import threading
import subprocess
import time

app = Flask(__name__)

# Start PHP server in the background
def start_php_server():
    print("Starting PHP server on port 8080...")
    php_process = subprocess.Popen(["php", "-S", "0.0.0.0:8080"], stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    time.sleep(3)  # Give it more time to start up
    print("PHP server started with PID:", php_process.pid)

# Define proxy functionality
@app.route('/', defaults={'path': ''})
@app.route('/<path:path>')
def proxy(path):
    url = f'http://localhost:8080/{path}'
    
    # Get query parameters
    if request.query_string:
        url += f'?{request.query_string.decode("utf-8")}'
    
    try:
        # Create request with same headers
        headers = {key: value for (key, value) in request.headers if key != 'Host'}
        req = urllib.request.Request(url, headers=headers)
        
        # Get response from PHP server
        response = urllib.request.urlopen(req)
        content = response.read()
        
        # Create Flask response
        resp = Response(content)
        
        # Copy headers from PHP response
        for header, value in response.getheaders():
            if header.lower() != 'transfer-encoding':  # Skip transfer-encoding header
                resp.headers[header] = value
                
        return resp
    except Exception as e:
        return f"<html><body><h1>Error</h1><p>{str(e)}</p></body></html>", 500

# Handle POST requests
@app.route('/', defaults={'path': ''}, methods=['POST'])
@app.route('/<path:path>', methods=['POST'])
def proxy_post(path):
    url = f'http://localhost:8080/{path}'
    
    try:
        # Get POST data
        post_data = request.get_data()
        
        # Create request with POST data and headers
        headers = {key: value for (key, value) in request.headers if key != 'Host'}
        req = urllib.request.Request(url, data=post_data, headers=headers, method='POST')
        
        # Get response
        response = urllib.request.urlopen(req)
        content = response.read()
        
        # Create Flask response
        resp = Response(content)
        
        # Copy headers from PHP response
        for header, value in response.getheaders():
            if header.lower() != 'transfer-encoding':  # Skip transfer-encoding header
                resp.headers[header] = value
                
        return resp
    except Exception as e:
        return f"<html><body><h1>Error</h1><p>{str(e)}</p></body></html>", 500

if __name__ == "__main__":
    # Start PHP server in a separate thread
    threading.Thread(target=start_php_server, daemon=True).start()
    
    # Start Flask app without debug mode for Replit workflows
    app.run(host="0.0.0.0", port=5000, debug=False)