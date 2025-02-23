<template>
    <!-- mobile menu -->
    <div :class="mobile_menu ? '-left-0' : '-left-128'" class="top-0 fixed grid md:hidden bg-white shadow-2xl border-r-[1px] border-black/10 w-[80%] h-full z-[99] transition-all duration-500 p-6">
        <div class="w-full h-fit grid gap-12">
            <button @click="mobile_menu = false">
                <Icon icon="line-md:menu-to-close-transition" width="24px" />
            </button>

            <div style="overflow-y: auto;" class="w-full h-[600px] max-h-[600px] overflow-y-auto grid text-[18px] relative">
                <div class="grid gap-3 h-fit">
                    <!-- links -->
                    <button
                        @click="item.click()"
                        v-for="(item, index) in links"
                        :class="active == item.code ? ' text-custom-black' : 'hover:text-custom-black text-custom-black/70'"
                        class="w-fit grid justify-items-center gap-1 relative group curosr-pointer h-fit"
                    >
                        <!-- name -->
                        <span class=" whitespace-nowrap">{{ item.name }}</span>
                        <!-- icon -->
                        <Icon icon="pepicons-print:line-x" width="24px" :class="active == item.code ? '' : 'invisible'" class="w-fit -bottom-3 absolute left-0" />
                    </button>
                </div>
            </div>

            <div class="">

            </div>
        </div>
    </div>

    <div v-if="ready" class="w-full h-[50px] flex items-center bg-white fixed z-[69]" style="box-shadow: rgba(0, 0, 0, 0.133) 0px 1.6px 3.6px 0px, rgba(0, 0, 0, 0.11) 0px 0.3px 0.9px 0px;">
        <!-- moble menu button -->
        <button @click="mobile_menu = true" class="md:hidden ml-4">
            <Icon icon="material-symbols:menu-rounded" width="32px" class="text-gray-700"/>
        </button>

        <!-- Links -->
        <div class="w-full h-full hidden md:flex items-center gap-10 px-4 md:px-8 font-medium select-none max-w-[75%] overflow-x-auto">
            <button
                @click="item.click()"
                v-for="(item, index) in links"
                :class="active == item.code ? ' text-custom-black' : 'hover:text-custom-black text-custom-black/70'"
                class="w-fit grid justify-items-center gap-1 relative group curosr-pointer"
            >
                <!-- name -->
                <span class=" whitespace-nowrap">{{ item.name }}</span>
                <!-- icon -->
                <Icon icon="pepicons-print:line-x" width="24px" :class="active == item.code ? '' : 'invisible'" class="w-fit -bottom-3 absolute" />
            </button>
        </div>

        <!-- global search -->
        <div class="right-0 absolute">
            <!-- <globalSearch v-if="global_search" @close="global_search = false;"/> -->

            <div :class="dark ? 'text-white' : 'text-custom-black'" class="w-fit h-fit flex items-center gap-6 pr-4 md:pr-8 transition-all duration-500">
                <!-- search button -->
                <button v-if="$route.name == 'System Overview' || $route.name == 'Item Overview'" class="grid w-[28px] h-[28px] min-w-[28px] min-h-[28px]">
                    <Icon icon="iconoir:search" height="28px" class="m-auto" />
                </button>
                
                <!-- Buttons -->
                <button v-for="(item, index) in buttons" @click="item.click()" :class="[item.admin && session.role != 'admin' ? 'hidden' : 'grid']" class="w-[28px] h-[28px] min-w-[28px] min-h-[28px]">
                    <img v-if="item.isImage" :src="item.img" alt="Icon" class="h-[28px] w-[28px] m-auto">
                    <Icon v-else :icon="item.icon" height="28px" class="m-auto" />
                </button>

                <div v-if="['/a/rocket-ai/chat', '/a/rocket-ai/carrier-gpt'].includes($route.path)">
                    <img v-if="dark" @click="changeMode" class="h-[28px] rounded-full  border-[1px] w-[28px] bg-white cursor-pointer m-auto" src="./../../../../public/dark-mode.svg" alt=""/>
                    <img v-else @click="changeMode" class="h-[28px]  w-[28px]  border-0 cursor-pointer m-auto" src="./../../../../public/light-mode.svg" alt=""/>
                </div>

                <!-- User Button -->
                <!-- <button @click="$router.push({name: 'Account Settings'})" :class="dark ? 'bg-custom-black' : 'bg-white'" class="w-[28px] h-[28px] min-w-[28px] transition-all duration-500 min-h-[28px] grid relative overflow-hidden"> -->
                    <!-- Profile Picture -->
                    <!-- <img v-if="'pfp_path' in session && !$custom.empty(session.pfp_path)" :src="session.pfp_path" alt="Profile Picture" class="w-full h-full object-cover rounded-full"> -->
                    <!-- No PFP User Icon -->
                    <!-- <Icon v-else icon="solar:user-linear" height="20px" :class="dark ? 'text-white' : 'text-[#fff]'" class="m-auto transition-all duration-500 bg-[#262D3E] rounded-full p-1 w-[28px] h-[28px] flex items-center justify-center"/> -->
                <!-- </button> -->
            </div>
        </div>
    </div>
