// ---------------- TITLE ----------------
function renderTitle(data) {
    if (data.site && data.site.title) {
        document.title = data.site.title;
    }
}

// ---------------- LOGO ----------------
function renderLogo(data) {
    if (document.getElementById("logo-light") && document.getElementById("logo-dark")) {
        document.getElementById("logo-light").src = data.logo.light;
        document.getElementById("logo-dark").src = data.logo.dark;
        document.getElementById("logo-light").width = data.logo.width;
        document.getElementById("logo-dark").width = data.logo.width;
        document.getElementById("logo-light").alt = data.logo.alt;
        document.getElementById("logo-dark").alt = data.logo.alt;
    }
}

// ---------------- NAVBAR ----------------
function renderNavbar(data) {
    const desktopNav = document.getElementById("main-nav");
    const mobileNavContainer = document.querySelector("#nk-nav-mobile .nk-nav");

    if (desktopNav) desktopNav.innerHTML = "";
    if (mobileNavContainer) mobileNavContainer.innerHTML = "";

    data.navbar.menu.forEach((item) => {
        // -------- desktop li
        const liDesktop = document.createElement("li");
        const aDesktop = document.createElement("a");
        aDesktop.href = item.link;
        aDesktop.textContent = item.name;

        // active + smooth scroll
        aDesktop.addEventListener("click", (e) => {
            e.preventDefault();
            document.querySelectorAll("#main-nav li").forEach(li => li.classList.remove("active"));
            liDesktop.classList.add("active");

            const id = item.link.includes("#") ? item.link.split("#")[1] : null;
            if (id) {
                const section = document.getElementById(id);
                if (section) {
                    section.scrollIntoView({ behavior: "smooth" });
                }
            }
        });

        liDesktop.appendChild(aDesktop);
        desktopNav?.appendChild(liDesktop);

        // -------- mobile li
        const liMobile = liDesktop.cloneNode(true);
        // for mobile, also close the menu when you click
        liMobile.querySelector("a").addEventListener("click", (e) => {
            e.preventDefault();
            const id = item.link.includes("#") ? item.link.split("#")[1] : null;
            if (id) {
                const section = document.getElementById(id);
                if (section) {
                    section.scrollIntoView({ behavior: "smooth" });
                }
            }
            // close mobile menu (toggle class provided by template)
            document.querySelector(".nk-navbar-full-toggle")?.click();
        });

        mobileNavContainer?.appendChild(liMobile);
    });
}


// ---------------- HEADER ----------------
function renderHeader(data) {
    // Select the video element using its new ID
    const videoElement = document.getElementById("header-bg-video");
    
    // Check if the video element exists before proceeding
    if (videoElement) {
        // Set the 'src' of the video element using the new 'backgroundVideo' key
        videoElement.src = data.header.backgroundVideo; 
        
        // --- APPLY CENTERING AND COVERAGE CSS VIA JAVASCRIPT ---
        // This ensures the video is perfectly centered and scaled to cover the entire area.
        
        // 1. Positioning and Centering
        videoElement.style.position = 'absolute';
        videoElement.style.top = '50%';
        videoElement.style.left = '50%';
        // Shifts the element back by half its own size to achieve true center alignment
        videoElement.style.transform = 'translate(-50%, -50%)'; 
        
        // 2. Sizing and Coverage
        videoElement.style.minWidth = '100%';
        videoElement.style.minHeight = '100%';
        videoElement.style.width = 'auto';
        videoElement.style.height = 'auto';
        // Ensures the video covers the area without distortion or black bars
        videoElement.style.objectFit = 'cover'; 
        
        // FIX: Setting zIndex to -1 ensures the video stays behind the overlay shade.
        videoElement.style.zIndex = '-1'; 

        // Ensure the video is loaded and plays
        videoElement.load();
        videoElement.play().catch(error => {
            // Handle potential autoplay blocking by browsers
            console.warn("Video autoplay failed:", error);
        });

        // Update the text content for the other elements (assuming their IDs remain the same)
        const subtitle = document.getElementById("header-subtitle");
        const title = document.getElementById("header-title");
        const paragraph = document.getElementById("header-paragraph");

        if (subtitle) subtitle.innerText = data.header.subtitle;
        if (title) title.innerHTML = data.header.title;
        if (paragraph) paragraph.innerText = data.header.paragraph;
    }
}

