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

echo -e "${BLUE}[1/4] Installing backend dependencies...${NC}"
npm install
if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Failed to install backend dependencies${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Backend dependencies installed${NC}\n"

# Install client dependencies
if [ -d "client" ]; then
    echo -e "${BLUE}[2/4] Installing frontend dependencies...${NC}"
    cd client
    npm install
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to install frontend dependencies${NC}"
        exit 1
    fi
    
    # Build the client
    echo -e "\n${BLUE}[3/4] Building frontend...${NC}"
    npm run build
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Failed to build frontend${NC}"
        exit 1
    fi
    cd ..
    echo -e "${GREEN}✓ Frontend dependencies installed and built${NC}\n"
else
    echo -e "${BLUE}⚠️  Client directory not found, skipping frontend setup${NC}"
fi

# Setup environment file
echo -e "${BLUE}[4/4] Setting up environment file...${NC}"
if [ ! -f ".env" ]; then
    if [ -f ".env.example" ]; then
        cp .env.example .env
        echo -e "${GREEN}✓ Created .env file from template"
    else
        echo -e "${YELLOW}⚠️  .env.example not found, creating empty .env file"
        touch .env
    fi
else
    echo -e "${GREEN}✓ .env file already exists"
fi

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}  Setup complete!"
echo -e "${GREEN}========================================${NC}"
echo -e "\n${BLUE}Next Steps:${NC}"
echo "1. Edit .env file with your configuration"
echo "   - Change JWT_SECRET to a random string"
echo "   - Update GIT_USER_NAME and GIT_USER_EMAIL"
echo "   - Add GITHUB_TOKEN for Git integration"
echo "2. Run: npm run dev"
echo "3. Open: http://localhost:3000"
echo "4. Login with: admin / admin123"
echo -e "\n${GREEN}For detailed instructions, see README.md${NC}"
echo -e "${GREEN}========================================${NC}"

echo -n "Press any key to continue..."
read -n 1 -s -r
echo