</template>

<script>

import { Icon } from '@iconify/vue';

export default {
    name: "CRM - Navbar",
    props: {
        active: String
    },
    data() {
        return {
            ready: false,
            dark: false,
            mobile_menu: false,

            systems: [], 
            links: [
                {
                    name: "Dashboard",
                    code: "dashboard",
                    click: () => {
                        if(this.$route.name != 'Dashboard'){
                            this.$router.push({name: "Dashboard"})
                        }
                    }
                }
            ],

            session: {},
            global_search: false,
            initials: "",
            buttons: [
                {
                    // Logout
                    isImage: false,
                    img: "https://crm.rocketflood.com/storage/images/notification.svg",
                    icon: "mynaui:logout",
                    admin: false,
                    click: () => {
                        this.$session.logout();
                    }
                },
                {
                    // Settings
                    isImage: false,
                    img: "https://crm.rocketflood.com/storage/images/settings1.svg",
                    icon: "solar:settings-linear",
                    admin: true,
                    click: () => {
                        this.$router.push({name: "Settings"})
                    }
                },
            ]
        }
    },
    watch: {
        systems: function(value) {
            if(this.ready){
                this.map_systems_to_links(value);
            }
        }
    },
    async mounted() {
        this.session = await this.$session.get();
        const name = this.session.name;
        // create Initials
        this.initials = name.split(" ").map(n => n[0]).join("").substring(0, 2).toUpperCase();

        await this.getSystems();
        this.map_systems_to_links(this.systems);

        this.ready = true;
    },
    methods: {
        toggleSearch(){
            this.global_search = !this.global_search;
        },
        changeMode() {
            const newMode = !this.dark;
            localStorage.setItem("is_dark_mode", newMode);
            window.dispatchEvent(new CustomEvent('is_dark_mode-localstorage-changed', {
                detail: {
                    storage: localStorage.getItem('is_dark_mode')
                }
            }));
            this.$emit('update:dark', newMode);
        },

        map_systems_to_links(systems){
            systems.forEach(obj => {
                this.links.push(
                    {
                        name: obj.name,
                        code: `system_${obj.id}`,
                        click: () => {
                            if(this.$route.name != 'System Overview' || (this.$route.name == 'System Overview' && this.$route.params?.id != obj.id)){
                                window.location.replace('/a/systems/overview/'+obj.id);
                            }
                        }
                    }
                )
            });
        },
        async getSystems(){
            this.$gloading.start();
            // Implementation for creating a new system

            const res = await this.$apiHandler.get('systems/all', {title: "Systems"});
            this.$gloading.stop();

            if(res.status == 200){
                this.systems = res.data.systems;
            }
        },
    },
    components: {
        Icon
    }
}

</script>

<style scoped>

::-webkit-scrollbar {
    width: 2px;
    height: 2px;
}

</style>