// ---------------- DESTINATIONS (Index Page) ----------------
function renderDestinations(data) {
    const destHeading = document.getElementById("dest-heading");
    const destParagraph = document.getElementById("dest-paragraph");
    const destinationContainer = document.getElementById("destinations-cards");

    if (destHeading && destParagraph && destinationContainer) {
        destHeading.innerText = data.destinations.intro.heading;
        destParagraph.innerText = data.destinations.intro.paragraph;
        destinationContainer.innerHTML = "";

        data.destinations.cards.forEach(card => {
            const div = document.createElement("div");
            div.className = "nk-isotope-item";
            div.setAttribute("data-filter", card.category || "all");

            div.innerHTML = `
                <div class="nk-portfolio-item nk-portfolio-item-square nk-portfolio-item-info-style-1">
                    <a href="${card.url}" class="nk-portfolio-item-link"></a>
                    <div class="nk-portfolio-item-image">
                        <div style="background-image: url('${card.image}');"></div>
                    </div>
                    <div class="nk-portfolio-item-info nk-portfolio-item-info-center text-xs-center">
                        <div>
                            <h2 class="portfolio-item-title h3">${card.name}</h2>
                            <div class="portfolio-item-category">${card.category}</div>
                        </div>
                    </div>
                </div>
            `;
            destinationContainer.appendChild(div);
        });
    }
}

// ---------------- MODAL ----------------
function createModal() {
    if (document.getElementById("sub-card-modal")) return;

    const modal = document.createElement("div");
    modal.id = "sub-card-modal";
    modal.style.cssText = `
        display:none;position:fixed;z-index:9999;left:0;top:0;width:100%;height:100%;
        overflow:auto;background:rgba(0,0,0,0.6);backdrop-filter:blur(2px);
    `;
    modal.innerHTML = `
        <div style="background:#fff;margin:60px auto;padding:20px 30px;border-radius:10px;max-width:700px;box-shadow:0 10px 25px rgba(0,0,0,0.3);position:relative;">
            <span id="modal-close" style="position:absolute;top:15px;right:20px;font-size:25px;cursor:pointer;">&times;</span>
            <div>
                <h2 id="modal-title" style="margin-top:0;"></h2>
                <p id="modal-category" style="font-weight:600;color:#555;"></p>
                <p id="modal-description" style="color:#333;"></p>
                <p id="modal-price" style="font-weight:700;color:#007bff;"></p>
                <div id="modal-images" style="margin-top:10px;display:flex;flex-wrap:wrap;"></div>
                <div style="margin-top:15px;">
                    <button style="padding:10px 20px;margin-right:10px;border:2px solid #333;background:none;color:#333;border-radius:5px;cursor:pointer;">Enquire</button>
                    <button style="padding:10px 20px;background:#007bff;color:#fff;border:none;border-radius:5px;cursor:pointer;">Book Now</button>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    // Close modal events
    modal.querySelector("#modal-close").onclick = () => modal.style.display = "none";
    window.onclick = (event) => {
        if (event.target === modal) modal.style.display = "none";
    };
}

function openModal(sub) {
    createModal();
    const modal = document.getElementById("sub-card-modal");
    document.getElementById("modal-title").innerText = sub.name;
    document.getElementById("modal-category").innerText = sub.category;
    document.getElementById("modal-description").innerText = sub.description || "Lorem ipsum dolor sit amet.";
    document.getElementById("modal-price").innerText = sub.price || "$100";

    const modalImages = document.getElementById("modal-images");
    modalImages.innerHTML = "";
    if (sub.subSubCards) {
        sub.subSubCards.forEach(img => {
            const imgEl = document.createElement("img");
            imgEl.src = img.image;
            imgEl.alt = img.name;
            imgEl.style.cssText = "width:100px;margin:5px;border-radius:5px;";
            modalImages.appendChild(imgEl);
        });
    }
    modal.style.display = "block";
}

// ---------------- PORTFOLIO PAGE ----------------
// ============================================
// iOS 26 INSPIRED MODAL SYSTEM - COMPLETE JS
// With Multiple Images Slider Support
// ============================================

// Inject CSS styles into the document
const modalStyles = `
<style>
/* ============================================
MODAL STRUCTURE & ANIMATIONS (iOS Style)
============================================ 
*/
.ios26-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    z-index: 9998;
    opacity: 0;
    transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
}

.ios26-modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
}

