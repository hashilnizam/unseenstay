// ============================================
// OPTIMIZED HEADER RENDERING MODULE
// Separated for faster page load on iOS devices
// ============================================

/**
 * Optimized header renderer with iOS-specific fixes
 * - Lazy video loading to prevent blocking
 * - iOS autoplay restrictions handled
 * - Progressive enhancement approach
 */

// State management
let headerData = null;
let videoLoaded = false;

/**
 * Initialize header with data
 * @param {Object} data - The header configuration data
 */
function initHeader(data) {
    headerData = data;
    
    // Render text content immediately (non-blocking)
    renderHeaderText();
    
    // Defer video loading to prevent blocking
    if ('requestIdleCallback' in window) {
        // Use idle callback for better performance
        requestIdleCallback(() => initHeaderVideo(), { timeout: 2000 });
    } else {
        // Fallback for browsers without requestIdleCallback
        setTimeout(() => initHeaderVideo(), 100);
    }
}

/**
 * Render header text content immediately (non-blocking)
 */
function renderHeaderText() {
    if (!headerData || !headerData.header) return;
    
    const subtitle = document.getElementById("header-subtitle");
    const title = document.getElementById("header-title");
    const paragraph = document.getElementById("header-paragraph");
    
    if (subtitle) subtitle.innerText = headerData.header.subtitle || '';
    if (title) title.innerHTML = headerData.header.title || '';
    if (paragraph) paragraph.innerText = headerData.header.paragraph || '';
}

/**
 * Initialize video background (deferred for performance)
 */
function initHeaderVideo() {
    if (!headerData || !headerData.header || videoLoaded) return;
    
    const videoElement = document.getElementById("header-bg-video");
    if (!videoElement) return;
    
    // Apply CSS styles for proper video positioning
    applyVideoStyles(videoElement);
    
    // Set video source
    const videoSrc = headerData.header.backgroundVideo;
    if (videoSrc) {
        // For iOS: Set up video attributes before setting source
        videoElement.setAttribute('playsinline', 'true');
        videoElement.setAttribute('muted', 'true');
        videoElement.setAttribute('autoplay', 'true');
        videoElement.setAttribute('loop', 'true');
        videoElement.setAttribute('preload', 'metadata'); // Changed from 'auto' for faster initial load
        
        // Load video progressively
        loadVideoSource(videoElement, videoSrc);
    }
    
    videoLoaded = true;
}

/**
 * Apply video styling via JavaScript
 * @param {HTMLVideoElement} videoElement 
 */
function applyVideoStyles(videoElement) {
    // Positioning and Centering
    videoElement.style.position = 'absolute';
    videoElement.style.top = '50%';
    videoElement.style.left = '50%';
    videoElement.style.transform = 'translate(-50%, -50%)';
    
    // Sizing and Coverage
    videoElement.style.minWidth = '100%';
    videoElement.style.minHeight = '100%';
    videoElement.style.width = 'auto';
    videoElement.style.height = 'auto';
    videoElement.style.objectFit = 'cover';
    
    // Ensure video stays behind overlay
    videoElement.style.zIndex = '-1';
}

/**
 * Load video source with iOS-friendly approach
 * @param {HTMLVideoElement} videoElement 
 * @param {string} videoSrc 
 */
function loadVideoSource(videoElement, videoSrc) {
    // Create source element for better compatibility
    const sourceElement = document.createElement('source');
    sourceElement.src = videoSrc;
    sourceElement.type = 'video/mp4'; // Explicitly set type for iOS
    
    videoElement.appendChild(sourceElement);
    
    // Load the video
    videoElement.load();
    
    // iOS-specific: Handle different video events
    setupVideoEventHandlers(videoElement);
}

/**
 * Setup video event handlers for iOS compatibility
 * @param {HTMLVideoElement} videoElement 
 */
function setupVideoEventHandlers(videoElement) {
    // When video can play through without stopping
    videoElement.addEventListener('canplaythrough', handleVideoReady, { once: true });
    
    // Fallback: When enough data is loaded to start
    videoElement.addEventListener('loadeddata', handleVideoDataLoaded, { once: true });
    
    // Error handling
    videoElement.addEventListener('error', handleVideoError, { once: true });
    
    // iOS-specific: Try to play on user interaction if autoplay fails
    if (isIOS()) {
        setupIOSPlaybackFallback(videoElement);
    }
}

/**
 * Handle video ready state
 * @param {Event} event 
 */
function handleVideoReady(event) {
    const videoElement = event.target;
    
    // Try to play the video
    const playPromise = videoElement.play();
    
    if (playPromise !== undefined) {
        playPromise
            .then(() => {
                // Video started playing successfully
                videoElement.style.opacity = '1';
            })
            .catch(error => {
                console.warn('Video autoplay prevented:', error.message);
                // Show fallback background
                showFallbackBackground(videoElement);
            });
    }
}

/**
 * Handle video data loaded (fallback for slower connections)
 * @param {Event} event 
 */
function handleVideoDataLoaded(event) {
    const videoElement = event.target;
    
    // On iOS, sometimes loadeddata fires before canplaythrough
    // Try playing anyway
    if (videoElement.readyState >= 2) {
        videoElement.play().catch(error => {
            console.warn('Video playback failed:', error.message);
        });
    }
}

/**
 * Handle video loading errors
 * @param {Event} event 
 */
function handleVideoError(event) {
    const videoElement = event.target;
    console.error('Video loading failed:', videoElement.error);
    showFallbackBackground(videoElement);
}

/**
 * Show fallback background if video fails
 * @param {HTMLVideoElement} videoElement 
 */
function showFallbackBackground(videoElement) {
    const parentContainer = videoElement.closest('.bg-image');
    if (parentContainer) {
        // Set fallback background image
        parentContainer.style.backgroundImage = 'url(assets/images/bg-header.jpg)';
        parentContainer.style.backgroundSize = 'cover';
        parentContainer.style.backgroundPosition = 'center';
    }
    // Hide the video element
    videoElement.style.display = 'none';
}

/**
 * Detect iOS devices
 * @returns {boolean}
 */
function isIOS() {
    return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
}

/**
 * Setup iOS playback fallback
 * iOS requires user interaction for video playback in some cases
 * @param {HTMLVideoElement} videoElement 
 */
function setupIOSPlaybackFallback(videoElement) {
    // Try to play on first user interaction
    const playOnInteraction = () => {
        if (videoElement.paused) {
            videoElement.play().catch(() => {
                // Silent fail - video just won't play
            });
        }
        // Remove listeners after first attempt
        document.removeEventListener('touchstart', playOnInteraction);
        document.removeEventListener('click', playOnInteraction);
    };
    
    document.addEventListener('touchstart', playOnInteraction, { once: true, passive: true });
    document.addEventListener('click', playOnInteraction, { once: true });
}

/**
 * Public API - expose only the init function
 */
window.HeaderModule = {
    init: initHeader
};

// Auto-initialize if data is already available
if (window.headerDataReady) {
    initHeader(window.headerDataReady);
}
