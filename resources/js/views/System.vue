<template>
    <navbar :active="`system_${$route.params.id}`" />

    <div v-if="ready" class="px-4 md:px-8 py-[75px] bg-white min-h-screen z-[40] grid">
        <div class="w-full h-fit grid gap-8">
            <!-- Header -->
            <div class="grid md:flex items-center gap-6 md:gap-12 relative">
                <!-- go back -->
                <button class="hover:bg-gray-100 p-2 font-medium text-[#262D3E] rounded-md flex items-center gap-4 w-fit"
                    @click="$router.go(-1)">
                    <Icon icon="fluent-mdl2:back" height="14px"  />
                    <p>Go Back</p>
                </button>

                <!-- system name -->
                <h1 class="hidden md:block text-[24px] font-bold text-gray-700">{{ system.name }}</h1>

                <!-- system image -->
                <a :href="system.image_url" target="_blank" class="hidden md:block text-[16px] underline -ml-6">View System Image</a>

                <div v-if="session.role == 'admin'" class="flex gap-4 md:right-0 md:absolute">
                    <!-- delete button -->
                    <button class="bg-white text-[#920707] px-4 py-2 rounded-md flex items-center gap-4 border-[1px] border-[#920707]"
                        @click="">
                        <Icon icon="pepicons-pop:trash" height="24px"  />
                        <p>Delete</p>
                    </button>

                    <!-- edit button -->
                    <button class="bg-[#262D3E] text-white px-4 py-2 rounded-md hover:bg-[#38425a] flex items-center gap-4 border-[1px] border-[#262D3E] hover:border-[#38425a]"
                        @click="edit = true">
                        <Icon icon="material-symbols:edit-outline-rounded" height="24px"  />
                        <p>Edit System</p>
                    </button>
                </div>
            </div>

            <div class="w-full h-fit grid gap-2">
                <!-- system name -->
                <h1 class="md:hidden text-[24px] font-bold text-gray-700">{{ system.name }}</h1>

                <!-- system image -->
                <a :href="system.image_url" target="_blank" class="md:hidden text-[16px] underline text-gray-700">View System Image</a>

                <!-- System Desc -->
                <p class="text-[16px] text-[#78716c] line-clamp-6"><span class="text-gray-700">System Description: </span> {{ system.desc }}</p>
            </div>

            <!-- hardware -->
            <div class="bg-white md:rounded-lg overflow-hidden grid gap-6 md:gap-12 h-fit md:p-8 md:border-[1px] border-[#c4c4c4]/50">
                <!-- header -->
                <div class="w-full h-fit grid gap-4 items-center relative">
                    <h1 class="text-[20px] font-medium text-gray-700">Hardware Items</h1>

                    <button v-if="session.role == 'admin'" class="bg-[#262D3E] text-white px-4 py-2 rounded-md hover:bg-[#38425a] flex items-center gap-4 w-fit md:right-0 md:absolute"
                        @click="showCreateModal = true">
                        <Icon icon="line-md:plus" height="24px"  />
                        <p>Add Item</p>
                    </button>
                </div>

                <!-- items -->
                <div class="w-full h-fit max-h-[500px] md:max-h-[830px] overflow-y-auto grid md:grid-cols-3 gap-x-8 gap-y-4 pb-2">
                    <a v-for="(item, index) in items.hardware" :href="`/a/systems/item/${item.id}`" class="bg-white shadow-sm rounded-lg overflow-hidden grid md:grid-cols-2 gap-4 h-fit p-4 md:p-8 border-[1px] border-[#c4c4c4]/50">
                        <div class="w-full h-[200px]">
                            <img :src="item.image_url" :alt="item.name" class="w-full h-full object-cover rounded-[8px]" />
                        </div>

                        <div class="w-full h-full relative grid gap-4">
                            <div class="w-full h-fit grid">
                                <p class="text-[16px] md:text-[18px] text-[#0C0A09] font-medium line-clamp-6 truncate whitespace-nowrap">{{ item.name }}</p>
                                <p class="text-[14px] md:text-[16px] text-[#78716c] truncate whitespace-nowrap">Part #: {{ item.part_num }}</p>

                                <p class="text-[14px] md:text-[16px] text-[#78716c] mt-2 line-clamp-3 md:line-clamp-2">{{ item.desc }}</p>
                            </div>

                            <div class="md:bottom-0 md:left-0 md:absolute">
                                <p class="w-fit h-fit px-4 py-1 bg-black rounded-full text-white text-[14px] md:text-[16px]">Common Problems: <span class="font-bold">{{ item.common_problems }}</span></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- software -->
            <div class="bg-white md:rounded-lg overflow-hidden grid gap-6 md:gap-12 h-fit md:p-8 md:border-[1px] border-[#c4c4c4]/50">
                <!-- header -->
                <div class="w-full h-fit grid gap-4 items-center relative">
                    <h1 class="text-[20px] font-medium text-gray-700">Software Items</h1>

                    <button v-if="session.role == 'admin'" class="bg-[#262D3E] text-white px-4 py-2 rounded-md hover:bg-[#38425a] flex items-center gap-4 w-fit md:right-0 md:absolute"
                        @click="showCreateModal = true">
                        <Icon icon="line-md:plus" height="24px"  />
                        <p>Add Item</p>
                    </button>
                </div>

                <!-- items -->
                <div class="w-full h-fit max-h-[500px] md:max-h-[830px] overflow-y-auto grid md:grid-cols-3 gap-x-8 gap-y-4 pb-2">
                    <a v-for="(item, index) in items.software" :href="`/a/systems/item/${item.id}`" class="bg-white shadow-sm rounded-lg overflow-hidden grid md:grid-cols-2 gap-4 h-fit p-4 md:p-8 border-[1px] border-[#c4c4c4]/50">
                        <div class="w-full h-full relative grid gap-4">
                            <div class="w-full h-fit grid">
                                <p class="text-[16px] md:text-[18px] text-[#0C0A09] font-medium line-clamp-6 truncate whitespace-nowrap">{{ item.name }}</p>
                                <p class="text-[14px] md:text-[16px] text-[#78716c] truncate whitespace-nowrap">Part #: {{ item.part_num }}</p>

                                <p class="text-[14px] md:text-[16px] text-[#78716c] mt-2 line-clamp-3 md:line-clamp-2">{{ item.desc }}</p>
                            </div>

                            <p class="w-fit h-fit px-4 py-1 bg-black rounded-full text-white text-[14px] md:text-[16px]">Common Problems: <span class="font-bold">{{ item.common_problems }}</span></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit System Modal -->
        <div v-if="edit"
            class="fixed inset-0 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-[90%] md:w-1/2 p-6 grid h-fit max-h-[600px] overflow-y-auto">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Edit System</h2>
                <form @submit.prevent="updateSystem">
                    <div class="w-full grid md:grid-cols-2 gap-4 mb-4">
                        <div class="w-full h-fit grid gap-4">
                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>
                                <input type="text" id="name" v-model="newSystem.name" placeholder="Enter system name" required
                                    class="mt-1 block w-full border-gray-300 rounded-md py-1 px-2 shadow-sm border-[1px] text-[14px] md:text-[16px]" />
                            </div>

                            <!-- Image URL Input -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">
                                    Image URL
                                </label>
                                <input type="url" id="image" v-model="newSystem.image_url" placeholder="Enter image URL" required
                                    class="mt-1 block w-full border-gray-300 rounded-md ring-0 focus:border-[1px] py-1 px-2 shadow-sm border-[1px] text-[14px] md:text-[16px]" />
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea id="description" v-model="newSystem.desc"
                                placeholder="Enter system description" required rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md py-1 px-2 shadow-sm focus:ring-none h-[200px] md:h-[300px] max-h-[400px] md:max-h-[500px] border-[1px] text-[14px] md:text-[16px]"></textarea>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="edit = false"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="bg-[#262D3E] text-white px-4 py-2 rounded-md hover:bg-[#38425a]">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import { Icon } from '@iconify/vue';
import navbar from '../components/navbar.vue';

export default {
    name: "System Overview",
    data() {
        return {
            session: {},
            ready: false,
            edit: false,

            system: {
                id: null,
                name: "",
                desc: "",
                image_url: "#"
            },
            newSystem: {
                id: null,
                name: "",
                desc: "",
                image_url: "#"
            },

            items: {
                hardware: [
                    {
                        image_url: "https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
                        name: "Robotics Update",
                        part_num: "234234234",
                        desc: "Integer turpis eros, pretium eu ligula quis, luctus luctus lacus. Aliquam feugiat efficitur eros et dignissim. Ut sagittis euismod sapien, ac vulputate diam pellentesque eu."
                    }
                ],
                software: [
                    {
                        image_url: "https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
                        name: "Robotics Update",
                        part_num: "234234234",
                        desc: "Integer turpis eros, pretium eu ligula quis, luctus luctus lacus. Aliquam feugiat efficitur eros et dignissim. Ut sagittis euismod sapien, ac vulputate diam pellentesque eu."
                    },
                    {
                        image_url: "https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
                        name: "Robotics Update",
                        part_num: "234234234",
                        desc: "Integer turpis eros, pretium eu ligula quis, luctus luctus lacus. Aliquam feugiat efficitur eros et dignissim. Ut sagittis euismod sapien, ac vulputate diam pellentesque eu."
                    },
                    {
                        image_url: "https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
                        name: "Robotics Update",
                        part_num: "234234234",
                        desc: "Integer turpis eros, pretium eu ligula quis, luctus luctus lacus. Aliquam feugiat efficitur eros et dignissim. Ut sagittis euismod sapien, ac vulputate diam pellentesque eu."
                    },
                ]
            }
        }
    },
    async mounted(){
        this.session = await this.$session.get();
        await this.getSystem();
        this.ready = true;
    },
    watch: {
        edit: function(value){
            if(value){
                const system = JSON.stringify(this.system);
                this.newSystem = JSON.parse(system);
            }else{
                this.newSystem = {
                    id: null,
                    name: "",
                    desc: "",
                    image_url: "#"
                }
            }
        }
    },
    methods: {
        async getSystem(){
            this.$gloading.start();

            const res = await this.$apiHandler.get(`systems/overview/${this.$route.params.id}`);
            this.$gloading.stop();

            if(res.status == 200){
                this.system = res.data.system;
            }
        },
        async updateSystem(){
            this.$gloading.start();

            const res = await this.$apiHandler.post(`systems/update/${this.$route.params.id}`, this.newSystem, {title: 'Update System Info'});
            this.$gloading.stop();

            if(res.status == 200){
                this.edit = false;
                this.getSystem();
            }
        }
    },
    components: {
        Icon,
        navbar
    }
}

</script>