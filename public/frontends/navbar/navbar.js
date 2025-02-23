function scrollToNewArrivals() {
    const element = document.getElementById("new-arrival");
    if (element) {
        setTimeout(() => {
            element.scrollIntoView({ behavior: "smooth", block: "start" });
        }, 100);  // Trì hoãn một chút nếu có vấn đề về thời gian render
    }
}

function scrollToBestSellers() {
    const element = document.getElementById("best-sellers");
    if (element) {
        setTimeout(() => {
            element.scrollIntoView({ behavior: "smooth", block: "start" });
        }, 100);  // Trì hoãn một chút nếu có vấn đề về thời gian render
    }
}

function scrollToRelatedProducts() {
    const element = document.getElementById("related-products");
    if (element) {
        setTimeout(() => {
            element.scrollIntoView({ behavior: "smooth", block: "start" });
        }, 100);  // Trì hoãn một chút nếu có vấn đề về thời gian render
    }
}

