<template>
    <div class="w-screen h-screen grid backdrop-blur-sm !z-[95] fixed top-0 right-0">
        <div class="w-fit h-fit p-4 bg-transparent m-auto rounded-[10px] spinner-container">
            <div class="spinner"></div>
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

<style scoped>
.spinner-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.spinner {
  width: 50px;
  height: 50px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>