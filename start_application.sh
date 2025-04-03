#!/bin/bash

# Start Python proxy server with gunicorn
gunicorn --bind 0.0.0.0:5000 wsgi:application