# ✨ Unseenstay - Luxury Travel Destination Portfolio

> A sophisticated, dynamic portfolio platform showcasing exclusive travel destinations and luxury accommodations with an intuitive card-based navigation system and powerful content management capabilities.

<div align="center">
  <a href="https://www.instagram.com/hashilnisam/" target="_blank">
    <img src="https://img.shields.io/badge/Follow-@hashilnisam-E4405F?style=for-the-badge&logo=instagram&logoColor=white" alt="Instagram" />
  </a>
  <a href="https://github.com/hashilnizam">
    <img src="https://img.shields.io/badge/GitHub-hashilnizam-181717?style=for-the-badge&logo=github" alt="GitHub" />
  </a>
  <a href="mailto:hashilnizam@gmail.com">
    <img src="https://img.shields.io/badge/Email-hashilnizam%40gmail.com-0078D4?style=for-the-badge&logo=gmail" alt="Email" />
  </a>
</div>

## 🚀 Project Overview

Unseenstay is a comprehensive travel portfolio solution with two main components:
1. **Frontend Website**: A beautiful, responsive showcase of travel destinations
2. **CMS (Content Management System)**: Secure admin panel for managing all content

### 🌟 Key Features

#### Frontend Website
- 🖼️ Dynamic card-based navigation system
- 📱 Fully responsive design for all devices
- ⚡ Optimized performance with lazy loading
- 🎨 Smooth animations and transitions
- 🔍 SEO optimized structure
- 📱 Mobile-first approach with iOS optimizations
- 🎯 Touch-optimized interface

#### CMS Features
- 🔐 Secure authentication with JWT
- 📝 Content management for destinations, images, and metadata
- 📱 Mobile-responsive admin interface
- 🔄 Git integration for version control
- 📊 Media library with image optimization
- 🔄 Real-time preview of changes
- 🔒 Role-based access control

## 🛠️ Technology Stack

