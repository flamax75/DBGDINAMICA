const CACHE_NAME = "dreambouw-cache-v4";
const CORE_ASSETS = [
    "/",
    "/index.html",
    "/style.css",
    "/script.js",
    "/manifest.json",
    "/robots.txt",
    "/sitemap.xml",
    "/images/fondo.jpg",
    "/images/icon-192.png",
    "/images/icon-512.png"
];

self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.addAll(CORE_ASSETS))
            .then(() => self.skipWaiting())
    );
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys()
            .then((keys) => Promise.all(
                keys
                    .filter((key) => key !== CACHE_NAME)
                    .map((key) => caches.delete(key))
            ))
            .then(() => self.clients.claim())
    );
});

self.addEventListener("fetch", (event) => {
    if (event.request.method !== "GET") return;

    if (event.request.mode === "navigate") {
        event.respondWith(
            fetch(event.request)
                .then((response) => {
                    const copy = response.clone();
                    caches.open(CACHE_NAME).then((cache) => cache.put("/index.html", copy));
                    return response;
                })
                .catch(() => caches.match("/index.html"))
        );
        return;
    }

    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            const networkResponse = fetch(event.request)
                .then((response) => {
                    if (response.ok) {
                        const copy = response.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(event.request, copy));
                    }

                    return response;
                })
                .catch((error) => {
                    if (cachedResponse) return cachedResponse;
                    throw error;
                });

            return cachedResponse || networkResponse;
        })
    );
});
