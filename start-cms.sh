#!/data/data/com.termux/files/usr/bin/bash

# Set colors for better output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Function to check if port is in use
is_port_in_use() {
    local port=$1
    if command -v lsof &> /dev/null; then
        if lsof -i :$port -t &> /dev/null; then
            return 0
        fi
    else
        if netstat -tuln 2>/dev/null | grep -q ":$port "; then
            return 0
        fi
    fi
    return 1
}

# Function to kill process on port
kill_process_on_port() {
    local port=$1
    local pid
    
    if command -v lsof &> /dev/null; then
        pid=$(lsof -t -i :$port)
    else
        pid=$(netstat -tuln 2>/dev/null | grep ":$port " | awk '{print $7}' | cut -d'/' -f1)
    fi
    
    if [ ! -z "$pid" ]; then
        echo -e "${YELLOW}⚠️  Killing process $pid on port $port...${NC}"
        kill -9 $pid 2>/dev/null
        sleep 1
    fi
}

clear
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  UnseenStay CMS - Starting Server (Termux)"
echo -e "${GREEN}========================================${NC}"
echo

# Check if node is installed
if ! command -v node &> /dev/null; then
    echo -e "${YELLOW}Node.js is not installed. Installing...${NC}"
    pkg update -y && pkg install -y nodejs
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to install Node.js. Please install it manually.${NC}"
        exit 1
    fi
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo -e "${YELLOW}npm is not installed. Installing...${NC}"
    pkg install -y npm
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to install npm. Please install it manually.${NC}"
        exit 1
    fi
fi

# Navigate to cms-app directory
cd "$(dirname "$0")/cms-app"

# Install dependencies if node_modules doesn't exist
if [ ! -d "node_modules" ]; then
    echo -e "${YELLOW}Installing dependencies...${NC}"
    npm install
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to install dependencies. Please check the error above.${NC}"
        exit 1
    fi
fi

# Check if port 5000 is in use
if is_port_in_use 5000; then
    echo -e "${YELLOW}⚠️  Port 5000 is already in use.${NC}"
    read -p "Do you want to kill the process using port 5000? [y/N] " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        kill_process_on_port 5000
    else
        echo -e "${RED}❌ Cannot start server. Port 5000 is in use.${NC}"
        exit 1
    fi
fi

echo -e "\n${GREEN}✅ Starting UnseenStay CMS Server...${NC}"
echo -e "🌐 Website:     ${GREEN}http://localhost:5000/${NC}"
echo -e "🔐 Admin Panel: ${GREEN}http://localhost:5000/admin${NC}"
echo -e "\n📋 Login Credentials:"
echo "   Check .env file for credentials"
echo -e "\n📁 Data File: assets/data/content.json"
echo -e "\n${GREEN}Press Ctrl+C to stop the server${NC}"
echo -e "${GREEN}========================================${NC}"
echo

# Function to cleanup on exit
cleanup() {
    echo -e "\n${YELLOW}🛑 Stopping server...${NC}"
    # Kill any node processes started by this script
    pkill -f "node.*server/index\.js"
    exit 0
}

# Set trap to catch Ctrl+C
trap cleanup SIGINT SIGTERM

# Start the server
node server/index.js &
SERVER_PID=$!

# Wait for server to start
sleep 2

# Check if server started successfully
if ! ps -p $SERVER_PID > /dev/null; then
    echo -e "${RED}❌ Failed to start the server. Check the logs above for errors.${NC}"
    exit 1
fi

# Wait for server process to complete
wait $SERVER_PID
