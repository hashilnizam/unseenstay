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
function renderPortfolio(data) {
    const portfolioContainer = document.getElementById("destinations-cards");
    const destHeading = document.getElementById("dest-heading");
    const destParagraph = document.getElementById("dest-paragraph");

    if (!portfolioContainer) return;

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

    const subSection = document.getElementById("sub-destinations-section");
    const subHeading = document.getElementById("sub-dest-heading");
    const subContainer = document.getElementById("sub-destinations-cards");

    document.querySelectorAll(".nk-portfolio-item[data-card-id]").forEach(cardElem => {
        cardElem.addEventListener("click", function () {
            const cardId = this.getAttribute("data-card-id");
            const mainCard = data.destinations.cards.find(c => c.id === cardId);

            if (!mainCard || !mainCard.subCards) {
                if(subSection) subSection.style.display = "none";
                return;
            }

            if (subHeading) subHeading.innerText = mainCard.name;
            if(subSection) subSection.style.display = "block";
            if(subContainer) subContainer.innerHTML = "";

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

                // Sub-card click -> open modal
                subDiv.querySelector(".nk-portfolio-item").addEventListener("click", function(e){
                    e.stopPropagation();
                    openModal(sub);
                });
            });

            subSection.scrollIntoView({ behavior: "smooth" });
        });
    });
}

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
        renderHeader(data);
        renderAbout(data);
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