.ios26-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.9);
    width: min(900px, 90vw);
    max-height: 85vh; /* Limits the modal height to 85% of viewport */
    background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 32px;
    box-shadow: 
        0 40px 100px rgba(0, 0, 0, 0.3),
        0 20px 60px rgba(0, 0, 0, 0.2),
        0 0 0 1px rgba(255, 255, 255, 0.5) inset;
    z-index: 9999;
    overflow-y: auto; 
    overflow-x: hidden;
    opacity: 0;
    transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    pointer-events: none;
    display: flex; 
    flex-direction: column;
    
    /* --- KEY SCROLLBAR HIDING: Firefox --- */
    scrollbar-width: none;
}

/* --- KEY SCROLLBAR HIDING: Webkit (Chrome, Safari) --- */
.ios26-modal::-webkit-scrollbar {
    display: none;
    width: 0;
    height: 0;
}


.ios26-modal.active {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
    pointer-events: auto;
}

.ios26-modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: none;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.ios26-modal-close:hover {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.ios26-modal-close::before,
.ios26-modal-close::after {
    content: '';
    position: absolute;
    width: 18px;
    height: 2px;
    background: #333;
    border-radius: 1px;
}

.ios26-modal-close::before {
    transform: rotate(45deg);
}

.ios26-modal-close::after {
    transform: rotate(-45deg);
}

/* ============================================
ENQUIRY BUTTON STYLE 
============================================ 
*/
.ios26-enquiry-button {
    /* Base styles */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    margin-left: auto; /* Pushes the button to the right */
    border: none;
    cursor: pointer;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    border-radius: 24px;
    
    /* iOS 26 Gradient Style */
    color: white;
    background: linear-gradient(135deg, #128C7E 0%, #25D366 100%); /* WhatsApp colors */
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.ios26-enquiry-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
}

.ios26-enquiry-button svg {
    margin-right: 8px;
    fill: white;
    width: 18px;
    height: 18px;
}

/* ============================================
SLIDER STYLES
============================================ 
*/
.ios26-modal-slider {
    position: relative;
    width: 100%;
    /* 16:9 aspect ratio */
    padding-bottom: 56.25%; 
    height: 0; 
    flex-shrink: 0; 
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.ios26-modal-slides {
    position: absolute; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    transition: transform 0.6s cubic-bezier(0.65, 0, 0.35, 1);
}

.ios26-modal-slide {
    min-width: 100%;
    height: 100%;
    position: relative;
    background-size: cover;
    background-position: center;
    animation: slideZoom 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

@keyframes slideZoom {
    from {
        transform: scale(1.1);
        opacity: 0.7;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.ios26-modal-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    z-index: 5;
}

.ios26-modal-nav:hover {
    transform: translateY(-50%) scale(1.1);
    background: rgba(255, 255, 255, 1);
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.25);
}

.ios26-modal-nav.prev {
    left: 20px;
}

.ios26-modal-nav.next {
    right: 20px;
}

.ios26-modal-nav::after {
    content: '';
    width: 10px;
    height: 10px;
    border-top: 2px solid #333;
    border-right: 2px solid #333;
}

.ios26-modal-nav.prev::after {
    transform: rotate(-135deg);
    margin-left: 3px;
}

.ios26-modal-nav.next::after {
    transform: rotate(45deg);
    margin-right: 3px;
}

.ios26-modal-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 5;
}

.ios26-modal-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.ios26-modal-indicator.active {
    background: rgba(255, 255, 255, 1);
    width: 24px;
    border-radius: 4px;
}

.ios26-modal-slide-counter {
    position: absolute;
    top: 20px;
    left: 20px;
    padding: 8px 16px;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(10px);
    color: white;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    z-index: 5;
}

/* ============================================
CONTENT AREA & TYPOGRAPHY
============================================ 
*/
.ios26-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.ios26-modal-content {
    padding: 40px;
    overflow-y: visible; 
    flex-grow: 1; 
    scroll-behavior: smooth;
}

.ios26-modal-title {
    font-size: 32px;
    font-weight: 700;
    margin: 0; /* Important: Remove default margin */
    color: #1a1a1a;
    letter-spacing: -0.5px;
    line-height: 1.2;
}

.ios26-modal-category {
    display: inline-block;
    padding: 8px 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 24px;
    letter-spacing: 0.3px;
}

.ios26-modal-description {
    font-size: 16px;
    line-height: 1.7;
    color: #4a4a4a;
    margin: 0 0 24px 0;
}

/* ============================================
MODERN DETAILS STYLES (iOS 26 Look)
============================================ 
*/
.ios26-modal-section-title {
    font-size: 20px;
    font-weight: 700; 
    color: #1a1a1a; 
    margin: 30px 0 20px 0; 
    border-bottom: none; 
    display: block; 
    padding-bottom: 0;
    position: relative;
}

.ios26-modal-section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 50px;
    height: 3px;
    background: rgba(102, 126, 234, 0.2);
    border-radius: 1.5px;
}

.ios26-modal-room-details {
    margin-bottom: 30px;
    display: flex; 
    flex-wrap: wrap;
    gap: 10px;
}

.ios26-detail-item {
    padding: 8px 15px;
    background: rgba(102, 126, 234, 0.1); 
    border-radius: 20px; 
    font-size: 15px;
    line-height: 1;
    display: flex;
    align-items: center;
    transition: background 0.2s;
}

.ios26-detail-item:hover {
    background: rgba(102, 126, 234, 0.2);
}

.ios26-detail-label {
    font-weight: 500;
    color: #667eea;
    margin-right: 6px;
}

.ios26-detail-value {
    font-weight: 700;
    color: #333;
}

.ios26-modal-features-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px 25px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.ios26-modal-features-list li {
    font-size: 16px;
    color: #4a4a4a;
    position: relative;
    padding-left: 28px;
    font-weight: 500;
}

.ios26-modal-features-list li::before {
    content: '✓'; 
    color: #667eea; 
    font-weight: 900; 
    font-size: 18px;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
    position: absolute;
    left: 0;
    top: -1px; 
}


/* ============================================
FALLBACK/META & RESPONSIVENESS
============================================ 
*/
.ios26-modal-meta { 
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-top: 32px;
    padding-top: 32px;
    border-top: 1px solid rgba(0, 0, 0, 0.08);
}

.ios26-modal-meta-item {
    padding: 16px;
    background: rgba(102, 126, 234, 0.05);
    border-radius: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.ios26-modal-meta-item:hover {
    background: rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.ios26-modal-meta-label {
    font-size: 12px;
    font-weight: 600;
    color: #667eea;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 6px;
}

.ios26-modal-meta-value {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
}

@media (max-width: 768px) {
    .ios26-modal {
        width: 95vw;
        max-height: 90vh;
        border-radius: 24px;
        overflow-y: auto; 
    }
    
    .ios26-modal-slider {
        padding-bottom: 66.66%; 
    }
    
    .ios26-modal-content {
        padding: 24px;
    }
    
    .ios26-modal-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .ios26-modal-title {
        font-size: 24px;
    }

    .ios26-enquiry-button {
        width: 100%;
        margin-left: 0;
    }
    
    .ios26-modal-nav {
        width: 36px;
        height: 36px;
    }
    
    .ios26-modal-room-details {
        grid-template-columns: none; 
        gap: 8px;
    }
    
    .ios26-detail-item {
        font-size: 14px;
        padding: 6px 12px;
    }

    .ios26-modal-features-list {
        grid-template-columns: 1fr;
    }
}
</style>
`;

// Insert CSS styles into the document
function injectStyles() {
    if (!document.getElementById('ios26-modal-styles')) {
        const styleContainer = document.createElement('div');
        styleContainer.id = 'ios26-modal-styles';
        styleContainer.innerHTML = modalStyles;
        document.head.appendChild(styleContainer);
    }
}

// Create modal HTML structure
function createModalHTML() {
    // Check if the container already exists to prevent duplication
    if (document.getElementById('ios26-modal-container')) {
        // Clear existing modal content for reuse
        const modal = document.getElementById('ios26-modal');
        if (modal) {
            document.getElementById('ios26-modal-slides').innerHTML = '';
            document.getElementById('ios26-modal-content').innerHTML = '';
            document.getElementById('ios26-modal-indicators').innerHTML = '';
        }
        return;
    }

    const modalHTML = `
        <div id="ios26-modal-overlay" class="ios26-modal-overlay"></div>
        <div id="ios26-modal" class="ios26-modal">
            <button class="ios26-modal-close" id="ios26-modal-close"></button>
            <div class="ios26-modal-slider">
                <div class="ios26-modal-slide-counter" id="ios26-modal-counter">1 / 1</div>
                <div class="ios26-modal-slides" id="ios26-modal-slides"></div>
                <button class="ios26-modal-nav prev" id="ios26-modal-prev"></button>
                <button class="ios26-modal-nav next" id="ios26-modal-next"></button>
                <div class="ios26-modal-indicators" id="ios26-modal-indicators"></div>
            </div>
            <div class="ios26-modal-content" id="ios26-modal-content"></div>
        </div>
    `;

    const container = document.createElement('div');
    container.id = 'ios26-modal-container';
    container.innerHTML = modalHTML;
    document.body.appendChild(container);
}

// Global keyboard handler reference
let modalKeyboardHandler = null;

/**
 * Opens the iOS-style modal with the provided property data.
 * @param {object} data - The property data, including images, content, and contact info.
 */
function openModal(data) {
    injectStyles();
    createModalHTML();

    const overlay = document.getElementById('ios26-modal-overlay');
    const modal = document.getElementById('ios26-modal');
    const slidesContainer = document.getElementById('ios26-modal-slides');
    const content = document.getElementById('ios26-modal-content');
    const indicators = document.getElementById('ios26-modal-indicators');
    const counter = document.getElementById('ios26-modal-counter');

    let currentSlide = 0;

    // --- CRITICAL NEW LOGIC: Extract phone number and construct WhatsApp link ---
    const rawPhoneNumber = (data.contact && data.contact.phone) ?
        data.contact.phone.replace(/[\s-()]/g, '') :
        ''; // Cleans number for wa.me

    // Construct the detailed message using data.fullPathName for maximum detail
    const propertyName = data.fullPathName || data.name || 'a property';
    const messageText = encodeURIComponent(`Hello, I'm interested in the property: ${propertyName}. Could you provide more details?`);
    const whatsappLink = rawPhoneNumber ?
        `https://wa.me/${rawPhoneNumber}?text=${messageText}` :
        '#'; // Fallback if no number is found

    // Get images array - support both 'images' and 'image' property
    let images = [];
    if (data.images && Array.isArray(data.images)) {
        images = data.images;
    } else if (data.image) {
        images = [data.image];
    } else {
        images = ['https://via.placeholder.com/900x450?text=No+Image'];
    }

    // Create slides
    slidesContainer.innerHTML = images.map(img =>
        `<div class="ios26-modal-slide" style="background-image: url('${img}');"></div>`
    ).join('');

    // Update counter
    function updateCounter() {
        counter.textContent = `${currentSlide + 1} / ${images.length}`;
    }
    updateCounter();

    // Create indicators
    if (images.length > 1) {
        indicators.innerHTML = images.map((_, i) =>
            `<div class="ios26-modal-indicator ${i === 0 ? 'active' : ''}" data-index="${i}"></div>`
        ).join('');

        indicators.querySelectorAll('.ios26-modal-indicator').forEach(ind => {
            ind.addEventListener('click', () => {
                currentSlide = parseInt(ind.dataset.index);
                updateSlider();
            });
        });
    } else {
        indicators.innerHTML = '';
    }

    // --- START: MODAL CONTENT GENERATION ---

    // 1. Header with Title and Enquiry Button
    let contentHTML = `
        <div class="ios26-modal-header">
            <h2 class="ios26-modal-title">${data.name || 'Untitled'}</h2>
            ${rawPhoneNumber ? `
                <a href="${whatsappLink}" target="_blank" class="ios26-enquiry-button">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2C6.477 2 2 6.477 2 12c0 3.313 1.258 6.313 3.308 8.44l-1.025 3.321 3.55-1.16c1.94 1.056 4.156 1.699 6.167 1.699 5.523 0 10-4.477 10-10S17.523 2 12 2zm4.493 11.233c-.156-.078-.967-.477-1.115-.53s-.254-.078-.36.078c-.105.156-.408.53-.5.636s-.194.116-.36.038c-.166-.078-.727-.267-1.382-.852-.51-.453-.855-1.015-.959-1.18-.103-.165-.01-.153.07-.232s.193-.203.284-.303c.09-.099.12-.169.18-.284.06-.115.03-.165-.015-.232s-.36-.855-.494-1.16c-.134-.305-.27-.26-.36-.264s-.186-.005-.285-.005c-.105 0-.256.038-.393.194-.136.156-.519.507-.519 1.235 0 .728.532 1.433.608 1.539.076.105 1.045 1.61 2.534 2.215 1.264.493 1.583.473 1.956.447.373-.027.967-.393 1.1-.767s.136-.714.097-.79z"/>
                    </svg>
                    Enquire Now
                </a>
            ` : ''}
        </div>
        ${data.category ? `<span class="ios26-modal-category">${data.category}</span>` : ''}
    `;

    // 2. Room Details Section 
    if (data.roomDetails && Object.keys(data.roomDetails).length > 0) {
        contentHTML += `
            <h3 class="ios26-modal-section-title">ROOM DETAILS</h3>
            <div class="ios26-modal-room-details">
                ${Object.entries(data.roomDetails).map(([key, value]) => `
                    <div class="ios26-detail-item">
                        <span class="ios26-detail-label">${key} :</span>
                        <span class="ios26-detail-value">${value}</span>
                    </div>
                `).join('')}
            </div>
        `;
    }

    // 3. Description (If present)
    if (data.description) {
        contentHTML += `<p class="ios26-modal-description">${data.description}</p>`;
    }

    // 4. Room Features Section
    if (data.roomFeatures && Array.isArray(data.roomFeatures) && data.roomFeatures.length > 0) {
        contentHTML += `
            <h3 class="ios26-modal-section-title">Room Features</h3>
            <ul class="ios26-modal-features-list">
                ${data.roomFeatures.map(feature => `<li>${feature}</li>`).join('')}
            </ul>
        `;
    }

    // 5. Fallback/Original Meta (Optional, kept for flexibility)
    if (data.meta) {
        contentHTML += `
             <div class="ios26-modal-meta">
                 ${Object.entries(data.meta).map(([key, value]) => `
                     <div class="ios26-modal-meta-item">
                         <div class="ios26-modal-meta-label">${key}</div>
                         <div class="ios26-modal-meta-value">${value}</div>
                     </div>
                 `).join('')}
             </div>
           `;
    }

    content.innerHTML = contentHTML;
    // --- END: MODAL CONTENT GENERATION ---

    // Update slider function
    function updateSlider() {
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        indicators.querySelectorAll('.ios26-modal-indicator').forEach((ind, i) => {
            ind.classList.toggle('active', i === currentSlide);
        });
        updateCounter();
    }

    // Navigation
    const prevBtn = document.getElementById('ios26-modal-prev');
    const nextBtn = document.getElementById('ios26-modal-next');

    prevBtn.onclick = () => {
        currentSlide = (currentSlide - 1 + images.length) % images.length;
        updateSlider();
    };

    nextBtn.onclick = () => {
        currentSlide = (currentSlide + 1) % images.length;
        updateSlider();
    };

    // Hide nav buttons and counter if only one image
    if (images.length <= 1) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        counter.style.display = 'none';
    } else {
        prevBtn.style.display = 'flex';
        nextBtn.style.display = 'flex';
        counter.style.display = 'block';
    }

    // Close modal function
    function closeModal() {
        modal.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';

        // Remove keyboard listener
        if (modalKeyboardHandler) {
            document.removeEventListener('keydown', modalKeyboardHandler);
            modalKeyboardHandler = null;
        }
    }

    // Close button
    document.getElementById('ios26-modal-close').onclick = closeModal;

    // Click overlay to close
    overlay.onclick = closeModal;

    // Prevent modal content click from closing
    modal.onclick = (e) => {
        e.stopPropagation();
    };

    // Open modal with animation
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
        overlay.classList.add('active');
        modal.classList.add('active');
    }, 10);

    // Keyboard navigation
    modalKeyboardHandler = (e) => {
        if (e.key === 'Escape') {
            closeModal();
        }
        if (e.key === 'ArrowLeft' && images.length > 1) {
            currentSlide = (currentSlide - 1 + images.length) % images.length;
            updateSlider();
        }
        if (e.key === 'ArrowRight' && images.length > 1) {
            currentSlide = (currentSlide + 1) % images.length;
            updateSlider();
        }
    };

    document.addEventListener('keydown', modalKeyboardHandler);
}

