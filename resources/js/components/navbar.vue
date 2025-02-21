<template>
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo Section -->
                <div class="flex items-center md:space-x-8">
                    <a href="/a/dashboard" class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-blue-600">
                            Stago Tech Info
                        </h1>
                    </a>

                    <!-- Navigation Links -->
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="/a/dashboard"
                            class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Dashboard
                        </a>

                        <!-- Systems Dropdown -->
                        <div class="relative ml-3">
                            <div @click="toggleSystems"
                                class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                                <span class="sr-only">Open systems menu</span>
                                Systems
                                <svg class="h-5 w-5 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <div v-if="showSystems"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <a v-for="(system, index) in systems" :key="index" :href="system.link ?? '#'"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ system.name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="flex items-center">
                    <!-- Profile Dropdown -->
                    <div class="ml-3 relative">
                        <div @click="toggleProfile"
                            class="bg-gray-300 p-1 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="../../assets/images/user.svg" alt="User profile">
                        </div>

                        <div v-if="showProfile"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Settings
                            </a>
                            <button @click="$session.logout()"
                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            showSystems: false,
            showProfile: false,
            systems: [
                {
                    name: "Compact Max",
                    link: "/a/compact-max"
                }
            ]
        }
    },
    methods: {
        toggleSystems() {
            this.showSystems = !this.showSystems
            this.showProfile = false
        },
        toggleProfile() {
            this.showProfile = !this.showProfile
            this.showSystems = false
        }
    }
}
</script>