<template>
    <!-- Notifications -->
    <div class="w-fit h-fit max-h-screen overflow-y-auto overflow-x-hidden fixed right-2 top-0 pt-4 z-[98]">
        <div class="w-fit pl-[25px] h-fit grid gap-4">
            <div :class="[isDark ? 'text-white' : 'text-custom-gray',
                notification.type == 'success' ? 'bg-custom-green' : (notification.type == 'error' ? 'bg-custom-red' : (notification.type == 'warn' ? 'bg-custom-orange' : 'bg-[#009fe3]')),
                'w-[300px] md:w-[500px] h-fit p-2 bg-opacity-10 rounded-tr-[4px] rounded-br-[4px] relative overflow-visible animate__animated animate__slideInRight']"
                v-for="(notification, index) in notifications"
                style="--animate-duration: 0.3s;">
                    <!-- White Base -->
                    <div :class="isDark ? 'bg-custom-black' : 'bg-white '" class="w-full h-full absolute top-0 right-0 z-[-1] rounded-tr-[4px] rounded-br-[4px]"></div>
                    <!-- Sidebar -->
                    <div :class="notification.type == 'success' ? 'bg-custom-green' : (notification.type == 'error' ? 'bg-custom-red' : (notification.type == 'warn' ? 'bg-custom-orange' : 'bg-[#009fe3]')) " class="w-2 h-full top-0 -left-3 rounded-tl-[4px] rounded-bl-[4px] absolute z-[99]"></div>

                    <p class="text-[16px] md:text-[18px] font-medium">{{ notification.title }}</p>
                    <p class="mt-1 text-[12px] md:text-[14px]">{{ notification.text }}</p>
            </div>
        </div>
    </div>
</template>

<script>

export default{
    name: "Notifications",
    data(){
        return{
            isDark: false,
            notifications: this.$notification.notifications
        }
    },
    mounted() {
        
    }
}

</script>