/**
 * Renders the portfolio structure and attaches click handlers for modal and drill-down.
 * @param {object} data - The main JSON data structure containing destinations and contact info.
 */
function renderPortfolio(data) {
    const portfolioContainer = document.getElementById("destinations-cards");
    const destHeading = document.getElementById("dest-heading");
    const destParagraph = document.getElementById("dest-paragraph");

    if (!portfolioContainer) return;

    // --- CRITICAL: Get top-level contact info ---
    const contactInfo = data.contact || {};

    // Sub-Section References
    const subSection = document.getElementById("sub-destinations-section");
    const subHeading = document.getElementById("sub-dest-heading");
    const subParagraph = document.getElementById("sub-dest-paragraph");
    const subContainer = document.getElementById("sub-destinations-cards");

    // Sub-Sub-Section References
    const subSubSection = document.getElementById("subsub-destinations-section");
    const subSubHeading = document.getElementById("subsub-dest-heading");
    const subSubParagraph = document.getElementById("subsub-dest-paragraph");
    const subSubContainer = document.getElementById("subsub-destinations-cards");

    // --- Main Section Content ---
    if (destHeading) destHeading.innerText = data.destinations.intro.heading;
    if (destParagraph) destParagraph.innerText = data.destinations.intro.paragraph;

    portfolioContainer.innerHTML = "";

    data.destinations.cards.forEach(card => {
        const div = document.createElement("div");
        div.className = "nk-isotope-item";
        div.setAttribute("data-filter", card.category || "all");

        div.innerHTML = `
            <div class="nk-portfolio-item nk-portfolio-item-square nk-portfolio-item-info-style-1" data-card-id="${card.id}">
                <div class="nk-portfolio-item-image">
                    <div style="background-image: url('${card.image}');"></div>
                </div>
                <div class="nk-portfolio-item-info nk-portfolio-item-info-center text-xs-center">
                    <div>
                        <h2 class="portfolio-item-title h3">${card.name}</h2>
                        <div class="portfolio-item-category">${card.category}</div>
                    </div>
                </div>
            </div>
        `;
        portfolioContainer.appendChild(div);
    });


    // Attach click listeners to all main cards
    document.querySelectorAll(".nk-portfolio-item[data-card-id]").forEach(cardElem => {
        cardElem.addEventListener("click", function () {
            const cardId = this.getAttribute("data-card-id");
            const mainCard = data.destinations.cards.find(c => c.id === cardId);

            // Hide/clear subsub section when main card is clicked
            if (subSubSection) subSubSection.style.display = "none";
            if (subSubParagraph) subSubParagraph.innerHTML = '';

            if (!mainCard || !mainCard.subCards) {
                if (subSection) subSection.style.display = "none";
                if (subParagraph) subParagraph.innerHTML = '';
                return;
            }

            // --- Sub Section Content Update (Heading and Paragraph) ---
            if (subHeading) subHeading.innerText = mainCard.name;
            const subSectionText = mainCard.paragraph || mainCard.description || '';
            if (subParagraph) subParagraph.innerHTML = subSectionText;

            if (subSection) subSection.style.display = "block";
            if (subContainer) subContainer.innerHTML = "";

            mainCard.subCards.forEach(sub => {
                const subDiv = document.createElement("div");
                subDiv.className = "nk-isotope-item";
                subDiv.innerHTML = `
                    <div class="nk-portfolio-item nk-portfolio-item-square nk-portfolio-item-info-style-1" data-sub-id="${sub.id}">
                        <div class="nk-portfolio-item-image">
                            <div style="background-image: url('${sub.image}');"></div>
                        </div>
                        <div class="nk-portfolio-item-info nk-portfolio-item-info-center text-xs-center">
                            <div>
                                <h3 class="portfolio-item-title">${sub.name}</h3>
                                <div class="portfolio-item-category">${sub.category}</div>
                            </div>
                        </div>
                    </div>
                `;
                subContainer.appendChild(subDiv);

                // Sub-card click handler
                subDiv.querySelector(".nk-portfolio-item").addEventListener("click", function (e) {
                    e.stopPropagation();

                    // Path 1 name (e.g., "Maldives Atoll Retreat")
                    const path1 = mainCard.name;

                    // Check if this sub card has subSubCards
                    if (sub.subSubCards && sub.subSubCards.length > 0) {
                        // --- Sub-Sub Section Content Update (Heading and Paragraph) ---
                        if (subSubHeading) subSubHeading.innerText = sub.name;
                        const subSubSectionText = sub.paragraph || sub.description || '';
                        if (subSubParagraph) subSubParagraph.innerHTML = subSubSectionText;

                        if (subSubSection) subSubSection.style.display = "block";
                        if (subSubContainer) subSubContainer.innerHTML = "";

                        sub.subSubCards.forEach(subSub => {

                            const subSubDiv = document.createElement("div");
                            subSubDiv.className = "nk-isotope-item";
                            subSubDiv.innerHTML = `
                                <div class="nk-portfolio-item nk-portfolio-item-square nk-portfolio-item-info-style-1">
                                    <div class="nk-portfolio-item-image">
                                        <div style="background-image: url('${subSub.images ? subSub.images[0] : subSub.image}');"></div>
                                    </div>
                                    <div class="nk-portfolio-item-info nk-portfolio-item-info-center text-xs-center">
                                        <div>
                                            <h4 class="portfolio-item-title">${subSub.name}</h4>
                                            ${subSub.category ? `<div class="portfolio-item-category">${subSub.category}</div>` : ''}
                                        </div>
                                    </div>
                                </div>
                            `;
                            subSubContainer.appendChild(subSubDiv);

                            // SubSub-card click -> open modal with multiple images
                            subSubDiv.querySelector(".nk-portfolio-item").addEventListener("click", function (e) {
                                e.stopPropagation();

                                // Path 2 name (e.g., "Overwater Bungalows")
                                const path2 = sub.name;

                                // Path 3 name (e.g., "Sunset View Suite")
                                const path3 = subSub.name;

                                // Construct the data payload for the modal
                                const modalData = {
                                    ...subSub,
                                    contact: contactInfo, // Pass the top-level contact info
                                    // *** UPDATED LOGIC HERE: Use 'in' instead of ' > ' ***
                                    fullPathName: `${path3} in ${path2} in ${path1}`
                                };
                                openModal(modalData);
                            });
                        });

                        subSubSection.scrollIntoView({ behavior: "smooth" });
                    } else {
                        // Hide subsub section and clear text
                        if (subSubSection) subSubSection.style.display = "none";
                        if (subSubParagraph) subSubParagraph.innerHTML = '';

                        // Path 2 name (final name)
                        const path2 = sub.name;

                        // No subSubCards, open modal directly
                        const modalData = {
                            ...sub,
                            contact: contactInfo, // Pass the top-level contact info
                            // *** UPDATED LOGIC HERE: Use 'in' instead of ' > ' ***
                            fullPathName: `${path2} in ${path1}`
                        };
                        openModal(modalData);
                    }
                });
            });

            subSection.scrollIntoView({ behavior: "smooth" });
        });
    });
}

