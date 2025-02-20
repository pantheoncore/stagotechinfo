<template>
    <div class="w-screen h-screen grid backdrop-blur-sm !z-[95] fixed top-0 right-0">
        <div class="w-fit h-fit p-4 bg-transparent m-auto rounded-[10px]">
            <DotLottieVue style="height: 250px; width: 250px" autoplay loop src="https://lottie.host/dab8c755-97c6-4914-8702-19da1adfb95c/OH9kV0kAG7.lottie" />
        </div>
    </div>
</template>

<script>
import { Icon } from '@iconify/vue';
import { DotLottieVue } from '@lottiefiles/dotlottie-vue'

export default {
    name: "Loading Component",
    data() {
        return {
            
        }
    },
    components: {
        Icon,
        DotLottieVue
    }
}

</script>