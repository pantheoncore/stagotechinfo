<template>
    <navbar />
    <div class="p-4 pt-20"> <!-- Added pt-20 to account for navbar height -->
        <!-- Create New System Button -->
        <button @click="showModal = true"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
            Create New System
        </button>

        <!-- Modal for Creating New System -->
        <div v-if="showModal" class="fixed inset-0 backdrop-blur-sm bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Create New System</h2>

                <input v-model="newSystem.name" placeholder="System Name" class="w-full p-2 border rounded mb-4" />

                <textarea v-model="newSystem.description" placeholder="Description"
                    class="w-full p-2 border rounded mb-4" rows="3"></textarea>

                <input type="file" @change="handleImageUpload" class="mb-4" />

                <div class="flex justify-end space-x-2">
                    <button @click="showModal = false"
                        class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button @click="createSystem" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Create
                    </button>
                </div>
            </div>
        </div>

        <!-- Systems List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a v-for="system in systems" :key="system.id" :href="system.link ?? '#'" class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer">
                <img :src="system.image" alt="System Image" class="w-full h-48 object-cover" />
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ system.name }}</h3>
                    <p class="text-gray-600 line-clamp-2">{{ system.description }}</p>
                </div>
            </a>
        </div>
    </div>
</template>

<script>

import navbar from '../components/navbar.vue';

export default {
    data() {
        return {
            showModal: false,
            newSystem: {
                name: '',
                description: '',
                image: null
            },
            systems: [
                {
                    image: "https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/2020-Chevrolet-Corvette-Stingray/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=1440",
                    name: "Chevrolet Corvette Stingray",
                    description: "here is some random information about the system, I want to add more so that I can see how it overflows",
                    link: ""
                },
            ]
        }
    },
    methods: {
        handleImageUpload(event) {
            this.newSystem.image = event.target.files[0];
        },
        createSystem() {
            // Implementation for creating a new system
            this.showModal = false;
        }
    },
    components: {
        navbar
    }
}
</script>