// Export functions for use (assuming this is part of a larger system/file)
window.openModal = openModal;
window.renderPortfolio = renderPortfolio;
// ---------------- CONTACT ----------------
function renderContact(data) {
    if (!data.contact) return;

    if (document.getElementById("contact-heading")) {
        document.getElementById("contact-heading").innerText = data.contact.heading;
        document.getElementById("contact-info").innerText = data.contact.info;
        document.getElementById("contact-address").innerText = data.contact.address;
        document.getElementById("contact-phone").innerText = data.contact.phone;
        document.getElementById("contact-email").innerText = data.contact.email;
        document.getElementById("contact-fax").innerText = data.contact.fax;
    }

    const contactForm = document.querySelector("#contact form");
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const name = contactForm.querySelector("input[name='name']").value.trim();
            const email = contactForm.querySelector("input[name='email']").value.trim();
            const title = contactForm.querySelector("input[name='title']").value.trim();
            const message = contactForm.querySelector("textarea[name='message']").value.trim();

            let whatsappMessage = `Hello, my name is ${name}.\n\nEmail: ${email}\nSubject: ${title}\n\n${message}`;
            const phoneNumber = data.contact.phone.replace(/\D/g, "");
            const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(whatsappMessage)}`;

            window.open(whatsappURL, "_blank");
        });
    }
}

// ---------------- FOOTER ----------------
function renderFooter(data) {
    if (!data.footer) return;

    if (document.getElementById("footer-text")) {
        document.getElementById("footer-text").innerHTML = data.footer.text;
    }

    const socialList = document.getElementById("footer-social-list");
    if (socialList && data.footer.social && data.footer.social.length) {
        socialList.innerHTML = "";
        data.footer.social.forEach(item => {
            const li = document.createElement("li");
            li.innerHTML = `<a href="${item.url}" target="_blank"><i class="fa fa-${item.platform}"></i></a>`;
            socialList.appendChild(li);
        });
    }
}

// ---------------- MAIN LOADER ----------------
async function loadData() {
    try {
        const response = await fetch("assets/core/data.json");
        const data = await response.json();

        renderTitle(data);
        renderLogo(data);
        renderNavbar(data);
        renderHeader(data);
        renderDestinations(data);
        renderPortfolio(data);
        renderContact(data);
        renderFooter(data);
    } catch (error) {
        console.error("Error loading data:", error);
    }
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", loadData);
} else {
    loadData();
}
