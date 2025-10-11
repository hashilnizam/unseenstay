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

# Start the application
echo -e "\n${GREEN}🚀 Starting UnseenStay Application...${NC}"
echo -e "\n${BLUE}Available Services:${NC}"
echo -e "1. CMS Server (http://localhost:5000)"
echo -e "2. Main Application"
echo -e "\n${GREEN}Press Ctrl+C to stop the servers${NC}"
echo -e "${GREEN}========================================${NC}"
echo

# Start CMS server in the background
cd cms-app
npm start &

# Go back to root directory
cd ..

# Start main application
npm start

# If using PM2, you can uncomment these lines:
# echo -e "${BLUE}Starting services with PM2...${NC}"
# pm2 start ecosystem.config.js
# pm2 logs 0
