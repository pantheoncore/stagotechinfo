<template>
    <navbar active="dashboard" />

    <div v-if="ready" class="px-4 md:px-8 py-[75px] bg-white min-h-screen z-[40]">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-gray-700">Active Systems</h1>
            <button v-if="session.role == 'admin'" class="bg-[#262D3E] text-white px-4 py-2 rounded-md hover:bg-[#38425a] flex items-center gap-4"
                @click="showCreateModal = true">
                <Icon icon="line-md:plus" height="24px"  />
                <p>New System</p>
            </button>
        </div>

        <!-- Systems Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Systems -->
            <a :href="`/a/systems/overview/${system.id}`" v-for="system in systems" :key="system.id"
                class="bg-white rounded-lg shadow-md overflow-hidden grid gap-4 p-4 h-fit border-[1px] border-[#c4c4c4]/50">
                <div class="w-full h-[200px]">
                    <img :src="system.image_url" :alt="system.name" class="w-full h-full object-cover rounded-[4px]" />
                </div>

                <div class="h-fit grid">
                    <h2 class="text-lg font-semibold text-gray-800 whitespace-nowrap truncate">{{ system.name }}</h2>
                    <p class="text-sm text-gray-600 line-clamp-2">{{ system.desc }}</p>
                </div>
            </a>
        </div>

        <!-- Create System Modal -->
        <div v-if="showCreateModal"
            class="fixed inset-0 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 grid h-fit max-h-[500px] overflow-y-auto">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Create New System</h2>
                <form @submit.prevent="createSystem">
                    <!-- Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <input type="text" id="name" v-model="newSystem.name" placeholder="Enter system name" required
                            class="mt-1 block w-full border-gray-300 rounded-md py-1 px-2 shadow-sm border-[1px]" />
                    </div>

                    <!-- Image URL Input -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            Image URL
                        </label>
                        <input type="url" id="image" v-model="newSystem.image_url" placeholder="Enter image URL" required
                            class="mt-1 block w-full border-gray-300 rounded-md py-1 px-2 shadow-sm border-[1px]" />
                    </div>

                    <!-- Description Input -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Description
                        </label>
                        <textarea id="description" v-model="newSystem.desc"
                            placeholder="Enter system description" required rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md py-1 px-2 shadow-sm border-[1px] max-h-[300px]"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="showCreateModal = false"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="bg-[#262D3E] text-white px-4 py-2 rounded-md hover:bg-[#38425a]">
                            Create
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
    data() {
        return {
            ready: false,
            session: {},
            showCreateModal: false,
            newSystem: {
                name: '',
                desc: '',
                image_url: null
            },
            systems: []
        }
    },
    async mounted() {
        this.session = await this.$session.get();

        await this.getSystems();
        this.ready = true;
    },
    methods: {
        async getSystems(){
            this.$gloading.start();
            // Implementation for creating a new system

            const res = await this.$apiHandler.get('systems/all', {title: "Systems"});
            this.$gloading.stop();

            if(res.status == 200){
                this.systems = res.data.systems;
            }
        },
        async createSystem() {
            this.$gloading.start();
            // Implementation for creating a new system

            const res = await this.$apiHandler.post('systems/create', this.newSystem, {title: "Create System"});
            this.$gloading.stop();

            if (res.status === 200) {
                this.showCreateModal = false;
                await this.getSystems();
            }
        }
    },
    components: {
        navbar,
        Icon
    }
}
</script>
