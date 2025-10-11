#!/data/data/com.termux/files/usr/bin/bash

# Set colors for better output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
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

# Function to setup CMS
setup_cms() {
    echo -e "${BLUE}Setting up CMS...${NC}"
    cd cms-app || return 1
    
    # Install root dependencies if needed
    if [ ! -d "node_modules" ]; then
        echo -e "${BLUE}Installing CMS root dependencies...${NC}"
        npm install
        if [ $? -ne 0 ]; then
            echo -e "${RED}❌ Failed to install CMS root dependencies${NC}"
            return 1
        fi
    fi
    
    # Install and build client if it exists
    if [ -d "client" ]; then
        cd client || return 1
        
        # Install client dependencies if needed
        if [ ! -d "node_modules" ]; then
            echo -e "${BLUE}Installing CMS client dependencies...${NC}"
            npm install
            if [ $? -ne 0 ]; then
                echo -e "${RED}❌ Failed to install CMS client dependencies${NC}"
                return 1
            fi
        fi
        
        # Build the client
        echo -e "${BLUE}Building CMS client...${NC}"
        npm run build
        if [ $? -ne 0 ]; then
            echo -e "${RED}❌ Failed to build CMS client${NC}"
            return 1
        fi
        
        cd ..  # Back to cms-app root
    else
        echo -e "${BLUE}⚠️  CMS client directory not found, skipping build${NC}"
    fi
    
    cd ..  # Back to project root
    return 0
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
    echo -e "${RED}❌ Please run this script from the project root directory.${NC}"
    exit 1
fi

# Create logs directory if it doesn't exist
mkdir -p logs

# Start the application
echo -e "\n${GREEN}🚀 Starting UnseenStay Application...${NC}"

# Setup and start CMS if it exists
if [ -d "cms-app" ]; then
    setup_cms
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ CMS setup failed. Check the errors above.${NC}"
        exit 1
    fi
    
    echo -e "${BLUE}Starting CMS Server...${NC}"
    cd cms-app || exit 1
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
tail -f logs/*.log 2>/dev/null || echo -e "${BLUE}No log files found yet. Logs will appear here...${NC}"
