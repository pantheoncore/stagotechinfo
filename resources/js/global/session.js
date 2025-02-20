import {ref} from 'vue'
// Global Loading Function

const session = {
    install(app, options) {
        app.config.globalProperties.$session = ref({
            data: {},
            update: async function (){
                const global = app.config.globalProperties;
                this.data = (await global.$apiHandler.get('auth/session')).data.session;
            },
            get: async function (update = false){
                // send if existing session information is available other wise update information
                if(update || !this.data || Object.keys(this.data).length == 0){
                    await this.update();
                }

                return this.data;
            },
            clear: function (){
                this.data = {};
                this.clear_token();
                return;
            },

            set_token: function (token){
                return localStorage.setItem('stago_token', token);
            },
            get_token: function (){
                return localStorage.getItem('stago_token');
            },
            clear_token: function(){
                return localStorage.removeItem('stago_token');
            },
            validate: async function(){
                const res = await app.config.globalProperties.$apiHandler.get('auth/validate');
                return res.status == 200;
            },
            login: async function(form){
                const global = app.config.globalProperties;
                global.$gloading.start();

                const alert = { title: "Account Login" };
                const res = await global.$apiHandler.post('auth/login', form, {}, alert);
                
                // invalid login
                if(res.status != 200){
                    global.$gloading.stop();
                    return false;
                }
                
                // push to dashboard if token is returned in successful response
                this.set_token(res.data.token);
                // updates session information
                this.update()
                
                global.$gloading.stop();
                return global.$router.push({path: global.$route.query.then ?? '/a/dashboard'});
            },
            logout: async function(){
                const global = app.config.globalProperties;
                global.$gloading.start();

                // delete session tokens
                try{
                    await global.$apiHandler.get('auth/logout/all');
                }catch{}
                // clear token and session information
                this.clear();

                global.$gloading.stop();
                // send user to login / home page
                return global.$router.push({name: "Home"});
            }
        }).value
    }
}

export default session