### Frontend
- **Core**: HTML5, CSS3, JavaScript (ES6+)
- **UI/UX**: 
  - [Swiper.js](https://swiperjs.com/) for touch-enabled sliders
  - [GSAP](https://greensock.com/gsap/) for smooth animations
  - [LazySizes](https://github.com/aFarkas/lazysizes) for optimized loading
  - Custom CSS Grid/Flexbox layouts

### Backend (CMS)
- **Runtime**: Node.js with Express.js
- **Authentication**: JWT (JSON Web Tokens)
- **Security**:
  - Helmet.js for HTTP headers
  - Rate limiting
  - XSS protection
  - CSRF protection
- **File Handling**: 
  - Multer for uploads
  - Sharp for image optimization
- **Version Control**: Git integration
- **Version Control**: Git integration

## 📁 Project Structure

```
unseenstay/
├── assets/                  # Static assets
│   ├── banner/             # Banner images
│   ├── brand-logo/         # Brand assets
│   ├── core/               # Core styles and scripts
│   └── images/             # All website images
├── cms-app/                # Admin panel application
│   ├── client/             # React frontend
│   │   ├── public/         # Static files
│   │   └── src/            # React source code
│   │       ├── components/ # Reusable UI components
│   │       ├── context/    # React context providers
│   │       ├── pages/      # Page components
│   │       └── utils/      # Utility functions
│   └── server/             # Node.js backend
│       ├── config/         # Configuration files
│       ├── controllers/    # Route controllers
│       ├── middleware/     # Express middleware
│       ├── models/         # Database models
│       ├── routes/         # API routes
│       ├── utils/          # Utility functions
│       └── index.js        # Server entry point
├── unseenstay-app/         # Main frontend application
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   └── index.html         # Main HTML file
├── .env-example           # Environment variables template
├── README.md              # This file
└── package.json           # Project dependencies
```

## 🔒 Security Features

### Authentication & Authorization
- JWT-based authentication with secure HTTP-only cookies
- Session management with token expiration and refresh tokens
- Role-based access control (RBAC) for admin panel
- Rate limiting to prevent brute force attacks

### Data Protection
- Input validation and sanitization
- XSS (Cross-Site Scripting) protection
- CSRF (Cross-Site Request Forgery) protection
- Secure HTTP headers via Helmet.js
- Environment variable management
- NoSQL injection prevention

### Secure File Handling
- File type validation
- File size limits
- Image optimization with Sharp
- Secure file storage with proper permissions

## 📱 Mobile Optimization

### Performance
- Responsive design with mobile-first approach
- Optimized asset delivery
- Lazy loading of images and components
- Minimized main thread work

### Touch Optimization
- Touch-friendly UI elements
- Smooth scrolling and momentum
- Touch gestures support
- Optimized form inputs for mobile

### iOS Specific
- Viewport configuration
- Touch icons and splash screens
- Safari-specific optimizations
- Status bar customization
```

## 🚀 Getting Started

### Prerequisites
- Node.js 16+ and npm 8+ or yarn
- Git
- MongoDB (for CMS)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/hashilnizam/unseenstay.git
   cd unseenstay
   ```

2. **Install dependencies**
   ```bash
   # Install root dependencies
   npm install
   
   # Install CMS client dependencies
   cd cms-app/client
   npm install
   
   # Install CMS server dependencies
   cd ../server
   npm install
   
   # Return to project root
   cd ../../
   ```

3. **Set up environment variables**
   - Copy `.env-example` to `.env` in both root and `cms-app/server/`
   - Update the environment variables with your configuration

4. **Start the development servers**
   ```bash
   # Start main website (from project root)
   npm run dev
   
   # In a new terminal, start CMS server
   cd cms-app/server
   npm run dev
   
   # In another terminal, start CMS client
   cd ../client
   npm start
   ```

## 🌐 Environment Variables

### Main Application
```env
# Server
PORT=3000
NODE_ENV=development

# Frontend
API_BASE_URL=http://localhost:3000
```

### CMS Application
```env
# Server
PORT=5000
NODE_ENV=development
JWT_SECRET=your_jwt_secret
ADMIN_USERNAME=your_admin_username
ADMIN_PASSWORD=your_secure_password

# File Uploads
MAX_FILE_SIZE=5242880  # 5MB
UPLOAD_DIR=./uploads

- XSS protection
- CSRF protection
- Secure session management
- Input validation and sanitization
- Secure file upload handling

## 📱 Mobile Optimization

- Responsive design using CSS Grid and Flexbox
- Touch-optimized navigation
- Adaptive image loading
- Performance optimizations for mobile devices
- Offline capabilities with service workers

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- All contributors who helped in testing and feedback
- Open source libraries that made this project possible
- The travel and design communities for inspiration

## 📬 Contact

For inquiries, collaborations, or support:
- 📧 Email: [your.email@example.com](mailto:your.email@example.com)
- 📱 Instagram: [@hashilnisam](https://www.instagram.com/hashilnisam/)
- 💼 LinkedIn: [Hashil Nisam](https://www.linkedin.com/in/hashilnisam/)

---

<div align="center">
  Made with ❤️ by <a href="https://github.com/hashilnizam">Hashil Nisam</a>
</div>
- ✅ **Zero Framework Architecture** - Pure vanilla JavaScript, no dependencies
- ✅ **JSON-Driven CMS** - Complete content management through single JSON file
- ✅ **Three-Tier Navigation System** - Hierarchical destination browsing
- ✅ **Mobile-First Responsive Design** - Optimized for all devices
- ✅ **WhatsApp Booking Integration** - Direct customer engagement
- ✅ **Dynamic Image Galleries** - Swiper.js powered slideshows
- ✅ **Scroll-Based Animations** - Smooth reveal effects on mobile
- ✅ **iOS Safari Optimized** - Custom fixes for Apple devices

### Design Philosophy
- **Performance-First**: Minimal dependencies, fast load times
- **Content-Driven**: Easy updates without touching code
- **User-Centric**: Intuitive navigation and booking flow
- **Developer-Friendly**: Clean, documented, maintainable code

---

## 🛠️ Technology Stack

### Frontend Technologies

| Technology | Version | Purpose | Implementation |
|------------|---------|---------|----------------|
| **HTML5** | - | Semantic markup & structure | `index.html` |
| **CSS3** | - | Styling, animations, responsive design | `style.css`, `combined.css` |
| **JavaScript (ES6+)** | Vanilla | Core application logic | `core.js` |
| **JSON** | - | Data configuration & content management | `data.json` |

### Libraries & Plugins

| Library | Purpose | Usage |
|---------|---------|-------|
| **Swiper.js** | Touch-enabled image slider | Modal image galleries |
| **Font Awesome** | Icon library | Social media icons, UI elements |
## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Swiper.js](https://swiperjs.com/) for touch-enabled sliders
- [GSAP](https://greensock.com/gsap/) for smooth animations
- [LazySizes](https://github.com/aFarkas/lazysizes) for optimized image loading
- The travel and design communities for inspiration

## 📬 Contact

For inquiries, collaborations, or support:

- **Email**: [hashilnizam@gmail.com](mailto:hashilnizam@gmail.com)
- **GitHub**: [@hashilnizam](https://github.com/hashilnizam)
- **Instagram**: [@hashilnisam](https://www.instagram.com/hashilnisam/)

---

<div align="center">
  Made with ❤️ by Hashil Nisam
  <br>
  <a href="https://www.instagram.com/hashilnisam/" target="_blank">
    <img src="https://img.shields.io/badge/Follow-@hashilnisam-E4405F?style=for-the-badge&logo=instagram&logoColor=white" alt="Instagram" />
  </a>
</div>
- ✅ Firefox 88+
- ✅ Safari 14+ (iOS optimized)
- ✅ Edge 90+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

### Development Tools Used
- **Code Editor**: Visual Studio Code
- **Version Control**: Git
- **Testing**: Chrome DevTools, iOS Safari Inspector
- **Optimization**: Manual CSS/JS optimization

---

## 📁 Folder Structure

```
unseenstay/
│
├── index.html                      # Main HTML file
│
├── assets/
│   ├── banner/                     # Hero section videos
│   │   └── unseenstay.mp4
│   │
│   ├── brand-logo/                 # Logo assets
│   │   ├── logo-white.png          # Light theme logo
│   │   └── logo-black.png          # Dark theme logo
│   │
│   ├── core/                       # Core functionality
│   │   ├── data.json               # ⭐ Main content configuration
│   │   └── core.js                 # ⭐ Main application logic
│   │
│   ├── css/
│   │   ├── combined.css            # Third-party CSS libraries
│   │   └── style.css               # Custom styles & mobile fixes
│   │
│   ├── js/
│   │   └── combined.js             # Third-party JavaScript libraries
│   │
│   ├── images/                     # Portfolio images
│   │   ├── portfolio-*.jpg         # Destination images
│   │   ├── bg-*.jpg                # Background images
│   │   └── partner-logo-*.png      # Partner logos
│   │
│   ├── fonts/                      # Custom fonts
│   └── files/                      # Additional resources
│
└── README.md                       # This file
```

---

## 🗂️ Data Architecture

### Configuration File: `assets/core/data.json`

**Architect**: Hashil Nisam

The entire website content is managed through a single, centralized JSON configuration file. This architecture allows non-technical users to update content without touching code.

### JSON Structure Overview

```json
{
  "site": {},           // Site metadata
  "logo": {},           // Logo configuration
  "navbar": {},         // Navigation menu
  "header": {},         // Hero section
  "about": {},          // About section (optional)
  "destinations": {},   // Main content (3-tier structure)
  "contact": {},        // Contact information
  "footer": {}          // Footer content
}
```

### Data Flow Architecture

```
data.json → Fetch API → JavaScript Parser → DOM Manipulation → Rendered UI
```

### Detailed Structure

#### 1. **Site Configuration**
```json
{
  "site": {
    "title": "Snow | One Page Agency"
  }
}
```

#### 2. **Logo Settings**
```json
{
  "logo": {
    "light": "assets/brand-logo/logo-white.png",
    "dark": "assets/brand-logo/logo-black.png",
    "width": 35,
    "alt": "Brand Logo"
  }
}
```

#### 3. **Navigation Menu**
```json
{
  "navbar": {
    "menu": [
      { "name": "Portfolio", "link": "index.html#projects" },
      { "name": "Contact", "link": "index.html#contact" }
    ]
  }
}
```

#### 4. **Hero Section**
```json
{
  "header": {
    "backgroundVideo": "assets/banner/unseenstay.mp4",
    "subtitle": "Unseenstay",
    "title": "Design your dream stay<br><em>crafted for comfort and style</em>",
    "paragraph": "Experience thoughtfully designed stays..."
  }
}
```

#### 5. **Destinations (Three-Tier Structure)**

**Tier 1: Main Destination Cards**
```json
{
  "destinations": {
    "intro": {
      "heading": "Luxury Resort Destinations",
      "paragraph": "Explore our curated collection..."
    },
    "cards": [
      {
        "id": "dest1",
        "image": "assets/images/portfolio-3-sm.jpg",
        "name": "Maldives Atoll Retreat",
        "category": "Tropical Island",
        "cardHeading": "The Ultimate Ocean Escape",
        "cardParagraph": "Experience paradise...",
        "subCards": [...]
      }
    ]
  }
}
```

**Tier 2: Sub-Destination Cards (Properties/Experiences)**
```json
{
  "subCards": [
    {
      "id": "sub1",
      "images": ["image1.jpg", "image2.jpg"],
      "name": "Overwater Bungalows",
      "category": "Accommodation",
      "location": "Valliyakolli, Wayanad",
      "propertyDetails": {
        "BHK": "3 BHK",
        "Resort": "Luxury Beach Resort",
        "Max Guests": "6 People",
        "Area": "2500 sq ft"
      },
      "inclusions": ["Pool", "Breakfast", "Wi-Fi"],
      "checkInOut": {
        "Check-in": "2:00 PM - 3:00 PM",
        "Check-out": "11:00 AM - 11:30AM"
      },
      "addOnExperiences": ["Campfire", "BBQ"],
      "nearbyAttractions": ["Beach", "Temple"]
    }
  ]
}
```

#### 6. **Contact Section**
```json
{
  "contact": {
    "heading": "Contact Info:",
    "info": "Contact description...",
    "phone": ["+917561845352", "+919876543210"],
    "email": "info@Example.com"
  }
}
```

#### 7. **Footer**
```json
{
  "footer": {
    "social": [
      { "platform": "twitter", "url": "https://twitter.com/..." },
      { "platform": "facebook", "url": "https://facebook.com/..." }
    ],
    "text": "2016 © Design by Unvab. Code by nK"
  }
}
```

---

## 💻 Code Architecture

### Core JavaScript (`core.js`) - By Hashil Nisam

#### 1. **Initialization Flow**
```javascript
DOMContentLoaded → fetchData() → initializeApp()
```

#### 2. **Main Functions**

| Function | Purpose | Lines |
|----------|---------|-------|
| `fetchData()` | Loads data.json via Fetch API | ~50-60 |
| `populateSiteMetadata()` | Sets title, logos, navigation | ~100-150 |
| `loadHeaderContent()` | Renders hero section with video | ~200-250 |
| `renderDestinations()` | Creates main destination cards | ~1095-1115 |
| `handleCardClick()` | Shows sub-destinations section | ~1118-1140 |
| `renderSubDestinations()` | Displays property cards | ~1143-1162 |
| `openModal()` | Shows detailed property modal | ~1164-1300 |
| `initializeSwiper()` | Sets up image gallery | ~1250-1280 |
| `handleContactForm()` | WhatsApp integration | ~1400-1450 |

#### 3. **Event Handling Architecture**

```javascript
// Event Delegation Pattern
document.addEventListener('click', (e) => {
  if (e.target.matches('.main-card')) → Show Sub-Destinations
  if (e.target.matches('.sub-card')) → Open Modal
  if (e.target.matches('.close-modal')) → Close Modal
});
```

#### 4. **State Management**

```javascript
// Application State
const appState = {
  currentDestination: null,
  currentSubDestination: null,
  modalOpen: false,
  swiperInstance: null
};
```

#### 5. **DOM Manipulation Strategy**

- **Dynamic Content Injection**: Using `innerHTML` for card generation
- **Template Literals**: ES6 template strings for HTML construction
- **Event Listeners**: Attached after DOM insertion
- **Section Visibility**: `display: none/block` toggling

### CSS Architecture (`style.css`)

#### 1. **Structure**
```css
/* Contact Form Styling */        → Lines 1-137
/* Scroll-Based Animations */     → Lines 139-196
/* Mobile Media Queries */        → Lines 32-137, 167-196
/* iOS Safari Fixes */            → Lines 55-135
```

#### 2. **Key CSS Techniques**

| Technique | Purpose | Implementation |
|-----------|---------|----------------|
| **Flexbox** | Layout structure | `.nk-nav-table`, `.nk-header-table` |
| **CSS Grid** | Portfolio cards | `.nk-isotope-3-cols` |
| **Transform & Transitions** | Smooth animations | `transform: translateY()` |
| **Media Queries** | Responsive design | `@media (max-width: 768px)` |
| **Pseudo-elements** | Custom placeholders | `::before`, `::after` |
| **Webkit Prefixes** | iOS compatibility | `::-webkit-datetime-edit-*` |

#### 3. **Animation System**

```css
/* Mobile Scroll Reveal */
.portfolio-item-title {
  opacity: 0;
  transform: translateY(30px) scale(0.95);
  transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.portfolio-item.reveal .portfolio-item-title {
  opacity: 1;
  transform: translateY(0) scale(1);
}
```

### HTML Structure (`index.html`)

#### Semantic Sections
```html
<header>           → Navigation & Logo
<div.nk-main>
  ├── Hero Section          → Video background + Title
  ├── Destinations          → Main cards (Tier 1)
  ├── Sub-Destinations      → Property cards (Tier 2)
  ├── Features              → Statistics section
  ├── Sub-Sub-Destinations  → Additional properties (Tier 3)
  ├── Partners              → Logo carousel
  └── Contact               → Booking form
</div>
<footer>           → Social links & Copyright
```

---

## 🔄 Workflow & Navigation

### User Journey Flow

```
1. Landing Page (Hero Section)
   ↓
2. Main Destinations Grid (Tier 1)
   │
   ├─→ Click on Destination Card
   │   ↓
   │   3. Sub-Destinations Section (Tier 2)
   │      │
   │      ├─→ Click on Sub-Destination Card
   │      │   ↓
   │      │   4. Modal with Full Details
   │      │      - Image Gallery (Swiper)
   │      │      - Property Details
   │      │      - Inclusions
   │      │      - Check-in/out Times
   │      │      - Add-on Experiences
   │      │      - Nearby Attractions
   │      │      - WhatsApp Booking Button
   │
   └─→ Scroll to Contact Form
       ↓
       5. WhatsApp Booking Form
```

### Core Logic Flow (`core.js`)

1. **Initialization**
   - Fetch `data.json`
   - Populate site metadata, logos, navigation
   - Load hero section content

2. **Main Destinations Rendering**
   - Loop through `destinations.cards`
   - Create portfolio cards with images and titles
   - Attach click event listeners

3. **Sub-Destinations Display**
   - On main card click → Show sub-destinations section
   - Update heading with `mainCard.name`
   - Update paragraph with `mainCard.cardParagraph`
   - Render sub-cards from `mainCard.subCards`

4. **Modal Display**
   - On sub-card click → Open modal
   - Initialize Swiper image gallery
   - Populate all property details
   - Generate WhatsApp booking link

5. **Contact Form**
   - Collect user inputs (name, dates, location, budget)
   - Format WhatsApp message
   - Redirect to WhatsApp with pre-filled message

---

## 🎨 UI Effects & Features

### 1. **Scroll-Based Card Reveal Animation** (Mobile)
- Cards fade in and slide up when scrolled into view
- Smooth cubic-bezier transitions
- Desktop: Hover effects only
- Mobile: Scroll-triggered reveals

**Implementation**: `style.css` lines 166-196
```css
@media (max-width: 768px) {
  .nk-portfolio-item .portfolio-item-title {
    opacity: 0;
    transform: translateY(30px) scale(0.95);
    transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
  }
  
  .nk-portfolio-item.reveal .portfolio-item-title {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}
```

### 2. **Dynamic Logo Switching**
- Light logo on transparent navbar
- Dark logo on scroll/white background
- Smooth transitions

### 3. **Video Background Hero**
- Autoplay, loop, muted video
- Overlay with opacity control
- Responsive text overlay

### 4. **Image Gallery (Swiper.js)**
- Touch-enabled swipe navigation
- Pagination dots
- Lazy loading support

### 5. **Sticky Navigation**
- Transparent on top
- Solid background on scroll
- Mobile hamburger menu

### 6. **WhatsApp Integration**
- Pre-filled message with booking details
- Uses first phone number from `contact.phone` array
- Format: `https://wa.me/[phone]?text=[message]`

---

## ⚙️ Configuration Guide

### Adding a New Destination

1. **Edit `assets/core/data.json`**
2. **Add to `destinations.cards` array:**

```json
{
  "id": "dest11",
  "image": "assets/images/your-image.jpg",
  "name": "Your Destination Name",
  "category": "Category Type",
  "cardHeading": "Catchy Heading",
  "cardParagraph": "Description paragraph...",
  "subCards": [
    {
      "id": "sub23",
      "images": ["img1.jpg", "img2.jpg"],
      "name": "Property Name",
      "category": "Accommodation",
      "location": "City, Region",
      "propertyDetails": {
        "BHK": "2 BHK",
        "Max Guests": "4 People"
      },
      "inclusions": ["Feature 1", "Feature 2"],
      "checkInOut": {
        "Check-in": "2:00 PM",
        "Check-out": "11:00 AM"
      },
      "addOnExperiences": ["Experience 1"],
      "nearbyAttractions": ["Attraction 1"]
    }
  ]
}
```

3. **Add images to `assets/images/`**
4. **Refresh the page** - Changes load automatically!

### Updating Contact Information

Edit `contact` section in `data.json`:
```json
{
  "contact": {
    "phone": ["+91XXXXXXXXXX"],  // First number used for WhatsApp
    "email": "your@email.com"
  }
}
```

### Changing Hero Video

1. Replace `assets/banner/unseenstay.mp4`
2. Or update path in `data.json`:
```json
{
  "header": {
    "backgroundVideo": "assets/banner/your-video.mp4"
  }
}
```

---

## 📱 Mobile Optimizations

### iOS Safari Fixes

**Issue 1: Date Input Placeholder**
- Problem: iOS shows date format instead of placeholder
- Solution: Custom CSS to hide webkit date elements
- File: `style.css` lines 55-102

**Issue 2: Select Dropdown Placeholder**
- Problem: iOS doesn't show placeholder option correctly
- Solution: Custom styling with `-webkit-appearance: none`
- File: `style.css` lines 104-135

**Implementation:**
```css
/* Hide iOS date format */
input[type="date"]::-webkit-datetime-edit-text,
input[type="date"]::-webkit-datetime-edit-month-field,
input[type="date"]::-webkit-datetime-edit-day-field,
input[type="date"]::-webkit-datetime-edit-year-field {
  color: transparent;
}

/* Custom select dropdown */
select.form-control {
  -webkit-appearance: none;
  background-image: url('data:image/svg+xml...');
}
```

### Mobile Form Enhancements

- **Font-size: 16px** - Prevents iOS auto-zoom on focus
- **Min-height: 50px** - Better touch targets
- **Custom placeholders** - Using `data-placeholder` attributes
- **JavaScript state management** - Adds `.has-value` class on selection

---

## 🚀 Getting Started

### Prerequisites
- Web server (local or remote)
- Modern web browser

### Installation

1. **Clone or download the project**
2. **Place files on web server**
3. **Update `assets/core/data.json` with your content**
4. **Add your images to `assets/images/`**
5. **Update logo files in `assets/brand-logo/`**
6. **Open `index.html` in browser**

### Local Development

```bash
# Using Python
python -m http.server 8000

# Using Node.js
npx http-server

# Using PHP
php -S localhost:8000
```

Then visit: `http://localhost:8000`

---

## 🔧 Technical Implementation Details

### JavaScript Features Used

#### ES6+ Features
- ✅ **Arrow Functions**: `() => {}`
- ✅ **Template Literals**: `` `${variable}` ``
- ✅ **Destructuring**: `const { name, category } = card`
- ✅ **Fetch API**: `fetch('data.json').then()`
- ✅ **Array Methods**: `forEach()`, `find()`, `map()`
- ✅ **Const/Let**: Block-scoped variables
- ✅ **Spread Operator**: `...array`

#### DOM Manipulation
```javascript
// Dynamic Element Creation
const div = document.createElement('div');
div.className = 'nk-isotope-item';
div.innerHTML = `<div>...</div>`;
parent.appendChild(div);

// Event Delegation
element.addEventListener('click', function() {
  const id = this.getAttribute('data-card-id');
  // Handle click
});
```

#### Data Processing
```javascript
// Find destination by ID
const mainCard = data.destinations.cards.find(c => c.id === cardId);

// Loop through subcards
mainCard.subCards.forEach(sub => {
  // Render each subcard
});
```

### CSS Advanced Techniques

#### 1. **Custom Properties (CSS Variables)**
```css
:root {
  --primary-color: #333;
  --transition-speed: 0.8s;
}
```

#### 2. **Webkit-Specific Styling**
```css
/* iOS Safari Date Input Fix */
input[type="date"]::-webkit-datetime-edit-text { color: transparent; }
input[type="date"]::-webkit-calendar-picker-indicator { opacity: 1; }
```

#### 3. **Responsive Images**
```css
.bg-image {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
```

#### 4. **Smooth Scrolling**
```css
html { scroll-behavior: smooth; }
```

### Performance Optimizations

1. **Lazy Loading**: Images load on demand
2. **Event Delegation**: Single listener for multiple elements
3. **CSS Transitions**: Hardware-accelerated animations
4. **Minimal Reflows**: Batch DOM updates
5. **Efficient Selectors**: ID and class-based targeting

---

## 📝 Key Files Reference

| File | Purpose |
|------|---------|
| `index.html` | Main HTML structure |
| `assets/core/data.json` | ⭐ Content configuration |
| `assets/core/core.js` | ⭐ Application logic |
| `assets/css/style.css` | Custom styles & mobile fixes |
| `assets/css/combined.css` | Third-party CSS |
| `assets/js/combined.js` | Third-party JavaScript |

---

## 🎯 Best Practices

1. **Always backup `data.json` before major changes**
2. **Use consistent image dimensions** for better layout
3. **Optimize images** before uploading (recommended: 800x600px)
4. **Test on mobile devices** after content updates
5. **Keep phone numbers in international format** (+91XXXXXXXXXX)
6. **Use descriptive IDs** for destinations and sub-cards

---

## 🐛 Troubleshooting

### Images not loading
- Check file paths in `data.json`
- Ensure images exist in `assets/images/`
- Verify file extensions match (case-sensitive)

### WhatsApp link not working
- Verify phone number format: `+91XXXXXXXXXX` (no spaces)
- Check first number in `contact.phone` array
- Test on mobile device

### Modal not opening
- Check console for JavaScript errors
- Verify `sub.id` is unique
- Ensure Swiper.js is loaded

### Mobile form issues
- Clear browser cache
- Test on actual device (not just emulator)
- Check `style.css` mobile media queries

---

## 👨‍💻 Developer Notes

### Code Philosophy - By Hashil Nisam

1. **Simplicity Over Complexity**
   - No unnecessary frameworks or libraries
   - Pure JavaScript for maximum control
   - Readable, self-documenting code

2. **Data-Driven Architecture**
   - Single source of truth (`data.json`)
   - Separation of content and logic
   - Easy content updates without code changes

3. **Mobile-First Approach**
   - iOS Safari as primary test platform
   - Touch-friendly interactions
   - Responsive from 320px to 4K

4. **Performance Mindset**
   - Minimal HTTP requests
   - Efficient DOM manipulation
   - CSS animations over JavaScript

### Key Innovations

#### 1. **Three-Tier Navigation System**
```
Main Cards → Sub Cards → Modal Details
(Destinations) → (Properties) → (Full Info)
```
This hierarchical structure allows unlimited content scaling without UI clutter.

#### 2. **JSON-Driven CMS**
All content in one file enables:
- Non-technical content updates
- Version control friendly
- Easy backup and migration
- API integration ready

#### 3. **iOS Safari Form Fixes**
Custom solutions for:
- Date input placeholders
- Select dropdown styling
- Touch target optimization
- Zoom prevention (16px font-size)

#### 4. **Scroll-Based Reveal Animation**
Mobile-only feature that:
- Reduces initial visual clutter
- Creates engaging scroll experience
- Uses Intersection Observer pattern
- Smooth cubic-bezier easing

### Code Quality Standards

- ✅ **Consistent Naming**: camelCase for JS, kebab-case for CSS
- ✅ **Commented Sections**: Clear section markers in all files
- ✅ **Error Handling**: Fallbacks for missing data
- ✅ **Browser Compatibility**: Tested across major browsers
- ✅ **Accessibility**: Semantic HTML, ARIA labels

### Future Enhancement Ideas

- [ ] Add search/filter functionality
- [ ] Implement booking calendar
- [ ] Multi-language support
- [ ] Admin panel for JSON editing
- [ ] Image optimization pipeline
- [ ] Progressive Web App (PWA) features
- [ ] Analytics integration
- [ ] SEO optimization

---

## 📄 License & Credits

### Project Information
- **Project Name**: Unseenstay
- **Version**: 1.0
- **Created**: 2025
- **Last Updated**: October 2025

### Developer Credits
- **Lead Developer**: [Hashil Nisam](https://github.com/hashilnizam)
- **Architecture Design**: Hashil Nisam
- **Core Logic**: Hashil Nisam
- **UI/UX Implementation**: Hashil Nisam
- **Mobile Optimization**: Hashil Nisam

### Third-Party Credits
- **Swiper.js**: Image slider library
- **Font Awesome**: Icon library
- **Google Fonts**: Playfair Display, Work Sans

---

## 🤝 Support & Contact

For issues or questions:
1. Check this README documentation
2. Review `data.json` structure and syntax
3. Inspect browser console for errors
4. Verify all file paths are correct
5. Test on actual mobile devices

### Contact Developer
- **Developer**: Hashil Nisam
- **GitHub**: [@hashilnizam](https://github.com/hashilnizam)
- **Email**: [Mail](hashilnizam@gmail.com)

---

## 🏆 Project Highlights

### Technical Achievements
- ✨ Zero-dependency vanilla JavaScript architecture
- ✨ Complete JSON-driven content management system
- ✨ Custom iOS Safari form optimization
- ✨ Smooth scroll-based reveal animations
- ✨ Three-tier hierarchical navigation
- ✨ WhatsApp booking integration
- ✨ Fully responsive mobile-first design

### Code Statistics
- **Total Lines of Code**: ~2000+
- **JavaScript**: ~1500 lines (core.js)
- **CSS**: ~200 lines (style.css)
- **HTML**: ~450 lines (index.html)
- **JSON**: ~750 lines (data.json)

---

**Last Updated**: October 2025  
**Version**: 1.0.0  
**Developed by**: [Hashil Nisam](https://github.com/hashilnizam)  
**License**: All Rights Reserved

---

<div align="center">

### 🌟 Built with ❤️ by Hashil Nisam

**Unseenstay** - Where Code Meets Creativity

</div>
