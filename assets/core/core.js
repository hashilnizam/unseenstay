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

// ---------------- HEADER ----------------
function renderHeader(data) {
    if (document.getElementById("header-bg")) {
        document.getElementById("header-bg").style.backgroundImage = `url('${data.header.backgroundImage}')`;
        document.getElementById("header-subtitle").innerText = data.header.subtitle;
        document.getElementById("header-title").innerHTML = data.header.title;
        document.getElementById("header-paragraph").innerText = data.header.paragraph;
    }
}

// ---------------- ABOUT ----------------
function renderAbout(data) {
    if (document.getElementById("about-heading")) {
        document.getElementById("about-heading").innerText = data.about.heading;
        document.getElementById("about-paragraph").innerText = data.about.paragraph;
        document.getElementById("about-image").src = data.about.image;
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

// ---------------- PORTFOLIO PAGE ----------------
function renderPortfolio(data) {
    const portfolioContainer = document.getElementById("portfolio-list");
    const filtersContainer = document.getElementById("portfolio-filters");
    const destHeading = document.getElementById("dest-heading");
    const destParagraph = document.getElementById("dest-paragraph");

    if (portfolioContainer && filtersContainer) {
        // Heading + Paragraph
        if (destHeading) destHeading.innerText = data.destinations.intro.heading;
        if (destParagraph) destParagraph.innerText = data.destinations.intro.paragraph;

        portfolioContainer.innerHTML = "";
        filtersContainer.innerHTML = "";

        // Categories
        const categories = [...new Set(data.destinations.cards.map(card => card.category))];

        const allLi = document.createElement("li");
        allLi.className = "active";
        allLi.setAttribute("data-filter", "*");
        allLi.textContent = "All";
        filtersContainer.appendChild(allLi);

        categories.forEach(cat => {
            const li = document.createElement("li");
            li.setAttribute("data-filter", cat);
            li.textContent = cat;
            filtersContainer.appendChild(li);
        });

        // Cards
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
            portfolioContainer.appendChild(div);
        });
    }
}

// ---------------- CONTACT ----------------
function renderContact(data) {
    if (document.getElementById("contact-heading")) {
        document.getElementById("contact-heading").innerText = data.contact.heading;
        document.getElementById("contact-info").innerText = data.contact.info;
        document.getElementById("contact-address").innerText = data.contact.address;
        document.getElementById("contact-phone").innerText = data.contact.phone;
        document.getElementById("contact-email").innerText = data.contact.email;
        document.getElementById("contact-fax").innerText = data.contact.fax;
    }
}

// ---------------- MAIN LOADER ----------------
async function loadData() {
    try {
        const response = await fetch("assets/core/data.json");
        const data = await response.json();

        console.log("data==============>>>>>", data);

        renderLogo(data);
        renderHeader(data);
        renderAbout(data);
        renderDestinations(data);
        renderPortfolio(data);
        renderContact(data);

        console.log("All data loaded successfully!");
    } catch (error) {
        console.error("Error loading data:", error);
    }
}

// Load data when DOM is ready
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", loadData);
} else {
    loadData();
}
