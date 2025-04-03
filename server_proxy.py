#!/usr/bin/env python3
from flask import Flask, request, Response
import urllib.request
import subprocess
import time
import socket
import threading
import os

# Create Flask app
app = Flask(__name__)

# Start PHP server in a thread
def start_php_server():
    cmd = "php -S 0.0.0.0:8080"
    print(f"Starting PHP server: {cmd}")
    os.system(cmd)

# Check if port is open
def check_port(port):
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        return s.connect_ex(('localhost', port)) == 0

# Define proxy routes
@app.route('/', defaults={'path': ''})
@app.route('/<path:path>')
def proxy(path):
    url = f'http://localhost:8080/{path}'
    
    # Include query parameters if any
    if request.query_string:
        url += f'?{request.query_string.decode("utf-8")}'
    
    try:
        # Forward headers (except Host)
        headers = {key: value for (key, value) in request.headers.items() 
                  if key.lower() != 'host'}
        
        # Create request
        req = urllib.request.Request(url, headers=headers)
        
        # Get response from PHP server
        response = urllib.request.urlopen(req)
        content = response.read()
        
        # Create Flask response
        resp = Response(content)
        
        # Copy headers from PHP response
        for header, value in response.getheaders():
            if header.lower() != 'transfer-encoding':
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
        # Forward headers (except Host)
        headers = {key: value for (key, value) in request.headers.items() 
                  if key.lower() != 'host'}
        
        # Get POST data
        post_data = request.get_data()
        
        # Create request
        req = urllib.request.Request(url, data=post_data, headers=headers, method='POST')
        
        # Get response
        response = urllib.request.urlopen(req)
        content = response.read()
        
        # Create Flask response
        resp = Response(content)
        
        # Copy headers from PHP response
        for header, value in response.getheaders():
            if header.lower() != 'transfer-encoding':
                resp.headers[header] = value
                
        return resp
    except Exception as e:
        return f"<html><body><h1>Error</h1><p>{str(e)}</p></body></html>", 500

if __name__ == '__main__':
    # Start PHP server in a separate thread
    if not check_port(8080):
        print("Starting PHP server thread...")
        php_thread = threading.Thread(target=start_php_server, daemon=True)
        php_thread.start()
        time.sleep(2)  # Give PHP server time to start
    
    # Start the Flask app
    app.run(host='0.0.0.0', port=5000, debug=True)