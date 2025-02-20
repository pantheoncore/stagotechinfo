import axios from "axios";

axios.defaults.headers.common = {
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]'),
    "Accept": "application/json",
    // 'Access-Control-Allow-Origin': '*',
    // 'Access-Control-Allow-Methods': 'GET,POST,OPTIONS,DELETE,PUT'
};

axios.interceptors.request.use((config) => {
    const pageUrl = window.location.href;

    const app = window.stago_app.config.globalProperties;
    config.headers["Authorization"] = `Bearer ${app.$session.get_token()}`;

    return config;
});

axios.interceptors.response.use(
    (response) => response,
    async (error) => {
        const app = window.stago_app.config.globalProperties;

        const status = error.response.status;
        const ignore_endpoints = [ "/auth/" ];
        const force_endpoints = ["/auth/session"];

        const fullURL = (error.response.config.baseURL ?? '') + error.response.config.url;        
        const ignore  = ignore_endpoints.map(value => fullURL.includes(value)).includes(true);
        const force  = force_endpoints.map(value => fullURL.includes(value)).includes(true);

        if ( status == 401 && (force || !ignore )) {
            const res = app.$apiHandler.get("auth/validate");

            if(res.status != 200){
                // Clear token from local storage and redirect to login page
                // Clear session

                // Create a notification about the redirect
                app.$notification.add({
                    title: "Authentication Error",
                    text: "invalid session, please login again to continue.",
                    type: "warn",
                    timeout: 3500,
                });

                // stop loading
                app.$gloading.stop();

                // send to login / home page
                return app.$router.push({
                    name: "Home",
                    query: { then: app.$route.path },
                });
            }
        }

        return Promise.reject(error);
    }
);