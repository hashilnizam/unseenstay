#!/data/data/com.termux/files/usr/bin/bash

# Set colors for better output
GREEN='\033[0;32m'
NC='\033[0m' # No Color

clear
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  UnseenStay CMS - Starting Server (Termux)"
echo -e "${GREEN}========================================${NC}"
echo

# Check if node is installed
if ! command -v node &> /dev/null; then
    echo "Node.js is not installed. Installing..."
    pkg update -y && pkg install -y nodejs
    if [ $? -ne 0 ]; then
        echo "Failed to install Node.js. Please install it manually."
        exit 1
    fi
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "npm is not installed. Installing..."
    pkg install -y npm
    if [ $? -ne 0 ]; then
        echo "Failed to install npm. Please install it manually."
        exit 1
    fi
fi

# Navigate to cms-app directory
cd "$(dirname "$0")/cms-app"

# Install dependencies if node_modules doesn't exist
if [ ! -d "node_modules" ]; then
    echo "Installing dependencies..."
    npm install
    if [ $? -ne 0 ]; then
        echo "Failed to install dependencies. Please check the error above."
        exit 1
    fi
fi

echo -e "\n${GREEN}✅ Server is starting...${NC}"
echo -e "🌐 Website:     ${GREEN}http://localhost:5000/${NC}"
echo -e "🔐 Admin Panel: ${GREEN}http://localhost:5000/admin${NC}"
echo -e "\n📋 Login Credentials:"
echo "   Check .env file for credentials"
echo -e "\n📁 Data File: assets/data/content.json"
echo -e "\n${GREEN}Press Ctrl+C to stop the server${NC}"
echo -e "${GREEN}========================================${NC}"
echo

# Start the server
node server/index.js
