#!/data/data/com.termux/files/usr/bin/bash

# Set colors for better output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to check if a command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Function to install required packages
install_requirements() {
    echo -e "${BLUE}Updating packages...${NC}"
    pkg update -y
    
    echo -e "${BLUE}Installing required packages...${NC}"
    pkg install -y nodejs git
    
    # Install pm2 globally if not installed
    if ! command_exists pm2; then
        echo -e "${BLUE}Installing PM2 process manager...${NC}"
        npm install -g pm2
    fi
}

# Main script
clear
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}     UnseenStay - Application Starter${NC}"
echo -e "${GREEN}========================================${NC}"
echo

# Check and install requirements
if ! command_exists node || ! command_exists git; then
    echo -e "${BLUE}Required packages not found. Installing...${NC}"
    install_requirements
fi

# Check if we're in the correct directory
if [ ! -f "package.json" ]; then
    echo -e "${BLUE}Please run this script from the project root directory.${NC}"
    exit 1
fi

# Install dependencies if node_modules doesn't exist
if [ ! -d "node_modules" ]; then
    echo -e "${BLUE}Installing project dependencies...${NC}"
    npm install
    if [ $? -ne 0 ]; then
        echo -e "❌ Failed to install dependencies. Please check the error above."
        exit 1
    fi
fi

# Create logs directory if it doesn't exist
mkdir -p logs

# Start the application
echo -e "\n${GREEN}🚀 Starting UnseenStay Application...${NC}"
echo -e "\n${BLUE}Available Services:${NC}"
echo -e "1. CMS Server (http://localhost:5000)"
echo -e "2. Main Application"
echo -e "\n${GREEN}Press Ctrl+C to stop the servers${NC}"
echo -e "${GREEN}========================================${NC}"
echo

# Check if cms-app exists and start it
if [ -d "cms-app" ]; then
    echo -e "${BLUE}Starting CMS Server...${NC}"
    cd cms-app
    # Install CMS dependencies if needed
    if [ ! -d "node_modules" ]; then
        echo -e "${BLUE}Installing CMS dependencies...${NC}"
        npm install
    fi
    # Use nohup to prevent termination when the terminal closes
    nohup npm start > ../logs/cms.log 2>&1 &
    CMS_PID=$!
    echo -e "✅ CMS Server started (PID: $CMS_PID) - Logs: logs/cms.log"
    cd ..
else
    echo -e "${BLUE}⚠️  cms-app directory not found, skipping CMS server${NC}"
fi

# Start main application
echo -e "\n${BLUE}Starting Main Application...${NC}"
nohup npm start > logs/app.log 2>&1 &
APP_PID=$!
echo -e "✅ Main Application started (PID: $APP_PID) - Logs: logs/app.log"

# Cleanup function
cleanup() {
    echo -e "\n${GREEN}Shutting down services...${NC}"
    if [ ! -z "$CMS_PID" ]; then
        echo -n "Stopping CMS Server... "
        kill $CMS_PID 2>/dev/null
        echo "✅"
    fi
    if [ ! -z "$APP_PID" ]; then
        echo -n "Stopping Main Application... "
        kill $APP_PID 2>/dev/null
        echo "✅"
    fi
    exit 0
}

# Set up trap to catch Ctrl+C
trap cleanup INT

# Keep the script running and show logs
echo -e "\n${GREEN}📝 Tailing logs (Ctrl+C to stop all services)...${NC}"
echo -e "${GREEN}========================================${NC}"
tail -f logs/*.log
