<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full space-y-8 text-center">
      <div>
        <h1 class="text-9xl font-bold text-gray-900">404</h1>
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
          Page Not Found
        </h2>
        <p class="mt-4 text-gray-500">
          The page you're looking for doesn't exist or has been moved.
        </p>
      </div>
      <div class="mt-8">
        <a href="/"
          class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Return to Home
        </a>
      </div>
      <div class="mt-12">
        <button @click="$router.go(-1)"
          class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
              d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
              clip-rule="evenodd" />
          </svg>
          Go Back
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Page Not Found - 404",
};
</script>
