#!/data/data/com.termux/files/usr/bin/bash

# Colors for better output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  UnseenStay CMS - Setup Script (Termux)${NC}"
echo -e "${GREEN}========================================${NC}"
echo

# Function to check if a command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Check for required commands
if ! command_exists node || ! command_exists npm; then
    echo -e "${BLUE}Installing Node.js and npm...${NC}"
    pkg update -y && pkg install -y nodejs
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to install Node.js and npm${NC}"
        exit 1
    fi
fi

# Install root dependencies
echo -e "${BLUE}[1/4] Installing root dependencies...${NC}"
npm install
if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Failed to install root dependencies${NC}"
    exit 1
fi

# Install client dependencies
if [ -d "client" ]; then
    echo -e "${BLUE}[2/4] Installing client dependencies...${NC}"
    cd client
    npm install
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to install client dependencies${NC}"
        exit 1
    }
    
    # Build the client
    echo -e "${BLUE}[3/4] Building client...${NC}"
    npm run build
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to build client${NC}"
        exit 1
    }
    cd ..
else
    echo -e "${BLUE}⚠️  Client directory not found, skipping client setup${NC}"
fi

# Setup environment file
if [ ! -f ".env" ]; then
    echo -e "${BLUE}[4/4] Creating .env file...${NC}"
    if [ -f ".env.example" ]; then
        cp .env.example .env
        echo -e "✅ Created .env file from template"
        echo -e "\n${GREEN}IMPORTANT: Please edit .env file with your settings:${NC}"
        echo "  - Change JWT_SECRET to a random string"
        echo "  - Update GIT_USER_NAME and GIT_USER_EMAIL"
        echo "  - Add GITHUB_TOKEN for Git integration"
    else
        echo -e "${RED}❌ .env.example not found, please create it manually${NC}"
        touch .env
    fi
else
    echo -e "${BLUE}✓ .env file already exists${NC}"
fi

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}  Setup completed successfully!${NC}"
echo -e "${GREEN}========================================${NC}"
echo -e "\n${BLUE}Next steps:${NC}"
echo "1. Edit .env file with your configuration"
echo "2. Start the development server:"
echo "   $ npm run dev"
echo -e "\n${GREEN}Or in production:${NC}"
echo "   $ npm start"
echo -e "\n${GREEN}========================================${NC}"
